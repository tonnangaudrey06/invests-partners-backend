<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\PayementClientMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payer($id, Request $request)
    {
        $data = [
            "trans_id" => $request->trans_id,
            "methode" => $request->methode,
            "telephone" => $request->telephone,
            "montant" => $request->montant,
            "type" => $request->type
        ];

        if ($request->has("participant")) {
            $data["participant_id"] = $id;
        } else {
            $data["user_id"] = $id;
        }

        if (isset($request->projet) && !empty($request->projet)) {
            $data['projet_id'] = $request->projet;
        }

        if (isset($request->etat) && !empty($request->etat)) {
            $data['etat'] = $request->etat;
            $data['valider'] = true;
        }

        $transaction = Transaction::create($data);

        $transaction = Transaction::with('user', 'participant')->find($transaction->id);

        $userMail = $transaction->is_client ? $transaction->user->email : $transaction->participant->email;

        // if ($transaction->etat == 'REUSSI') {
            // try {
                Mail::to($userMail)
                    ->queue(new PayementClientMail(
                        $transaction->toArray()
                    ));
            // } catch (\Throwable $th) {
            // }
        // }

        return $this->sendResponse($transaction, 'Transaction effectuer');
    }

    public function notifier(Request $request)
    {
        $transaction = Transaction::where('trans_id', $request->reference)->first();

        if ($request->status != 'SUCCESSFUL') {
            $transaction->etat = 'ECHOUE';
        } else {
            $transaction->etat = 'REUSSI';
            $transaction->valider = true;
        }

        $transaction->save();

        // if ($request->status != 'SUCCESSFUL') {
        //     try {
        //         Mail::to($transaction->user->email)
        //             ->queue(new PayementClientMail(
        //                 $transaction->toArray()
        //             ));
        //     } catch (\Throwable $th) {
        //     }
        // }
    }
}
