<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;

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
            $data['logo'] = url('storage/uploads/'.$user->folder.'/projets/' . $data['folder']) . '/' . $filename;
            $logo->storeAs('uploads/'.$user->folder.'/projets/' . $data['folder'] . '/', $filename, ['disk' => 'public']);
        }

        if (!empty($doc_presentation)) {
            $filename = $doc_presentation->getClientOriginalName();
            $data['doc_presentation'] = url('storage/uploads/'.$user->folder.'/projets/' . $data['folder'] . '/documents') . '/' . $filename;
            $doc_presentation->storeAs('uploads/'.$user->folder.'/projets/' . $data['folder'] . '/documents/', $filename, ['disk' => 'public']);
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
                $data['url'] = url('storage/uploads/'.$user->folder.'/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                $data['type'] = 'FICHIER';
                $media->storeAs('uploads/'.$user->folder.'/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
            } else if(in_array($extension, Archive::getAllowedImages())) {
                $data['url'] = url('storage/uploads/'.$user->folder.'/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                $data['type'] = 'IMAGE';
                $media->storeAs('uploads/'.$user->folder.'/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
            } else {
                $data['url'] = url('storage/uploads/'.$user->folder.'/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                $data['type'] = 'VIDEO';
                $media->storeAs('uploads/'.$user->folder.'/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
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


        // Retrieve projects informations
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->where('id', $projet->id)->first();

        return $this->sendResponse($projet, 'Project');
    }

    public function show($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        return $this->sendResponse($projet, 'Project');
    }

    public function projets($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->where('user', $id)->get();
        return $this->sendResponse($projet, 'Projects');
    }
}
