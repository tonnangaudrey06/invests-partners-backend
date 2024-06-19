<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use App\Models\Participant;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

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

    // public function store(Request $request)
    // {
    //     $data = $request->except('pay');
    //     $image = $request->file('image');

    //     if (!$request->pay == "on") {
    //         $data['prix'] = null;
    //     }

    //     if (!empty($image)) {
    //         $filename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    //         $data['image'] = url('storage/uploads/events') . '/' . $filename;
    //         $image->storeAs('uploads/events/', $filename, ['disk' => 'public']);
    //     }

    //     Evenement::create($data);

    //     Toastr::success('Évenement ajouté avec succès!', 'Succès');

    //     return redirect()->intended(route('events.home'));
    // }

    public function store(Request $request)
{
    // Validation des entrées
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'fichier' => 'nullable|mimes:pdf|max:5120', 
    ]);

    $data = $request->except('pay');
    $image = $request->file('image');
    $fichier = $request->file('fichier');

    if (!$request->pay == "on") {
        $data['prix'] = null;
    }

    if (!empty($image)) {
        $filename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $data['image'] = url('storage/uploads/events') . '/' . $filename;
        $image->storeAs('uploads/events/', $filename, ['disk' => 'public']);
    }

    if (!empty($fichier)) {
        $fichierFilename = hexdec(uniqid()) . '.' . $fichier->getClientOriginalExtension();
        $data['fichier'] = url('storage/uploads/events') . '/' . $fichierFilename;
        $fichier->storeAs('uploads/events/', $fichierFilename, ['disk' => 'public']);
    }

    Evenement::create($data);

    Toastr::success('Évenement ajouté avec succès!', 'Succès');

    return redirect()->intended(route('events.home'));
}


    public function edit($id)
    {
        $event = Evenement::find($id);
        return view('pages.events.edit')->with('event', $event);
    }

    public function show($id)
    {
        $event = Evenement::with(['participants'])->find($id);
        return view('pages.events.participant')->with('event', $event);
    }

    public function update($id, Request $request)
    {
        $data = $request->except('pay');
        $image = $request->file('image');
        $fichier = $request->file('fichier');
        $event = Evenement::where('id', $id)->first();

        if (!$request->pay == "on") {
            $data['prix'] = null;
        }

        if (!empty($image)) {
            $split = explode('/', $event->image);
            $filename = end($split);
            $path = storage_path("app/public/uploads/events/$filename");

            if (File::exists($path)) {
                File::delete($path);
            }

            $split = explode('.', $filename);

            $filename = $split[0];

            $filename = $filename . '.' . $image->getClientOriginalExtension();
            $data['image'] = url('storage/uploads/events') . '/' . $filename;
            $image->storeAs('uploads/events/', $filename, ['disk' => 'public']);
        }

        if (!empty($fichier)) {
            $split = explode('/', $event->fichier);
            $fichierFilename = end($split);
            $path = storage_path("app/public/uploads/events/$fichierFilename");

            if (File::exists($path)) {
                File::delete($path);
            }

            $split = explode('.', $fichierFilename);

            $fichierFilename = $split[0];

            $fichierFilename = $fichierFilename . '.' . $fichier->getClientOriginalExtension();
            $data['fichier'] = url('storage/uploads/events') . '/' . $fichierFilename;
            $fichier->storeAs('uploads/events/', $fichierFilename, ['disk' => 'public']);
        }

        $event->update($data);

        Toastr::success('Évenement mise à jour avec succès!', 'Succès');

        return redirect()->intended(route('events.home'));
    }


    public function delete($id)
    {
        $event = Evenement::where('id', $id)->first();

        $split = explode('/', $event->image);

        $filename = end($split);

        $path = storage_path("app/public/uploads/events/$filename");

        if (File::exists($path)) {
            File::delete($path);
        }

        $event->delete();

        Toastr::success('Évenement supprimé avec succès!', 'Success');

        return redirect()->intended(route('events.home'));
    }
    

    public function deleteParticipant($id)
    {
        Participant::where('id', $id)->delete();

        Toastr::success('Participant supprimé avec succès!', 'Success');

        return back();
    }
}
