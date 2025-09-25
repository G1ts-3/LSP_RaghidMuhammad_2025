<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $hasActiveTransaction = false;

    if (auth()->user()->role === 'member') {
        // $hasActiveTransaction = Transaction::where('user_id', auth()->id())
        //     ->whereIn('status', ['ongoing', 'pending'])
        //     ->exists();

        $availableBooks = Books::where('status', 'available')->get();
        $userTransactions = Transaction::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'ongoing'])
            ->get();

        return view('member.borrow.index', compact('availableBooks', 'userTransactions', 'hasActiveTransaction'));
    }


    $transactions = Transaction::with(['user', 'book'])->get();
    return view('admin.transactions.index', compact('transactions'));
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
            'book_id' => 'required|exists:books,id',
        ]);

        // Member logic for borrowing books
        if (auth()->user()->role === 'member') {
            // Check if the book is still available
            $book = Books::findOrFail($validated['book_id']);
            if ($book->status !== 'available') {
                return back()->with('error', 'Buku sudah tidak tersedia');
            }


            Transaction::create([
                'user_id' => auth()->id(),
                'book_id' => $validated['book_id'],
                'borrow_date' => now(),
                'return_date' => now()->addDay(),
                'status' => 'ongoing',
            ]);

            // Update book status to 'borrowed'
            $book->update(['status' => 'borrowed']);

            return redirect()->route('member.dashboard')->with('success', 'Buku berhasil dipinjam, kembalikan buku tepat waktu');
        }

        // Admin logic for creating transactions
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after:borrow_date',
            'status' => 'required|in:pending,ongoing,completed',
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
        if (auth()->user()->role === 'admin') {
            return view('admin.transactions.show', compact('transaction'));
        }

        return back();
    }


    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,ongoing,completed',
        ]);

        if ($validated['status'] === 'completed') {
            $transaction->book->update(['status' => 'available']);
        } elseif ($validated['status'] === 'ongoing') {
            $transaction->book->update(['status' => 'borrowed']);
        }

        $transaction->update($validated);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Status transaksi berhasil diupdate');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->book->update(['status' => 'available']);
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
