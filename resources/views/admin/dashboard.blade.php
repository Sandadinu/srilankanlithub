@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Dashboard Overview</h2>
</div>

@php
    $pendingSubmissions = \App\Models\Submission::where('status', 'pending')->count();
@endphp

@if($pendingSubmissions > 0)
<div class="card" style="border-left: 4px solid var(--accent-gold); background: #fffdf5;">
    <div class="header-actions">
        <div>
            <h3 style="margin-bottom: 0.5rem;">New Submissions</h3>
            <p style="margin: 0; opacity: 0.7; font-size: 0.9rem;">There are {{ $pendingSubmissions }} new essays waiting for review.</p>
        </div>
        <a href="/admin/submissions?key={{ request()->query('key') }}" class="btn btn-primary">Review Submissions</a>
    </div>
</div>
@endif

<div class="card" style="border-left: 4px solid #111827;">
    <div class="header-actions">
        <div>
            <h3 style="margin-bottom: 0.5rem;">Contributor Management</h3>
            @php
                $contributorCount = \App\Models\Contributor::count();
            @endphp
            <p style="margin: 0; opacity: 0.7; font-size: 0.9rem;">Manage all {{ $contributorCount }} literary contributors and their profiles.</p>
        </div>
        <a href="/admin/contributors?key={{ request()->query('key') }}" class="btn btn-outline">View Contributor Directory</a>
    </div>
</div>

<div class="card">
    <div class="header-actions">
        <h3>Books</h3>
        <a href="/admin/books/create?key={{ request()->query('key') }}" class="btn btn-primary">+ Add Book</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="/admin/books/edit/{{ $book->id }}?key={{ request()->query('key') }}" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Edit</a>
                    <a href="/admin/books/delete/{{ $book->id }}?key={{ request()->query('key') }}" onclick="return confirm('Are you sure you want to delete this book?');" class="btn btn-danger" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <div class="header-actions">
        <h3>Authors</h3>
        <a href="/admin/authors/create?key={{ request()->query('key') }}" class="btn btn-primary">+ Add Author</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Bio Snippet</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>{{ Str::limit($author->bio, 50) }}</td>
                <td>{{ $author->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="/admin/authors/edit/{{ $author->id }}?key={{ request()->query('key') }}" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="card">
    <div class="header-actions">
        <h3>Critical Essays</h3>
        <a href="/admin/essays/create?key={{ request()->query('key') }}" class="btn btn-primary">+ Add Essay</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Writer</th>
                <th>Related Book</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($essays as $essay)
            <tr>
                <td>{{ $essay->title }}</td>
                <td>{{ $essay->writer_name }}</td>
                <td>{{ $essay->book->title }}</td>
                <td>{{ $essay->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="/admin/essays/edit/{{ $essay->id }}?key={{ request()->query('key') }}" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Edit</a>
                    <a href="{{ route('essays.show', $essay) }}" class="btn btn-outline" target="_blank" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
