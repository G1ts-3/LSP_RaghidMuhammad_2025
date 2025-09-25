<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $transactions = Transaction::with(['user', 'book'])->get();
            return view('admin.transactions.index', compact('transactions'));
        } else {

            $transactions = Transaction::with(['user', 'book'])
                ->where('user_id', auth()->id())
                ->get();
            return view('member.dashboard', compact('transactions'));
        }
    }

    public function create()
    {
        $books = Books::where('status', 'available')->get();
        $users = User::where('role', 'member')->get();
        return view('admin.transactions.create', compact('books', 'users'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
            'status' => 'required|in:pending,ongoing,completed'
        ]);


        $book = Books::findOrFail($validated['book_id']);


        if ($book->status !== 'available') {
            return back()->with('error', 'Buku tidak tersedia');
        }


        $transaction = Transaction::create($validated);


        $book->update(['status' => 'borrowed']);


        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan')
            ->with('newTransaction', $transaction);
    }


    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'book']);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,ongoing,completed'
        ]);


        if ($validated['status'] === 'completed') {
            $transaction->book->update(['status' => 'available']);
        } elseif ($validated['status'] === 'ongoing') {
            $transaction->book->update(['status' => 'borrowed']);
        }

        $transaction->update($validated);
        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi berhasil diupdate');
    }

    public function destroy(Transaction $transaction)
{

    $transaction->book->update(['status' => 'available']);


    $transaction->delete();

    return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus');
}

}
