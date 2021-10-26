<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\CreationProjetMail;
use App\Mail\PaiementProjetConseilleMail;
use App\Mail\PaiementProjetPorteurMail;
use App\Models\Actualite;
use App\Models\Archive;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\ProfilInvestisseur;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    public function index()
    {
        $projets = Projet::with(['membres', 'user_data'])->get();
        $this->sendResponse($projets, 'All projects');
    }

    public function store(Request $request)
    {
        $logo = $request->file('logo');
        $doc_presentation = $request->file('doc_presentation');
        $medias = $request->has('medias') ? $request->file('medias') : [];
        $membres = $request->has('membres') ? json_decode($request->input('membres')) : [];
        $data = json_decode($request->input('projet'), true);

        $user = User::find($data['user']);

        // Save project
        $data['folder'] = hexdec(uniqid());

        if (!empty($logo)) {
            $filename = 'logo.' . $logo->getClientOriginalExtension();
            $data['logo'] = url('storage/uploads/' . $user->folder . '/projets/' . $data['folder']) . '/' . $filename;
            $logo->storeAs('uploads/' . $user->folder . '/projets/' . $data['folder'] . '/', $filename, ['disk' => 'public']);
        }

        if (!empty($doc_presentation)) {
            $filename = $doc_presentation->getClientOriginalName();
            $data['doc_presentation'] = url('storage/uploads/' . $user->folder . '/projets/' . $data['folder'] . '/documents') . '/' . $filename;
            $doc_presentation->storeAs('uploads/' . $user->folder . '/projets/' . $data['folder'] . '/documents/', $filename, ['disk' => 'public']);
        }

        $projet = Projet::create($data);

        // Save all project medias
        foreach ($medias as $media) {
            $extension = $media->getClientOriginalExtension();

            $data = [
                'projet' => $projet->id,
                'nom' => $media->getClientOriginalName()
            ];

            if (in_array($extension, Archive::getAllowedFiles())) {
                $data['url'] = url('storage/uploads/' . $user->folder . '/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                $data['type'] = 'FICHIER';
                $media->storeAs('uploads/' . $user->folder . '/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
            } else if (in_array($extension, Archive::getAllowedImages())) {
                $data['url'] = url('storage/uploads/' . $user->folder . '/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                $data['type'] = 'IMAGE';
                $media->storeAs('uploads/' . $user->folder . '/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
            } else {
                $data['url'] = url('storage/uploads/' . $user->folder . '/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                $data['type'] = 'VIDEO';
                $media->storeAs('uploads/' . $user->folder . '/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
            }

            Archive::create($data);
        }

        // Add all members to project
        foreach ($membres as $membre) {
            Equipe::create([
                'projet' => $projet->id,
                'membre' => $membre->membre->id,
                'statut' => $membre->statut
            ]);
        }

        $admin = User::where('role', 1)->first();

        // Retrieve projects informations
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements'])->where('id', $projet->id)->first();
        
        try {
            if (!empty($projet->secteur_data->conseiller_data)) {
                Mail::to($projet->secteur_data->conseiller_data->email)->queue(new CreationProjetMail($projet->toArray()));
            }
    
            if (!empty($admin)) {
                Mail::to($admin->email)->queue(new CreationProjetMail($projet->toArray()));
            }
        } catch (\Throwable $e) {
            return $this->sendResponse($projet, 'Impossible d\'envoyer un mail car l\'email n\'existe pas.');
        }

        return $this->sendResponse($projet, 'Project');
    }

    public function store2(Request $request)
    {
        $logo = $request->file('logo');
        $doc_presentation = $request->file('doc_presentation');
        $medias = $request->has('medias') ? $request->file('medias') : [];
        $data = json_decode($request->input('projet'), true);

        $user = User::find($data['user']);

        // Save project
        $data['folder'] = hexdec(uniqid());

        if (!empty($logo)) {
            $filename = 'logo.' . $logo->getClientOriginalExtension();
            $data['logo'] = url('storage/uploads/' . $user->folder . '/projets/' . $data['folder']) . '/' . $filename;
            $logo->storeAs('uploads/' . $user->folder . '/projets/' . $data['folder'] . '/', $filename, ['disk' => 'public']);
        }

        if (!empty($doc_presentation)) {
            $filename = $doc_presentation->getClientOriginalName();
            $data['doc_presentation'] = url('storage/uploads/' . $user->folder . '/projets/' . $data['folder'] . '/documents') . '/' . $filename;
            $doc_presentation->storeAs('uploads/' . $user->folder . '/projets/' . $data['folder'] . '/documents/', $filename, ['disk' => 'public']);
        }

        $projet = Projet::create($data);

        // Save all project medias
        foreach ($medias as $media) {
            $extension = $media->getClientOriginalExtension();

            $data = [
                'projet' => $projet->id,
                'nom' => $media->getClientOriginalName()
            ];

            if (in_array($extension, Archive::getAllowedFiles())) {
                $data['url'] = url('storage/uploads/' . $user->folder . '/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                $data['type'] = 'FICHIER';
                $media->storeAs('uploads/' . $user->folder . '/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
            } else if (in_array($extension, Archive::getAllowedImages())) {
                $data['url'] = url('storage/uploads/' . $user->folder . '/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                $data['type'] = 'IMAGE';
                $media->storeAs('uploads/' . $user->folder . '/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
            } else {
                $data['url'] = url('storage/uploads/' . $user->folder . '/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                $data['type'] = 'VIDEO';
                $media->storeAs('uploads/' . $user->folder . '/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
            }

            Archive::create($data);
        }

        $admin = User::where('role', 1)->first();

        // Retrieve projects informations
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements'])->where('id', $projet->id)->first();

        try {
            if (!empty($projet->secteur_data->conseiller_data)) {
                Mail::to($projet->secteur_data->conseiller_data->email)->queue(new CreationProjetMail($projet->toArray()));
            }
    
            if (!empty($admin)) {
                Mail::to($admin->email)->queue(new CreationProjetMail($projet->toArray()));
            }
        } catch (\Throwable $e) {
            return $this->sendResponse($projet, 'Impossible d\'envoyer un mail car l\'email n\'existe pas.');
        }

        return $this->sendResponse($projet, 'Project');
    }

    public function store3($id, Request $request)
    {
        $membres = $request->has('membres') ? json_decode($request->input('membres')) : [];

        return $this->sendResponse($membres, 'Project');

        // Add all members to project
        foreach ($membres as $membre) {
            Equipe::create([
                'projet' => $id,
                'membre' => $membre->membre->id,
                'statut' => $membre->statut
            ]);
        }

        // Retrieve projects informations
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements'])->where('id', $id)->first();

        return $this->sendResponse($projet, 'Project');
    }

    public function show($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements', 'actualites'])->find($id);
        $actualites = Actualite::where('secteur', $projet->secteur)->get();
        array_merge($projet->actualites, $actualites);
        return $this->sendResponse($projet, 'Project');
    }

    public function projets($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements'])->where('user', $id)->get();
        return $this->sendResponse($projet, 'Projects');
    }

    public function valide($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements'])->find($id);
        $projet->etat = 'VALIDE';
        $projet->save();

        $admin = User::where('role', 1)->first();

        Mail::to($projet->secteur_data->conseiller_data->email)->queue(new PaiementProjetConseilleMail($projet->toArray()));
        Mail::to($projet->user_data->email)->queue(new PaiementProjetPorteurMail($projet->toArray()));
        Mail::to($admin->email)->queue(new PaiementProjetConseilleMail($projet->toArray()));
        return $this->sendResponse($projet, 'Project valide');
    }

    public function projetsTown($id, $town, Request $request)
    {
        $user = $request->user();
        $profil = DB::table('profile_investisseurs')->find($user->profil);
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data', 'investissements'])
            ->where('secteur', $id)
            ->where('ville_activite', 'like', $town)
            ->where('etat', 'PUBLIE')
            ->get();
        return $this->sendResponse($projet, 'Projects');
    }
}
