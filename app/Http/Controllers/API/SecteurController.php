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
}
