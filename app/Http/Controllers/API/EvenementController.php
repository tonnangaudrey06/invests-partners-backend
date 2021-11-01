<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use App\Models\Participant;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        Participant::create($data);

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
        return $this->sendResponse($event, 'All events');
    }
}
