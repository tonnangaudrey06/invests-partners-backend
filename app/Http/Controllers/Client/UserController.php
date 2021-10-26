<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ProfilInvestisseur;
use App\Models\Role;
use App\Models\Secteur;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function administrateur()
    {
        $users = User::where('role', 1)->with(['role_data', 'profil_invest', 'secteurs_data'])->get();
        $role = (object) [
            'name' => 'administrateur',
            'value' => 1
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Sous-administrateurs');
    }

    public function sous_administrateur()
    {
        $users = User::where('role', 5)->with(['role_data', 'profil_invest', 'secteurs_data'])->get();
        $role = (object) [
            'name' => 'sous-administrateur',
            'value' => 5
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Sous-administrateurs');
    }

    public function conseille()
    {
        $users = User::where('role', 2)->with(['role_data', 'profil_invest', 'secteurs_data'])->get();
        $role = (object) [
            'name' => 'conseiller',
            'value' => 2
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Conseillers en investissement');
    }

    public function porteurProjet()
    {
        $users = User::where('role', 3)->with(['role_data', 'profil_invest', 'secteurs_data'])->get();
        $role = (object) [
            'name' => 'porteur projet',
            'value' => 3
        ];
        return view('pages.user.home')->with('users', $users)->with('role', $role)->with('title', 'Porteurs de projet');
    }

    public function investisseur()
    {
        $users = User::where('role', 4)->with(['role_data', 'profil_invest', 'secteurs_data'])->get();
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

    public function editProfil($id)
    {
        $user = User::find($id);
        return view('pages.user.edit-profil')->with('user', $user);
    }

    // public function store(Request $request)
    // {
    //     $data = $request->input();
    //     $data['password'] = Hash::make($request->password);

    //     User::create($data);

    //     Toastr::success('Utilisateur ajouté avec succès!', 'Succès');

    //     return back();
    // }



    public function add($id)
    {
        $role = Role::find($id);

        $profil = ProfilInvestisseur::all();
        $secteur  = Secteur::all();
        return view('pages.user.add')->with('role', $role)->with('profil', $profil)->with('secteur', $secteur);
    }

    public function store(Request $request)
    {

        $data = $request->input();
        $data['folder'] = hexdec(uniqid());
        $data['password'] = Hash::make($request->password);



       $user =  User::create($data);

       Secteur::where('id', $request->secteur)->update([
        'user' => $user->id,
       ]);

        Toastr::success('Utilisateur ajouté avec succès!', 'Succès');

        return back();
    }

    public function edit($id)
    {
        $user = User::find($id);
        $profil = ProfilInvestisseur::all();
        return view('pages.user.edit')->with('user', $user)->with('profil', $profil);
    }

    public function update($id, Request $request)
    {

        $data = $request->except(['_token', 'password']);

        User::where('id', $id)->update($data);

        Toastr::success('Utilisateur mis à jour avec succès!', 'Success');

        return redirect()->back();
    }

    public function updateProfile($id, Request $request)
    {
        $data = $request->except(['_token']);
        $photo = $request->file('photo');

        $user = User::find($id);

        if (!empty($photo)) {
            $filename = 'photo.' . strtolower($photo->getClientOriginalExtension());
            $data['photo'] = url('storage/uploads/'. $user->folder) . '/' . $filename;
            $photo->storeAs('uploads/'. $user->folder .'/', $filename, ['disk' => 'public']);
        }

        $user->update($data);

        Toastr::success('Utilisateur mis à jour avec succès!', 'Success');

        return redirect(route('user.profile'));
    }

    public function updatePassword($id, Request $request)
    {
        $user = User::where('id', $id)->first();

        if (!Hash::check($request->old, $user->password)) {
            Toastr::error('Mot de passe incorrect!', 'Erreur');
            return back();
        }

        $user->password = Hash::make($request->new);
        $user->save();

        Toastr::success('Utilisateur mis à jour avec succès!', 'Success');

        return redirect(route('user.profile'));
    }

    public function delete($id)
    {

        $user = User::find($id);

        if ($user->folder != null) {

            File::deleteDirectory(storage_path('app/public/uploads/') . $user->folder);
        }


        User::find($id)->delete();
        Toastr::success('Utilisateur supprimé avec succès!', 'Success');

        return redirect()->back();
    }
}
