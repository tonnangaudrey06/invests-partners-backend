<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\EventMail;
use App\Models\Evenement;
use App\Models\Participant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class EvenementController extends Controller
{
    public function index()
    {
        $events = Evenement::whereDate('date_evenement', '>', Carbon::now())->get();
        $month = Evenement::whereMonth('date_evenement', '=', Carbon::now()->month)->get();
        return $this->sendResponse(['all' => $events, 'month' => $month], 'All events');
    }

    public function new()
    {
        $events = Evenement::latest()->take(5)->get();
        return $this->sendResponse($events, 'Latest events');
    }

    public function participer($id, Request $request)
    {
        $data = $request->input();
        $data['evenement'] = $id;

        $user = Participant::where("nom_complet", $request->nom_complet)->first();

        if (!empty($user)) {
            $user->places += (int)$request->places;
            $user->save();
        } else {
            $user = Participant::create($data);
        }

        $event = Evenement::find($id);

        try {
            Mail::to($user->email)
                ->queue(new EventMail(
                    $event->toArray(),
                    $user->toArray()
                ));
        } catch (\Throwable $th) {
            return $this->sendResponse($th, 'Impossible d\'envoyer un mail car l\'email n\'existe pas.');
        }

        return $this->sendResponse(null, 'Participation done');
    }

    public function checkSeat($id, Request $request)
    {
        $data = $request->input();

        $event = Evenement::where('id', $id)->first();

        if ($data['places'] > ($event->places - $event->total_reserve)) {
            return $this->sendError("Nombre insuffisant de places !", [], 500);
        }

        return $this->sendResponse(null, 'Seat OK');
    }

    public function show($id)
    {
        $event = Evenement::where('id', $id)->first();
        return $this->sendResponse($event, 'One event');
    }
}
