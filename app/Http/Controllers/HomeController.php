<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::with('author')->latest()->take(3)->get();
        return view('pages.home', compact('featuredBooks'));
    }
}
