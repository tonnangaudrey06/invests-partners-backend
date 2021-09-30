<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->get();
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
}
