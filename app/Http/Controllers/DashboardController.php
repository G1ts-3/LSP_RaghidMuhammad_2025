<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Transaction;
use Carbon\Carbon;

class Dashboardcontroller extends Controller
{
    public function index()
{
    $activeTransactions = Transaction::where('user_id', auth()->id())
        ->whereIn('status', ['ongoing'])
        ->with(['book'])
        ->get()
        ->map(function ($transaction) {
            $transaction->borrow_date = Carbon::parse($transaction->borrow_date);
            return $transaction;
        });

    return view('member.dashboard', compact('activeTransactions'));
}

}
