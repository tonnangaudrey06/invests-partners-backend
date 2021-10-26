<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Privilege;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;

class PrivilegeController extends Controller
{
    public function InsertWriter()
    {
        return view('pages.privilege.insert');
    }

    public function StoreWriter(Request $request)
    {
        $privilege = Privilege::where('role', $request->role)->where('module', $request->module)->first();

        if (empty($privilege)) {
            $privilege = new Privilege();
            $privilege->role = $request->role;
            $privilege->module = $request->module;
        }

        $privilege->consulter = $request->consulter;
        $privilege->modifier = $request->modifier;
        $privilege->ajouter = $request->ajouter;
        $privilege->supprimer = $request->supprimer;

        $privilege->save();

        // return response()->json($privilege);
        Toastr::success('Privilège ajouté avec succès!', 'Succès');
        return back();
    }

    public function AllWriter()
    {

        $writers = Role::with(['modules'])->get();
        $privileges = Privilege::all();
        // return response()->json($writers);
        return view('pages.privilege.index', compact('writers'));
    }

    public function EditWriter($idrole, $idmodule)
    {
        $writer = Privilege::where('role', $idrole)->where('module', $idmodule)->first();
        $roles = Role::all();
        $modules = Module::all();
        return view('pages.privilege.edit', compact('writer', 'roles','modules'));
    }

    public function UpdateWriter(Request $request, $idrole, $idmodule)
    {
        $privilege = Privilege::where('role', $request->role)->where('module', $request->module)->first();

        if (empty($privilege)) {
            $privilege = new Privilege();
            $privilege->role = $request->role;
            $privilege->module = $request->module;
        }

        $privilege->consulter = $request->consulter;
        $privilege->modifier = $request->modifier;
        $privilege->ajouter = $request->ajouter;
        $privilege->supprimer = $request->supprimer;

        $privilege->save();

        // return response()->json($privilege);
        Toastr::success('Privilège modifié avec succès!', 'Succès');
        return redirect()->route('all.writer');
    }

    public function DeleteWriter($idrole, $idmodule)
    {
        Privilege::where('role', $idrole)->where('module', $idmodule)->delete();
        Toastr::success('Privilège supprimé avec succès!', 'Succès');
        return redirect()->back();
    }
}
