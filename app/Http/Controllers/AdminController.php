<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Essay;
use App\Models\Submission;
use App\Models\Contributor;
use App\Mail\SubmissionAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->latest()->get();
        $authors = Author::latest()->get();
        $essays = Essay::with('book')->latest()->get();
        
        return view('admin.dashboard', compact('books', 'authors', 'essays'));
    }

    // --- BOOKS ---
    public function createBook()
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'amazon_link' => 'nullable|url',
            'goodreads_link' => 'nullable|url',
            'awards' => 'nullable|array',
            'awards.*.name' => 'nullable|string|max:255',
            'awards.*.year' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads'), $imageName);
            $validated['image'] = 'uploads/'.$imageName;
        }

        $book = Book::create($validated);

        if (isset($validated['awards']) && is_array($validated['awards'])) {
            foreach ($validated['awards'] as $awardData) {
                if (!empty($awardData['name'])) {
                    $book->awards()->create([
                        'name' => $awardData['name'],
                        'year' => $awardData['year'] ?? ''
                    ]);
                }
            }
        }

        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Book created successfully.');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'amazon_link' => 'nullable|url',
            'goodreads_link' => 'nullable|url',
            'awards' => 'nullable|array',
            'awards.*.name' => 'nullable|string|max:255',
            'awards.*.year' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads'), $imageName);
            $validated['image'] = 'uploads/'.$imageName;
        }

        $book->update($validated);

        $book->awards()->delete();
        if (isset($validated['awards']) && is_array($validated['awards'])) {
            foreach ($validated['awards'] as $awardData) {
                if (!empty($awardData['name'])) {
                    $book->awards()->create([
                        'name' => $awardData['name'],
                        'year' => $awardData['year'] ?? ''
                    ]);
                }
            }
        }

        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Book updated successfully.');
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Book deleted successfully.');
    }

    // --- AUTHORS ---
    public function createAuthor()
    {
        return view('admin.authors.create');
    }

    public function storeAuthor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads'), $imageName);
            $validated['image'] = 'uploads/'.$imageName;
        }

        Author::create($validated);

        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Author created successfully.');
    }

    public function editAuthor($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    public function updateAuthor(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads'), $imageName);
            $validated['image'] = 'uploads/'.$imageName;
        }

        $author->update($validated);

        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Author updated successfully.');
    }

    // --- ESSAYS ---
    public function createEssay()
    {
        $books = Book::all();
        return view('admin.essays.create', compact('books'));
    }

    public function storeEssay(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'book_id' => 'required|exists:books,id',
            'writer_name' => 'required|string|max:255',
        ]);

        Essay::create($validated);

        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Essay created successfully.');
    }

    public function editEssay($id)
    {
        $essay = Essay::findOrFail($id);
        $books = Book::all();
        return view('admin.essays.edit', compact('essay', 'books'));
    }

    public function updateEssay(Request $request, $id)
    {
        $essay = Essay::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'book_id' => 'required|exists:books,id',
            'writer_name' => 'required|string|max:255',
        ]);

        $essay->update($validated);

        return redirect('/admin?key=' . env('ADMIN_KEY'))->with('success', 'Essay updated successfully.');
    }

    // --- SUBMISSIONS ---
    public function listSubmissions(Request $request)
    {
        $status = $request->query('status');
        $query = Submission::with('book')->latest();

        if ($status && in_array($status, ['pending', 'accepted', 'rejected'])) {
            $query->where('status', $status);
        }

        $submissions = $query->get();

        // Calculate counts for the filter tabs
        $counts = [
            'total'    => Submission::count(),
            'pending'  => Submission::where('status', 'pending')->count(),
            'accepted' => Submission::where('status', 'accepted')->count(),
            'rejected' => Submission::where('status', 'rejected')->count(),
        ];

        return view('admin.submissions.index', compact('submissions', 'counts', 'status'));
    }

    public function viewSubmission($id)
    {
        $submission = Submission::with('book')->findOrFail($id);
        return view('admin.submissions.show', compact('submission'));
    }

    public function updateSubmission(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'book_id' => 'nullable|exists:books,id',
            'short_bio' => 'nullable|string',
        ]);

        $submission->update($validated);

        return redirect()->back()->with('success', 'Submission updated successfully.');
    }

    public function acceptSubmission(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);
        $oldStatus = $submission->status;

        // 1. Create or Find Contributor (Email only for identification)
        $contributor = Contributor::where('email', $submission->email)->first();

        if (!$contributor) {
            $contributor = Contributor::create([
                'name' => $submission->name,
                'email' => $submission->email,
                'bio' => $submission->short_bio,
            ]);
        }

        // 2. Create or Update Essay (Idempotent)
        $essay = Essay::updateOrCreate(
            ['submission_id' => $submission->id],
            [
                'title' => $submission->title,
                'content' => $submission->content,
                'book_id' => $submission->book_id,
                'contributor_id' => $contributor->id,
                'writer_name' => $contributor->name,
                'is_published' => true, // Ensure it is published
            ]
        );

        // 3. Mark as Accepted
        $submission->update(['status' => 'accepted']);

        // 4. Send Notification (Only if it's a fresh acceptance)
        if ($oldStatus !== 'accepted') {
            try {
                Mail::to($submission->email)->send(new SubmissionAccepted($submission, $essay));
            } catch (\Exception $e) {
                Log::error("Failed to send acceptance email to {$submission->email}: " . $e->getMessage());
            }
        }

        return redirect('/admin/submissions?key=' . env('ADMIN_KEY'))->with('success', 'Submission accepted and published.');
    }

    public function rejectSubmission($id)
    {
        $submission = Submission::findOrFail($id);

        // 1. If an essay exists, unpublish it (don't delete)
        if ($submission->essay) {
            $submission->essay->update(['is_published' => false]);
        }

        // 2. Mark as Rejected
        $submission->update(['status' => 'rejected']);

        return redirect('/admin/submissions?key=' . env('ADMIN_KEY'))->with('success', 'Submission marked as rejected and essay unpublished.');
    }
}
