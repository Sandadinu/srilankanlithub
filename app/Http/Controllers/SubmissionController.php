<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Submission;
use App\Mail\SubmissionConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    public function create()
    {
        $books = Book::select('id', 'title')->orderBy('title')->get();
        return view('submissions.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'book_id' => 'nullable|exists:books,id',
            'content' => 'required|string',
            'short_bio' => 'nullable|string',
        ]);

        // Save immediately to DB
        $submission = Submission::create($validated);

        // Attempt to send email, but don't block/break if it fails
        try {
            Mail::to($submission->email)
                ->send(new SubmissionConfirmation($submission));
        } catch (\Exception $e) {
             Log::error('Failed to send submission confirmation email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Thank you for your submission. Your essay has been received and will be reviewed carefully.');
    }
}
