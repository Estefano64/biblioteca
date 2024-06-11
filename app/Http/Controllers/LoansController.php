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
    // Método para mostrar todos los préstamos
    public function index()
    {
        $loans = Loans::all(); // Obtener todos los préstamos
        return view('loans.index', compact('loans')); // Pasar los préstamos a la vista
    }

    // Método para mostrar el formulario de creación de préstamo
    public function create()
    {
        $isAdmin = auth()->user()->usertype === 'admin'; // Verificar si el usuario es administrador
        $start_date = Carbon::now()->format('Y-m-d'); // Obtener la fecha actual
        return view('loans.create', compact('isAdmin','start_date')); // Pasar los datos a la vista
    }

    // Método para almacenar un nuevo préstamo
    public function store(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'book_title' => 'required|string',
            'user_dni' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $isAdmin = auth()->user()->usertype === 'admin'; // Verificar si el usuario es administrador

        // Si es administrador, validar el campo 'returned'
        if ($isAdmin) {
            $request->validate([
                'returned' => 'required|boolean',
            ]);
        }

        $book = Book::where('title', $request->book_title)->first(); // Buscar el libro por título
        if (!$book) {
            return redirect()->back()->with('error', 'El libro no existe')->withInput(); // Libro no encontrado
        }

        if ($book->isLoaned()) {
            return redirect()->back()->with('error', 'El libro ya está prestado')->withInput(); // Libro ya prestado
        }

        $user = User::where('dni', $request->user_dni)->first(); // Buscar el usuario por DNI
        if (!$user) {
            return redirect()->back()->with('error', 'El usuario no existe')->withInput(); // Usuario no encontrado
        }

        try {
            // Crear un nuevo préstamo
            Loans::create([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'returned' => $request->returned ?? false, // Si no se envía 'returned', se establece en false
            ]);
            return redirect()->route('loans.index')->with('success', 'Préstamo creado exitosamente.'); // Redirigir con mensaje de éxito
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al crear el préstamo')->withInput(); // Error al crear el préstamo
        }
    }

    // Método para mostrar los detalles de un préstamo
    public function show(Loans $loan)
    {
        return view('loans.show', compact('loan')); // Pasar el préstamo a la vista
    }

    // Método para mostrar el formulario de edición de préstamo
    public function edit(Loans $loan)
    {
        return view('loans.edit', compact('loan')); // Pasar el préstamo a la vista
    }

    // Método para actualizar un préstamo
    public function update(Request $request, Loans $loan)
    {
        // Validar los datos enviados
        $request->validate([
            'book_title' => 'required|string',
            'user_dni' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'returned' => 'required|boolean',
        ]);

        $book = Book::where('title', $request->book_title)->first(); // Buscar el libro por título
        if (!$book) {
            return redirect()->back()->with('error', 'El libro no existe')->withInput(); // Libro no encontrado
        }

        if ($book->isLoaned() && $loan->book_id != $book->id) {
            return redirect()->back()->with('error', 'El libro ya está prestado')->withInput(); // Libro ya prestado
        }

        $user = User::where('dni', $request->user_dni)->first(); // Buscar el usuario por DNI
        if (!$user) {
            return redirect()->back()->with('error', 'El usuario no existe')->withInput(); // Usuario no encontrado
        }

        try {
            // Actualizar el préstamo
            $loan->update([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'returned' => $request->returned,
            ]);
            return redirect()->route('loans.index')->with('success', 'Préstamo actualizado exitosamente.'); // Redirigir con mensaje de éxito
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error al actualizar el préstamo')->withInput(); // Error al actualizar el préstamo
        }
    }

    // Método para eliminar un préstamo
    public function destroy(Loans $loan)
    {
        $loan->delete(); // Eliminar el préstamo
        return redirect()->route('loans.index')->with('success', 'Préstamo eliminado exitosamente.'); // Redirigir con mensaje de éxito
    }
}