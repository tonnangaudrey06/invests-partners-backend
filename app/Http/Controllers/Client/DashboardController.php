<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\User;
use App\Models\Secteur;
use App\Models\Investissement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function countproject(){
        $users = User::where('role', 3)->with(['role_data'])->get();
        $invest = User::where('role', 4)->with(['role_data'])->get();
        $conseiller = User::where('role', 2)->with(['role_data'])->get();
        $projet = Projet::all();
        $secteur = Secteur::all();
        $investissement = Investissement::all()->sum('montant');

        return view('pages/dashboard.home' , [
            'porteurs'=> $users,
            'investisseurs'=> $invest,
            'conseiller'=> $conseiller,
            'nbProjets'=> $projet,
            'secteur'=> $secteur,
            'investissement'=> $investissement,
        ]);
    }

}
