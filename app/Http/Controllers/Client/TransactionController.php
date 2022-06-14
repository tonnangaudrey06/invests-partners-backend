<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'projet', 'event'])->get();
        return view('pages.transaction.home')->with('transactions', $transactions);
    }
}
