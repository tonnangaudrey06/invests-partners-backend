<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Projet;
use App\Models\Secteur;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ActualiteController extends Controller
{
    public function index($type, $id)
    {

        $type = $type;
        if($type == 'secteur'){
            $secteur = Secteur::find($id)->with('conseiller_data')->first();
            $actualites = Actualite::with('secteur_data')->where('secteur', $secteur->id)->get();
            return view('pages.actualites.index', compact('secteur', 'type', 'actualites'));
        }else{
            $projet = Projet::find($id)->first();
            $actualites = Actualite::with('projet_invest')->where('projet', $projet->id)->get();
            return view('pages.actualites.index', compact('projet', 'type', 'actualites'));
        }
        
    }

    public function add($type, $id)
    {

        $type = $type;
        if($type == 'secteur'){
            $secteur = Secteur::find($id)->with('conseiller_data')->first();
            return view('pages.actualites.add', compact('secteur', 'type'));
        }else{
            $projet = Projet::find($id)->first();
            return view('pages.actualites.add', compact('projet', 'type'));
        }
    }

    public function store(Request $request, $type, $id)
    {

        $validated = $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png',
            ],

        );

        $actu_image = $request->file('image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($actu_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $up_location = 'images/secteurs/';
        $last_img = $up_location . $img_name;
        $actu_image->move($up_location, $img_name);

        $data = array();
        $data['libelle'] = $request->libelle;
        $data['description'] = $request->description;
        $data['image'] = url($up_location) . '/' . $img_name;

        if($type == 'secteur'){
            $data['secteur'] = $id;
        }

        if($type == 'projet'){
            $data['projet'] = $id;
        }

        Actualite::create($data);

        Toastr::success('Actualité ajouté avec succès!', 'Succès');

        return redirect()->intended(route('actualites.home', [$type, $id]));
    }
}
