<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'projet', 'event'])->get();
        return view('pages.transaction.home')->with('transactions', $transactions);
    }

    public function delete($id)
    {
        Transaction::find($id)->delete();
        Toastr::success('Transaction supprimé avec succès!', 'Success');
        return back();
    }
}
