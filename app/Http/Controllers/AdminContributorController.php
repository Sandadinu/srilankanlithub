<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use Illuminate\Http\Request;

class AdminContributorController extends Controller
{
    public function index()
    {
        $contributors = Contributor::withCount('essays')->latest()->get();
        return view('admin.contributors.index', compact('contributors'));
    }

    public function show(Contributor $contributor)
    {
        // Load essays for the detail view
        $contributor->load('essays');
        return view('admin.contributors.show', compact('contributor'));
    }
}
