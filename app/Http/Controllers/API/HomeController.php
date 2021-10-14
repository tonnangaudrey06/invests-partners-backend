<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Projet;
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
        $projets =Projet::where('typr', 'IP')->get();
        return $this->sendResponse($projets, 'App projets');
    }
}
