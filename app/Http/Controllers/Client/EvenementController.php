<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $events = Evenement::with(['participants'])->get();
        return view('pages.events.home')->with('events', $events);
    }

    public function add()
    {
        return view('pages.events.add');
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        $event = Evenement::find($id);
        return view('pages.events.edit')->with('event', $event);
    }

    public function update($id, Request $request)
    {
    }

    public function delete($id)
    {
        return redirect()->intended(route('events.home'));
    }
}
