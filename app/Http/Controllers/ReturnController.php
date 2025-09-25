<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use Illuminate\Http\Request;

class ReturnController extends Controller
{

    public function index()
    {
        $activeTransactions = Transaction::where('user_id', auth()->id())
            ->whereIn('status', ['ongoing'])
            ->with(['book'])
            ->get();

        return view('member.return.index', compact('activeTransactions'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id'
        ]);

        $transaction = Transaction::with('book')
            ->where('user_id', auth()->id())
            ->findOrFail($validated['transaction_id']);

        if ($transaction->status !== 'ongoing') {
            return back()->with('error', 'Status transaksi tidak valid untuk pengembalian');
        }

        // Begin transaction to ensure data consistency
        \DB::beginTransaction();
        try {
            // Update transaction
            $transaction->update([
                'status' => 'completed'
            ]);

            // Update book status
            $transaction->book->update(['status' => 'available']);

            \DB::commit();
            return redirect()->route('member.return.index')->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            \DB::rollback();
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
