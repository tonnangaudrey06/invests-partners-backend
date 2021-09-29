<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index()
    {
        return view('pages.projet.home');
    }

    public function add()
    {
        return view('pages.projet.add');
    }

    public function show($id)
    {
        return view('pages.projet.details');
    }
}
