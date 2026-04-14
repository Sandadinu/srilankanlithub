<?php

namespace App\Http\Controllers;

use App\Models\Essay;
use Illuminate\Http\Request;

class EssayController extends Controller
{
    public function index()
    {
        $essays = Essay::where('is_published', true)->with('book.author')->latest()->paginate(12);
        return view('essays.index', compact('essays'));
    }

    public function show(Essay $essay)
    {
        if (!$essay->is_published) {
            abort(404);
        }
        return view('essays.show', compact('essay'));
    }
}
