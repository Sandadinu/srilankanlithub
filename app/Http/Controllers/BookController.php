<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('author')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->paginate(9)->withQueryString();
        
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with([
            'author',
            'essays' => function($q) {
                $q->where('is_published', true)->latest();
            }
        ])->findOrFail($id);

        return view('books.show', compact('book'));
    }
}