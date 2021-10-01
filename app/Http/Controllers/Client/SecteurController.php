<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Secteur;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SecteurController extends Controller
{
    public function index()
    {
        $secteurs = Secteur::with(['user_data'])->get();
        $users = User::where('role', 2)->get();
        return view('pages.category.home')->with('secteurs', $secteurs)->with('users', $users); 
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['slug'] = Str::slug($request->libelle);

        Secteur::create($data);

        Toastr::success('Catégorie ajouté avec succès!', 'Succès');

        return redirect()->intended(route('category.home'));
    }

    public function update($id, Request $request)
    {
        // $data = $request->input();
        // $data['slug'] = Str::slug($request->libelle);
        // $data['libelle'] = Str::libelle($request->libelle);
        // $data['user'] = Str::user($request->specialiste);

        // Secteur::where('id', $id)->update($data);

        $data = Secteur::find($id);
        $data->update([
            'libelle' => $request->libelle,
            'libelle' => $request->specialiste,
            'slug' => $request->libelle
        ]);

        Toastr::success('Catégorie mis à jour avec succès!)', 'Success');

        // return redirect()->intended(route('category.home'));
        return response()->json($data);
    }

    public function GetUserEdit($user_id){

        // $sub = DB::table('users')->where('id', $user_id)->first();
        $sub = Secteur::where('id', $user_id)->first();
        return response()->json($sub);
    } 

        
}
