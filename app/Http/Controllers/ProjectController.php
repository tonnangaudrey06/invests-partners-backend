<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function HomeProject()
    {
        $projects = Projet::with(['membres'])->get();
        return view('admin.projet.index', compact('projects'));
    }

    public function AddProject()
    {
        $membres = DB::table('membres')->get();
        return view('admin.projet.create', compact('membres'));
    }

    public function StoreProject(Request $request)
    {
        $request->validate([
            'photo_membre' => 'required|mimes:jpg,jpeg,png',
        ]);
        // dd('check');

        $membre_image = $request->file('photo_membre');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($membre_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'images/membres/';
        $last_img = $up_location.$img_name;
        $membre_image->move($up_location, $img_name);

        // $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        // Image::make($slider_image)->resize(1920, 1088)->save('images/slides/' . $name_gen);

        // $last_img = 'images/slides/' . $name_gen;

        // $data = array();
        // $data['nom'] = $request->nom_equipe;
        // $data['email'] = $request->email_equipe;
        // $data['telephone'] = $request->telephone_equipe;
        // $data['image'] = $last_img;
        // $data['created_at'] = Carbon::now();

        // DB::table('equipes')->insert($data);

        $projet = new Projet;
        $membre = new Membre;
        $equipe = new Equipe;

       


        $membre->statut = $request->statut;

        $projet->save();
        $membre->save();
        $equipe->save();

        return Redirect()->route('add.project')->with('success', 'Member inserted succesfully');
    }

    public function one($id)
    {
        $membres = Projet::with(['membres'])->find($id);
        return view('admin.projet.create', compact('membres'));
    }
}
