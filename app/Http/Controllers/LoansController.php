<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\QueryException;

class LoansController extends Controller
{
    public function index()
    {
        $loans = Loans::all();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'returned' => 'required|boolean',
        ]);
    
        $book = Book::find($request->book_id);
        if (!$book) {
            return redirect()->back()->with('error', 'El libro no existe')->withInput();
        }
    
        if ($book->isLoaned()) {
            return redirect()->back()->with('error', 'El libro ya está prestado')->withInput();
        }
    
        if (!User::find($request->user_id)) {
            return redirect()->back()->with('error', 'El usuario no existe')->withInput();
        }
    
        try {
            Loans::create($request->all());
            return redirect()->route('loans.index')->with('success', 'Préstamo creado exitosamente.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al crear el préstamo')->withInput();
        }
    }
    public function show(Loans $loan)
    {
        return view('loans.show', compact('loan'));
    }

    public function edit(Loans $loan)
    {
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, Loans $loan)
{
    $request->validate([
        'book_id' => 'required|integer',
        'user_id' => 'required|integer',
        'start_date' => 'required|date',
        'due_date' => 'required|date',
        'returned' => 'required|boolean',
    ]);

    $book = Book::find($request->book_id);
    if (!$book) {
        return redirect()->back()->with('error', 'El libro no existe')->withInput();
    }

    if ($book->isLoaned() && $loan->book_id != $request->book_id) {
        return redirect()->back()->with('error', 'El libro ya está prestado')->withInput();
    }

    if (!User::find($request->user_id)) {
        return redirect()->back()->with('error', 'El usuario no existe')->withInput();
    }

    try {
        $loan->update($request->all());
        return redirect()->route('loans.index')->with('success', 'Préstamo actualizado exitosamente.');
    } catch (QueryException $e) {
        return redirect()->back()->with('error', 'Error al actualizar el préstamo')->withInput();
    }
}
    public function destroy(Loans $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Préstamo eliminado exitosamente.');
    }
}
