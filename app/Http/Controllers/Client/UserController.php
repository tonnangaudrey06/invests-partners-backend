<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function administrateur()
    {
        $users = User::where('role', 1)->with(['role'])->get();
        $role = (object) [
            'name' => 'administrateur',
            'value' => 1
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Administrateurs');
    }

    public function conseille()
    {
        $users = User::where('role', 2)->with(['role'])->get();
        $role = (object) [
            'name' => 'conseillé',
            'value' => 2
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Conseillés d’investissement');
    }

    public function porteurProjet()
    {
        $users = User::where('role', 3)->with(['role'])->get();
        $role = (object) [
            'name' => 'porteur projet',
            'value' => 3
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Porteurs de projet');
    }

    public function investisseur()
    {
        $users = User::where('role', 4)->with(['role'])->get();
        $role = (object) [
            'name' => 'investisseur',
            'value' => 4
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Investisseurs');
    }

    public function show($id = null)
    {
        $user = auth()->user();

        if (!empty($id)) {
            $user = User::find($id);
        }

        return view('pages.user.profil')->with('user', $user);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['password'] = Hash::make($request->password);

        User::create($data);

        Toastr::success('Utilisateur ajouté avec succès!', 'Succès');

        return back();
    }

    public function update($id, Request $request)
    {
        $data = $request->input();

        if ($request->has('password')) {
            unset($data['password']);
        }

        User::where('id', $id)->update($data);

        Toastr::success('Utilisateur mis à jour avec succès!)', 'Success');

        return back();
    }
}
