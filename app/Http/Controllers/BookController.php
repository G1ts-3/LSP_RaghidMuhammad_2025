<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Books::all();
        return view('admin.books.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'book_code' => 'required|unique:books',
        'book_title' => 'required',
        'author' => 'required',
        'publisher'=>'required',
        'year' => 'required|numeric',
        'status' => 'required|in:available,borrowed'
    ]);


    Books::create($validated);

    return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
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
    public function edit(Books $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $book)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:Books,Book_code,' . $book->id,
            'book_title' => 'required',
            'author' => 'required',
            'publisher' => 'required|unique:Books,publisher,' . $book->id,
            'year' => 'required|numeric',
            'status' => 'required|in:available,borrowed'
        ]);

        $book->update($validated);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {

        if ($book->transaction()->where('status', 'borrowed')->exists()) {
            return back()->with('error', 'Buku sedang dipinjam dan tidak dapat dihapus');
        }


        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus');
    }

}
