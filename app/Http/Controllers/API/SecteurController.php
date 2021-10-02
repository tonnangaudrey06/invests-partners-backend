<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Secteur;

class SecteurController extends Controller
{
    public function index()
    {
        $secteurs = Secteur::all();
        return $this->sendResponse($secteurs, 'All domaines');
    }
    
    public function show($id)
    {
        $secteurs = Secteur::with(['conseille'])->find($id);
        return $this->sendResponse($secteurs, 'Get one domaine');
    } 
}
