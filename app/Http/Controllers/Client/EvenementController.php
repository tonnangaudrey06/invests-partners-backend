<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
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

    public function store(Request $request)
    {
        $data = $request->input();
        $image = $request->file('image');

        if (!empty($image)) {
            $filename = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $data['image'] = url('storage/uploads/events') . '/' . $filename;
            $image->storeAs('uploads/events/', $filename, ['disk' => 'public']);
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

    public function update($id, Request $request)
    {
    }

    public function delete($id)
    {
        $event = Evenement::where('id', $id)->first();

        $filename = end(explode('-', $event->image));

        $path = storage_path("app/public/uploads/events/$filename");
        if (File::exists($path)) {
            File::delete($path);
        }
        $event->delete();

        Toastr::success('Évenement supprimé avec succès!', 'Success');

        return redirect()->intended(route('events.home'));
    }
}
