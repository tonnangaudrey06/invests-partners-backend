<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'mimes:jpg,jpeg,png',
            'cni' => 'mimes:jpg,jpeg,png',
        ]);

        $photo = $request->file('photo');
        $cni = $request->file('cni');
        $data = $request->input();

        if (!empty($photo)) {
            $filename = hexdec(uniqid()) . '.' . strtolower($photo->getClientOriginalExtension());
            $data['photo'] = url('storage/uploads/membres/') . '/' . $filename;
            $photo->storeAs('uploads/membres/', $filename, ['disk' => 'public']);
        }

        if (!empty($cni)) {
            $filename = hexdec(uniqid()) . '.' . strtolower($cni->getClientOriginalExtension());
            $data['cni'] = url('storage/uploads/cnis/') . '/' . $filename;
            $cni->storeAs('uploads/membres/', $filename, ['disk' => 'public']);
        }
        
        $membre = Membre::create($data);

        return $this->sendResponse($membre, 'Membre created');
    }

    public function index($id)
    {
        $membres = Membre::where('user', $id)->get();
        return $this->sendResponse($membres, 'All members');
    }

    public function show($id)
    {
        $membre = Membre::find($id);
        $this->sendResponse($membre, 'Member');
    }

    public function delete($id)
    {
        $membre = Membre::find($id);
        $membre->delete();
        $this->sendResponse([], 'Member delete');
    }
}
