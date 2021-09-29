<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProfilInvestisseur;
use Illuminate\Http\Request;

class ProfilInvestisseurController extends Controller
{
    
    public function index()
    {
        $profils = ProfilInvestisseur::all();
        return $this->sendResponse($profils, 'Investissor profiles');
    }
}
