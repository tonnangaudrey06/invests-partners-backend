<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;
use App\Mail\CIValidation;
use App\Mail\AdminValidation;
use App\Models\Secteur;
use Illuminate\Http\Request;

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

    public function show($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id)->first();
        return view('pages.projet.details', compact('projet'));
    }

    public function AdminValidate($id) {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        // return response()->json($projet);

        Mail::to($projet->user_data->email)
            ->queue(new AdminValidation($projet->toArray()));

            Toastr::success('Mail avec succès!', 'Succès');

            $projet->update([
                'etat' => 'ATTENTE_PAIEMENT',
            ]);
 
        return back();
    }

    public function CIValidate($id) {

        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);

        Mail::to('admin@test.com')
            ->queue(new CIValidation($projet->toArray()));

            Toastr::success('Mail avec succès!', 'Succès');

            $projet->update([
                'etat' => 'ATTENTE_VALIDATION_ADMIN',
            ]);
 
        return back();

    }
}
