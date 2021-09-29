<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Projet;
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
        $request->validate([
            'intitule' => 'bail|required',
            'pays_activite' => 'bail|required|string',
            'ville_activite' => 'bail|required|string',
            'description' => 'bail|required|alpha',
            'financement' => 'bail|required|string',
            'secteur' => 'bail|required',
            'user' => 'bail|required',
            'logo' => 'mimes:jpg,jpeg,png',
            'doc_presentation' => 'mimes:jpg,jpeg,png',
            'photo' => 'mimes:jpg,jpeg,png',
            'cni' => 'mimes:jpg,jpeg,png',
        ]);

        $logo = $request->file('logo');
        $doc_presentation = $request->file('doc_presentation');
        $photo = $request->file('photo');
        $cni = $request->file('cni');

        $medias = $request->has('medias') ? $request->file('medias') : [];

        $membres = $request->has('membres') ? $request->input('membres') : [];
        $statut = $request->input('statut');

        $data = $request->except(['medias', 'doc_presentation', 'membres', 'photo', 'logo', 'cni', 'nom_complet', 'telephone', 'email', 'pays', 'ville', 'date_naissance', 'profession', 'parcours', 'membres', 'statut']);
        $membre = $request->only(['nom_complet', 'user', 'telephone', 'email', 'pays', 'ville', 'date_naissance', 'profession', 'parcours']);


        // return $this->sendResponse($membres, 'Project');

        // Save project
        $data['folder'] = hexdec(uniqid());

        if (!empty($logo)) {
            $filename = 'logo.' . $logo->getClientOriginalExtension();
            $data['logo'] = url('storage/uploads/projets/' . $data['folder']) . '/' . $filename;
            $logo->storeAs('uploads/projets/' . $data['folder'] . '/', $filename, ['disk' => 'public']);
        }

        if (!empty($doc_presentation)) {
            $filename = $doc_presentation->getClientOriginalName();
            $data['doc_presentation'] = url('storage/uploads/projets/' . $data['folder'] . '/documents') . '/' . $filename;
            $doc_presentation->storeAs('uploads/projets/' . $data['folder'] . '/documents/', $filename, ['disk' => 'public']);
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
                $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                $data['type'] = 'FICHIER';
                $media->storeAs('uploads/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
            } else if(in_array($extension, Archive::getAllowedImages())) {
                $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                $data['type'] = 'IMAGE';
                $media->storeAs('uploads/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
            } else {
                $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                $data['type'] = 'VIDEO';
                $media->storeAs('uploads/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
            }

            Archive::create($data);
        }

        
        // Save actual member
        if (!empty($photo)) {
            $filename = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
            $membre['url'] = url('storage/uploads/membres/') . '/' . $filename;
            $photo->storeAs('uploads/membres/', $filename, ['disk' => 'public']);
        }

        if (!empty($cni)) {
            $filename = hexdec(uniqid()) . '.' . $cni->getClientOriginalExtension();
            $membre['cni'] = url('storage/uploads/cnis/') . '/' . $filename;
            $cni->storeAs('uploads/membres/', $filename, ['disk' => 'public']);
        }

        $membre_data = Membre::create($membre);
        Equipe::create([
            'projet' => $projet->id,
            'membre' => $membre_data->id,
            'statut' => $statut
        ]);


        // Add all members to project
        foreach ($membres as $membre) {
            $data_json = json_decode($membre);
            $data = [
                'projet' => $projet->id,
                'membre' => $data_json->membre->id,
                'statut' => $data_json->statut
            ];
            Equipe::create($data);
        }


        // Retrieve projects informations
        $projet = Projet::with(['user_data', 'membres']);

        return $this->sendResponse($projet, 'Project');
    }

    public function show($id)
    {
        $projet = Projet::with(['user_data', 'membres'])->find($id);
        $this->sendResponse($projet, 'Project');
    }
}
