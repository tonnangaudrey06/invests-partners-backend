<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        Carbon::setLocale('fr');
        Carbon::setUtf8(true);
        Carbon::setToStringFormat('d/m/Y H:i:s');

        $transactions = Transaction::with(['user', 'projet', 'event'])
                               ->orderBy('created_at', 'DESC')
                               ->get();

        // Formater les dates pour le fuseau horaire du Cameroun
        foreach ($transactions as $transaction) {
        $transaction->created_at = Carbon::parse($transaction->created_at)
                                         ->tz('Africa/Douala')
                                         ->format('Y-m-d H:i:s');
    }
    return view('pages.transaction.home')->with('transactions', $transactions);
    }

    public function delete($id)
    {
        Transaction::find($id)->delete();
        Toastr::success('Transaction supprimé avec succès!', 'Success');
        return back();
    }
}
