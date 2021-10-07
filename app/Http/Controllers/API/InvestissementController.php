<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Investissement;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvestissementController extends Controller
{
    public function index()
    {
        $investissements = Investissement::with(['projet_data', 'user_data'])->get();
        $projets = Projet::all();
    }

    public function projectInvest($id)
    {
        $projets = Investissement::select(DB::raw('sum(montant) as total_investi, user, projet'))
        ->groupBy('projet')
        ->groupBy('user')
        ->where('user', $id)
        ->with(['projet_data'])
        ->get();
        return $this->sendResponse($projets, 'Get project invest');
    }

    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                'date_versement' => 'required|:investissements',
                'investisseur' => 'required|:investissements',
                'projet' => 'required|:investissements',
                'montant_investi' => 'required|:investissements',
            ],

            [
                'date_versement.required' => 'Champ obligatoire!',
                'investisseur.required' => 'Champ obligatoire!',
                'projet.required' => 'Champ obligatoire!',
                'montant_investi.required' => 'Champ obligatoire!',
            ]
        );

        $data = array();
        $data['user'] = $request->investisseur;
        $data['projet'] = $request->projet;
        $data['date_versement'] = Carbon::parse($request->date_versement);
        $data['montant'] = $request->montant_investi;



        Investissement::create($data);

        Toastr::success('Investissement ajouté avec succès!', 'Succès');

        return redirect()->intended(route('investissement.home'));
    }

    public function edit($id)
    {
        $investissement = Investissement::with(['projet_data', 'user_data'])->find($id);
        $investisseurs = User::where('role', 4)->get();
        $projets = Projet::all();
        return view('pages.investissement.edit', compact('investissement', 'investisseurs', 'projets'));
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate(
            [
                'date_versement' => 'required|:investissements',
                'investisseur' => 'required|:investissements',
                'projet' => 'required|:investissements',
                'montant_investi' => 'required|:investissements',
            ],

            [
                'date_versement.required' => 'Champ obligatoire!',
                'investisseur.required' => 'Champ obligatoire!',
                'projet.required' => 'Champ obligatoire!',
                'montant_investi.required' => 'Champ obligatoire!',
            ]
        );

        $data = Investissement::find($id);
        $data->update([
            'user' => $request->investisseur,
            'projet' => $request->projet,
            'date_versement' => Carbon::parse($request->date_versement),
            'montant' => $request->montant_investi
        ]);

        Toastr::success('Investissement modifié avec succès!', 'Succès');

        return redirect()->intended(route('investissement.home'));
    }

    public function delete($id){        

        Investissement::find($id)->delete();
        Toastr::success('Investissement supprimé avec succès!', 'Success');

        return redirect()->intended(route('investissement.home'));
        
    }
}
