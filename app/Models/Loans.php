<?php

// app/Models/Loan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id', 'start_date', 'due_date', 'returned']; // Campos que pueden ser asignados masivamente

    // Método para obtener el libro relacionado con este préstamo
    public function book()
    {
        // Define una relación inversa uno a muchos con el modelo Book
        return $this->belongsTo(Book::class);
    }

    // Método para obtener el usuario relacionado con este préstamo
    public function user()
    {
        // Define una relación inversa uno a muchos con el modelo User
        return $this->belongsTo(User::class);
    }
}

