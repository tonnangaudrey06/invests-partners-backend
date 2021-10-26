<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Projet;
use App\Models\Secteur;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class ActualiteController extends Controller
{
    public function index($type, $id)
    {

        $type = $type;
        if ($type == 'secteur') {
            $secteur = Secteur::where('id', $id)->with('conseiller_data')->first();
            $actualites = Actualite::with('secteur_data')->where('secteur', $secteur->id)->get();
            return view('pages.actualites.index', compact('secteur', 'type', 'actualites'));
        }

        if ($type == 'projet') {
            $projet = Projet::where('id', $id)->first();
            $actualites = Actualite::with('projet_invest')->where('projet', $projet->id)->get();
            return view('pages.actualites.index', compact('projet', 'type', 'actualites'));
        }
    }

    public function add($type, $id)
    {

        $type = $type;
        if ($type == 'secteur') {
            $secteur = Secteur::where('id', $id)->with('conseiller_data')->first();
            return view('pages.actualites.add', compact('secteur', 'type'));
        } else {
            $projet = Projet::where('id', $id)->first();
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

        if ($type == 'secteur') {
            $data['secteur'] = $id;
        }

        if ($type == 'projet') {
            $data['projet'] = $id;
        }

        Actualite::create($data);

        Toastr::success('Actualité ajouté avec succès!', 'Succès');

        return redirect()->intended(route('actualites.home', [$type, $id]));
    }

    public function showDetails($type, $id, $idPS)
    {
        $actualite = Actualite::with(['projet_invest', 'secteur_data'])->find($id);
        $type = $type;

        // return response()->json($actualite);

        return view('pages.actualites.details', compact('actualite', 'type', 'idPS'));
    }

    public function edit($type, $id, $idPS)
    {
        $type = $type;
        $idPS = $idPS;

        $actualite = Actualite::find($id);
        return view('pages.actualites.edit', compact('type', 'actualite', 'idPS'));
    }

    public function update(Request $request, $type, $id, $idPS)
    {
        $validated = $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png',
            ],

        );

        $actu_image = $request->file('image');

        if ($actu_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($actu_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'images/secteurs/';
            $last_img = $up_location . $img_name;
            $actu_image->move($up_location, $img_name);

            $path = parse_url($request->oldimage);
            File::delete(public_path($path['path']));

            $data = Actualite::find($id);
                   
                $data->libelle = $request->libelle;
                $data->description = $request->description;
                $data->image = url($up_location) . '/' . $img_name;               

                $data->save();

                Toastr::success('Actualité mise à jour avec succès!', 'Success');
            
        } else {
            $data = Actualite::find($id);
            
            $data->libelle = $request->libelle;
            $data->description = $request->description;

            $data->save();

            Toastr::success('Actualité mise à jour avec succès!', 'Success');

        }

        

        return redirect()->intended(route('actualites.home', [$type, $idPS]));
       
    }

    public function delete($type, $id, $idPS)
    {

        $actualite = Actualite::find($id);

        $path = parse_url($actualite->image);

        File::delete(public_path($path['path']));

        Actualite::find($id)->delete();
        Toastr::success('Actualité supprimée avec succès!', 'Success');

        return redirect()->intended(route('actualites.home', [$type, $idPS]));
    }
}
