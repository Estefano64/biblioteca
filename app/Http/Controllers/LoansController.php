<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;

class LoansController extends Controller
{
    public function index()
    {
        $loans = Loans::all();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $isAdmin = auth()->user()->usertype === 'admin';
        $start_date = Carbon::now()->format('Y-m-d');
        return view('loans.create', compact('isAdmin','start_date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required|string',
            'user_dni' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $isAdmin = auth()->user()->usertype === 'admin';

        if ($isAdmin) {
            $request->validate([
                'returned' => 'required|boolean',
            ]);
        }

        $book = Book::where('title', $request->book_title)->first();
        if (!$book) {
            return redirect()->back()->with('error', 'El libro no existe')->withInput();
        }

        if ($book->isLoaned()) {
            return redirect()->back()->with('error', 'El libro ya está prestado')->withInput();
        }

        $user = User::where('dni', $request->user_dni)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'El usuario no existe')->withInput();
        }

        try {
            Loans::create([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'returned' => $request->returned ?? false,
            ]);
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
            'book_title' => 'required|string',
            'user_dni' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'returned' => 'required|boolean',
        ]);

        $book = Book::where('title', $request->book_title)->first();
        if (!$book) {
            return redirect()->back()->with('error', 'El libro no existe')->withInput();
        }

        if ($book->isLoaned() && $loan->book_id != $book->id) {
            return redirect()->back()->with('error', 'El libro ya está prestado')->withInput();
        }

        $user = User::where('dni', $request->user_dni)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'El usuario no existe')->withInput();
        }

        try {
            $loan->update([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'returned' => $request->returned,
            ]);
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
