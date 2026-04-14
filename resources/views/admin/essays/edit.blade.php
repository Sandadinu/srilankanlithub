@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Edit Critical Essay</h2>
    <a href="/admin?key={{ request()->query('key') }}" class="btn btn-outline">&larr; Back to Dashboard</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="/admin/essays/update/{{ $essay->id }}?key={{ request()->query('key') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="title">Essay Title</label>
            <input type="text" id="title" name="title" required value="{{ old('title', $essay->title) }}">
        </div>

        <div class="form-group">
            <label for="writer_name">Writer Name</label>
            <input type="text" id="writer_name" name="writer_name" required value="{{ old('writer_name', $essay->writer_name) }}">
        </div>

        <div class="form-group">
            <label for="book_id">Related Book</label>
            <select id="book_id" name="book_id" required>
                <option value="">-- Select Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id', $essay->book_id) == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="content">Essay Content</label>
            <textarea id="content" name="content" rows="15" required>{{ old('content', $essay->content) }}</textarea>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Update Essay</button>
        </div>
    </form>
</div>
@endsection
