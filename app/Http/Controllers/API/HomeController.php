<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Investissement;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function slider()
    {
        $sliders = DB::table('sliders')->get();
        return $this->sendResponse($sliders, 'App sliders');
    }

    public function partenaire()
    {
        $partenaires = DB::table('partenaires')->get();
        return $this->sendResponse($partenaires, 'App partenaires');
    }

    public function projet()
    {
        $projets =Projet::where('type', 'IP')->get();
        return $this->sendResponse($projets, 'App projets');
    }

    public function chiffres()
    {
        $pp = User::where('role', 3)->count();
        $iv = User::where('role', 4)->count();
        $total = Investissement::select(DB::raw('sum(montant) as total'))->first()->total;
        return $this->sendResponse(['pp' => $pp, 'iv' => $iv, 'total' => $total], 'App chiffre');
    }
}
