<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ProfilInvestisseur;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ProfilInvestisseurController extends Controller
{
    public function index()
    {
        $profils = ProfilInvestisseur::all();
        return view('pages.profil-investisseur.home')->with('profils', $profils);
    }

    public function store(Request $request)
    {
        $data = $request->input();

        ProfilInvestisseur::create($data);

        Toastr::success('Profil ajouté avec succès!', 'Succès');

        return redirect()->intended(route('profil.investisseur.home'));
    }

    public function update($id, Request $request)
    {
        $data = $request->input();

        ProfilInvestisseur::where('id', $id)->update($data);

        Toastr::success('Profil mis à jour avec succès!)', 'Success');

        $profils = ProfilInvestisseur::all();
        return view('pages.profil-investisseur.home')->with('profils', $profils);
    }
}
