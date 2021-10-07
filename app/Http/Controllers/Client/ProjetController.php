<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\AdminInfoSupp;
use App\Models\Projet;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;
use App\Mail\CIValidation;
use App\Mail\AdminValidation;
use App\Mail\CIInfoSupp;
use App\Models\Archive;
use App\Models\Secteur;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->get();
        // $sect = Secteur::where('user', Auth()->user()->role)->get();
        // $pro = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->where('user', Auth()->user()->id)->get();
        // return response()->json($projets);
        return view('pages.projet.home', compact('projets'));
    }

    public function add()
    {
        return view('pages.projet.add');
    }

    public function edit($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        return view('pages.projet.edit', compact('projet'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'taux_rentabilite' => 'required|:projets|max:255',
                'duree' => 'required|:projets|max:255',
                'delai_recup' => 'required|:projets|max:255',
                'ca_previsionnel' => 'required|:projets|max:255',
            ],

            [
                'taux_rentabilite.required' => 'Champ obligatoire!',
                'duree.required' => 'Champ obligatoire!',
                'delai_recup.required' => 'Champ obligatoire!',
                'ca_previsionnel.required' => 'Champ obligatoire!',
            ]
        );

        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);

        $projet->taux_rentabilite = $request->taux_rentabilite;
        $projet->duree = $request->duree;
        $projet->rsi = $request->delai_recup;
        $projet->ca_previsionnel = $request->ca_previsionnel;
        $projet->etat = 'COMPLET';

        $projet->save();

        if ($request->hasFile('fichier')) {

            $files = $request->file('fichier');

            foreach ($files as $media) {
                $extension = $media->getClientOriginalExtension();
                $allowed_extension = array_merge(Archive::getAllowedFiles(), Archive::getAllowedImages(), Archive::getAllowedVideos());
                $check = in_array($extension, $allowed_extension);

                $data = [
                    'projet' => $projet->id,
                    'nom' => $media->getClientOriginalName(),
                    'source' => 'CONSEILLER'
                ];

                if ($check) {
                    if (in_array($extension, Archive::getAllowedFiles())) {
                        $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                        $data['type'] = 'FICHIER';
                        $media->storeAs('uploads/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
                    } else if (in_array($extension, Archive::getAllowedImages())) {
                        $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                        $data['type'] = 'IMAGE';
                        $media->storeAs('uploads/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
                    } else {
                        $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                        $data['type'] = 'VIDEO';
                        $media->storeAs('uploads/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
                    }
                    Archive::create($data);
                } else {
                    Toastr::danger('Désolé, vous ne pouvez télécharger que des png, jpg xls et doc.', 'Alerte');
                }
            }
        }
        Toastr::success('Projet modifié avec succès!', 'Succès');

        return redirect()->route('projet.details', $projet->id);
    }


    public function show($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        
        return view('pages.projet.details', compact('projet'));
    }

    public function typemessage($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        
        return view('pages.projet.askinfo', compact('projet'));
    }

    public function publish($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);

        $projet->update([
            'etat' => 'PUBLIE',
        ]);

        Toastr::success('Projet publié avec succès!', 'Succès');
        
        return back();
    }

    public function AdminValidate($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        // return response()->json($projet);

        Mail::to($projet->user_data->email)
            ->queue(new AdminValidation($projet->toArray()));

        Toastr::success('Mail envoyé avec succès!', 'Projet epprouvé');

        $projet->update([
            'etat' => 'ATTENTE_PAIEMENT',
        ]);

        return back();
    }


    public function AdminInfoSupp(Request $request, $id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        $conseiller = User::where('id', $projet->secteur_data->id)->first();
        //  return response()->json($conseiller);

        $data = array();
        $data['objet'] = $request->objet;
        $data['message'] = $request->message;

        Mail::to($conseiller->email)
            ->queue(new AdminInfoSupp($projet->toArray(), $data));

        Toastr::success('Mail envoyé avec succès!', 'Succès');

        $projet->update([
            'etat' => 'ATTENTE_INFO_SUPPL',
        ]);

        return redirect()->route('projet.details', $projet->id);
    }

    public function CIInfoSupp(Request $request, $id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);

        $data = array();
        $data['objet'] = $request->objet;
        $data['message'] = $request->message;
        
        // return response()->json($projet);

        Mail::to($projet->user_data->email)
            ->queue(new CIInfoSupp($projet->toArray(), $data));

        Toastr::success('Mail envoyé avec succès!', 'Succès');

        $projet->update([
            'etat' => 'ATTENTE_INFO_SUPPL',
        ]);

        return redirect()->route('projet.details', $projet->id);
    }

    public function CIValidate($id)
    {

        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);

        Mail::to('admin@test.com')
            ->queue(new CIValidation($projet->toArray()));

        Toastr::success('Mail envoyé avec succès!', 'Projet approuvé');

        $projet->update([
            'etat' => 'ATTENTE_VALIDATION_ADMIN',
        ]);

        return back();
    }
}
