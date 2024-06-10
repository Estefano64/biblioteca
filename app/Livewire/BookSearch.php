<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class BookSearch extends Component
{
    public $search = '';
    public $books = [];

    public function updatedSearch()
    {
        $this->books = Book::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('author', 'LIKE', "%{$this->search}%")
            ->get();
    }

    public function render()
    {
        return view('livewire.book-search');
    }
}