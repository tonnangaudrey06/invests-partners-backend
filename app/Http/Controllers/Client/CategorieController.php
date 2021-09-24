<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::with(['user_data', 'image'])->get();
        $users = User::where('role', 2)->get();
        return view('pages.category.home')->with('categories', $categories)->with('users', $users);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['slug'] = Str::slug($request->libelle);

        Categorie::create($data);

        Toastr::success('Catégorie ajouté avec succès!', 'Succès');

        return redirect()->intended(route('category.home'));
    }

    public function update($id, Request $request)
    {
        $data = $request->input();
        $data['slug'] = Str::slug($request->libelle);

        Categorie::where('id', $id)->update($data);

        Toastr::success('Catégorie mis à jour avec succès!)', 'Success');

        return redirect()->intended(route('category.home'));
    }
        
}
