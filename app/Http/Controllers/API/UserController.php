<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DocumentFiscaux;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        return $this->sendResponse(User::with(['role_data', 'documents_fiscaux'])->find($id), 'User details');
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['password'] = Hash::make($request->password);

        $data = User::create($data);

        return $this->show($data->id);
    }

    public function updatePassword($id, Request $request)
    {
        $password = Hash::make($request->password);
        $old_password = Hash::make($request->old_password);

        $user = User::find($id);

        if($user->password != $old_password) {
            return $this->sendError('Mot de passe incorrect', null, 401);
        }

        $user->password = $password;
        $user->save();

        return $this->sendResponse(null, 'Mot de passe modifié');
    }

    public function update($id, Request $request)
    {
        $data = $request->except('password');

        User::where('id', $id)->update($data);

        return $this->show($id);
    }

    public function uploadProfilePicture($id, Request $request)
    {
        $photo = $request->file('photo');
        $user = User::find($id);

        if (!empty($photo)) {
            $filename = 'photo.' . strtolower($photo->getClientOriginalExtension());
            $user->photo = url('storage/uploads/'. $user->folder) . '/' . $filename;
            $photo->storeAs('uploads/'. $user->folder .'/', $filename, ['disk' => 'public']);
        }

        $user->save();

        return $this->show($id);
    }

    public function uploadCni($id, Request $request)
    {
        $cni = $request->file('cni');
        $user = User::find($id);

        if (!empty($cni)) {
            $filename = 'cni.' . strtolower($cni->getClientOriginalExtension());
            $user->cni = url('storage/uploads/'. $user->folder) . '/' . $filename;
            $cni->storeAs('uploads/'. $user->folder .'/', $filename, ['disk' => 'public']);
        }

        $user->save();

        return $this->show($id);
    }
    
    public function uploadDocumentFiscal($id, Request $request)
    {
        $document = $request->file('document');
        $user = User::find($id);
        $exist = DocumentFiscaux::where('type', $request->type)->first();

        $data = [
            'type' => $request->type,
            'user' => $id
        ];

        if (!empty($document)) {
            $filename = Str::lower($request->type) . '.' . strtolower($document->getClientOriginalExtension());
            $data['document'] = url('storage/uploads/'. $user->folder . '/doucment_fiscaux') . '/' . $filename;
            $document->storeAs('uploads/'. $user->folder .'/doucment_fiscaux/', $filename, ['disk' => 'public']);
        }

        if (!empty($exist)) {
            $file = substr($exist->document, strrpos($exist->document, '/') + 1);
            Storage::disk('public')->delete('uploads/'. $user->folder . '/doucment_fiscaux/'. $file);
            $exist->document = $data['document'];
            $exist->save();
            return $this->show($id);
        }

        $document = DocumentFiscaux::create($data);

        return $this->show($id);
    }
}
