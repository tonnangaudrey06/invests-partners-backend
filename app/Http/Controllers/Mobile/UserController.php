<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return $this->sendResponse(User::all(), 'All Users');
    }

    public function show($id)
    {
        return $this->sendResponse(User::find($id), 'One User');
    }
}
