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
        return $this->sendResponse($profils, '');
    }

    public function store($id = null, Request $request)
    {
        $data = $request->only(['type']);
        $data['id'] = $id;

        $profil = ProfilInvestisseur::updateOrCreate(
            $data,
            $request->input()
        );

        $profils = ProfilInvestisseur::all();
        return $this->sendResponse($profils, $profil->type . ' added successfuly');
    }

    public function show($id)
    {
        $profil = ProfilInvestisseur::find($id);
        return $this->sendResponse($profil, '');
    }
}
