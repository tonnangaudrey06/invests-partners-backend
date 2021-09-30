<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;

class PrivilegeController extends Controller
{
    public function InsertWriter(){
        return view('pages.privilege.insert');
    }

    public function StoreWriter(Request $request){
        $privilege = new Privilege();

        $privilege->role = $request->role;
        $privilege->module = $request->module;
        $privilege->consulter = $request->consulter;
        $privilege->modifier = $request->modifier;
        $privilege->ajouter = $request->ajouter;
        $privilege->supprimer = $request->supprimer;

        $privilege->save();

        // return response()->json($privilege);
        Toastr::success('Privilège ajouté avec succès!', 'Succès');
        return back();

    }

    public function AllWriter(){

        $writers = Role::with(['modules'])->get();
        // return response()->json($writers);
        return view('pages.privilege.index', compact('writers'));

       
    }
}
