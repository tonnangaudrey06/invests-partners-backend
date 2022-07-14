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
        
        $projets = Projet::with(['secteur_data'])->where('type', 'IP')->latest()->get();
        return $this->sendResponse($projets, 'App projets');
    }
    public function ville()
    {
        $villes= DB::table('projets')->select('ville_activite','pays_activite')->where('type', 'IP')->groupBy('ville_activite')->get();
        return $this->sendResponse($villes, 'App ville');
    }
    public function secteurparville()
    {
        $secteur = DB::table('secteurs')
        ->join('projets', 'secteurs.id', '=', 'projets.secteur')
        ->select('secteurs.libelle', 'secteurs.photo','secteurs.id','projets.ville_activite')
        ->get();
        return $this->sendResponse($secteur, 'App ville');
    }

    public function villeParSecteur($idSecteur, $pays)
    {
        $villeParSecteur = DB::table('projets')
        ->join('secteurs', 'projets.secteur', '=', 'secteurs.id')
        ->where('projets.secteur', $idSecteur)
        ->where('projets.pays_activite', 'like', $pays)
        ->where('projets.etat', 'PUBLIE')
        ->get();
        return $this->sendResponse($villeParSecteur, 'App ville');
    }

    public function showbycityandsector($ville, $secteur)
    {
        $projet = Projet::where('ville_activite',$ville)->where('secteur', $secteur)->get();
        
        return $this->sendResponse($projet, 'Project');
    }
    public function getactualites($id)
    {
        $actualite = DB::table('actualites')->where('projet',$id)->get();
        
        return $this->sendResponse($actualite, 'SUCCESS_ACTUALITE');
    }

    public function financements($id)
    {
        $invest = DB::table('investissements')->select('projet', DB::raw('SUM(montant) as total_montant'), DB::raw('COUNT(id) as total_contrib'))->groupBy('projet')->where('projet', $id)->get();
        return $this->sendResponse($invest, 'Investissement');
    }
    public function getprojetparsecteur()
    {
        $projetParSect = Projet::groupBy('secteur')->get();
        return $this->sendResponse($projetParSect, 'ProjetParSecteur');
    }


    public function chiffres()
    {
        $users = User::count();
        $projets = Projet::count();
        $total = Investissement::select(DB::raw('sum(montant) as total'))->first()->total;
        return $this->sendResponse(['users' => $users, 'projets' => $projets, 'total' => $total], 'App chiffre');
    }
}
