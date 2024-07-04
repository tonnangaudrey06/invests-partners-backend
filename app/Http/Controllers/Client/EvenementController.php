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

    public function store(Request $request)
{
    
    $request->validate([
        'libelle' => 'required|string|max:255',
        'lieu' => 'required|string|max:255',
        'date_debut' => 'required|date_format:Y-m-d',
        'date_fin' => 'required|date_format:Y-m-d|after_or_equal:date_debut',
        'heure_debut' => 'required|date_format:H:i',
        'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        'prix' => 'nullable|numeric|min:0',
        'places' => 'nullable|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'fichier' => 'nullable|mimes:pdf|max:5120',
        'description' => 'required|string|max:255'
    ]);

    
    $data = $request->except(['_token', 'image', 'fichier']);
    $image = $request->file('image');
    $fichier = $request->file('fichier');

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

    Evenement::create([
        'libelle' => $data['libelle'],
        'lieu' => $data['lieu'],
        'date_debut' => $request->input('date_debut'),
        'date_fin' => $request->input('date_fin'),
        'heure_debut' => $request->input('heure_debut'),
        'heure_fin' => $request->input('heure_fin'),
        'prix' => $data['prix'],
        'places' => $data['places'],
        'image' => $data['image'] ?? null,
        'fichier' => $data['fichier'] ?? null,
        'description' => $request->input('description'),
    ]);

    
    Toastr::success('Événement ajouté avec succès!', 'Succès');

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
    // Validation des entrées du formulaire
    $request->validate([
        'libelle' => 'required|string|max:255',
        'lieu' => 'required|string|max:255',
        'date_debut' => 'required|date_format:Y-m-d',
        'date_fin' => 'required|date_format:Y-m-d|after_or_equal:date_debut',
        'heure_debut' => 'required|date_format:H:i',
        'heure_fin' => 'required|date_format:H:i|after:heure_debut',
        'prix' => 'nullable|numeric|min:0',
        'places' => 'nullable|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'fichier' => 'nullable|mimes:pdf|max:5120',
        'description' => 'required|string|max:255',
    ]);

    // Récupération de l'événement à mettre à jour
    $event = Evenement::findOrFail($id);

    // Traitement des fichiers uploadés (image et fichier)
    $data = $request->except(['_token', 'image', 'fichier']);
    $image = $request->file('image');
    $fichier = $request->file('fichier');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('uploads/events', $filename, 'public');
        $data['image'] = url('storage/uploads/events') . '/' . $filename;
    }

if ($request->hasFile('fichier')) {
            $fichier = $request->file('fichier');
            $fichierFilename = time() . '.' . $fichier->getClientOriginalExtension();
            $fichier->storeAs('uploads/events', $fichierFilename, 'public');
            $data['fichier'] = url('storage/uploads/events') . '/' . $fichierFilename;
        }
    // Mise à jour des données de l'événement
    $event->update([
        'libelle' => $data['libelle'],
        'lieu' => $data['lieu'],
        'date_debut' => $request->input('date_debut'),
        'date_fin' => $request->input('date_fin'),
        'heure_debut' => $request->input('heure_debut'),
        'heure_fin' => $request->input('heure_fin'),
        'prix' => $data['prix'],
        'places' => $data['places'],
        'image' => $data['image'] ?? $event->image,
        'fichier' => $data['fichier'] ?? $event->fichier,
        'description' => $data['description'] ?? $event->description,
    ]);

    // Message de succès (facultatif : utilisez Toastr ou autre pour afficher un message à l'utilisateur)
    Toastr::success('Événement mis à jour avec succès!', 'Succès');

    // Redirection vers la page d'accueil des événements (ou une autre page)
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
