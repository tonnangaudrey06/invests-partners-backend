<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($id = null)
    {
        return view('pages.chat.home')->with('sender', auth()->user())->with('receiver', null);
    }
}
