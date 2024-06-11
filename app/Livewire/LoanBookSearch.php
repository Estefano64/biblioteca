<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class LoanBookSearch extends Component
{
    public $search = '';
    public $books = [];

    public function updatedSearch()
    {
        $this->books = Book::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('author', 'LIKE', "%{$this->search}%")
            ->where('is_loaned', false)
            ->get();
    }

    public function render()
    {
        return view('livewire.loan-book-search');
    }
}