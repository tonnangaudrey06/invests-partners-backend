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
        $data = array();

        if ($request->has('image')) {
            $actu_image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($actu_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'images/actualites/';
            $actu_image->move($up_location, $img_name);
            $data['image'] = url($up_location) . '/' . $img_name;
        }

        $data['libelle'] = $request->libelle;
        $data['description'] = $request->description;

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
        return view('pages.actualites.details', compact('actualite', 'type', 'idPS'));
    }

    public function edit($type, $id, $idPS)
    {
        $actualite = Actualite::with(['projet_invest', 'secteur_data'])->find($id);
        $type = $type;
        $idPS = $idPS;
        return view('pages.actualites.edit', compact('actualite', 'type', 'id', 'idPS'));
    }

    public function update(Request $request, $type, $id, $idPS)
    {

        $data = Actualite::find($id);

        if ($request->has('image')) {
            $old_image = $request->oldimage;
            $actu_image = $request->file('image');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($actu_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'images/actualites/';
            $actu_image->move($up_location, $img_name);

            $path = parse_url($old_image);
            File::delete(public_path($path['path']));

            $data->image = url($up_location) . '/' . $img_name;

            Toastr::success('Actualité mise à jour avec succès!', 'Success');
        }

        $data->libelle = $request->libelle;
        $data->description = $request->description;

        $data->save();

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
