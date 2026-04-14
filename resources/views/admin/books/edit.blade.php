@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Edit Book: {{ $book->title }}</h2>
    <a href="/admin?key={{ request()->query('key') }}" class="btn btn-outline">&larr; Back to Dashboard</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="/admin/books/update/{{ $book->id }}?key={{ request()->query('key') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Book Title</label>
            <input type="text" id="title" name="title" required value="{{ old('title', $book->title) }}">
        </div>

        <div class="form-group">
            <label for="author_id">Author</label>
            <select id="author_id" name="author_id" required>
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="published_year">Published Year (Optional)</label>
            <input type="text" id="published_year" name="published_year" value="{{ old('published_year', $book->published_year) }}">
        </div>

        <div class="form-group">
            <label for="genre">Genre (Optional)</label>
            <input type="text" id="genre" name="genre" value="{{ old('genre', $book->genre) }}">
        </div>

        <div class="form-group" style="padding: 1.5rem; background: #faf9f7; border-radius: 6px; border: 1px solid rgba(0,0,0,0.05); margin-bottom: 2rem;">
            <label style="margin-bottom: 1rem; display: block; font-weight: 600; color: #333;">Awards / Prizes</label>
            <div id="awards-container"></div>
            <button type="button" class="btn btn-outline" style="font-size: 0.85rem; margin-top: 0.5rem;" onclick="addAwardRow()">+ Add Award</button>
        </div>

        <script>
            let awardIndex = 0;
            function addAwardRow(name = '', year = '') {
                const container = document.getElementById('awards-container');
                const row = document.createElement('div');
                row.style.display = 'flex';
                row.style.gap = '10px';
                row.style.marginBottom = '10px';
                
                // Properly escape strings to prevent XSS and JS injection issues since this is injected via Blade
                // A typical way is to ensure name and year values are safe.
                row.innerHTML = `
                    <input type="text" name="awards[${awardIndex}][name]" placeholder="Award Name (e.g. Booker Prize)" value="${name.replace(/"/g, '&quot;')}" style="flex: 2; margin-bottom: 0;">
                    <input type="text" name="awards[${awardIndex}][year]" placeholder="Year (e.g. 2022)" value="${year.replace(/"/g, '&quot;')}" style="flex: 1; margin-bottom: 0;">
                    <button type="button" class="btn btn-danger" style="padding: 0 15px; border-radius: 4px;" onclick="this.parentElement.remove()">X</button>
                `;
                container.appendChild(row);
                awardIndex++;
            }
            
            document.addEventListener("DOMContentLoaded", function() {
                @if(isset($book->awards) && $book->awards->count() > 0)
                    @foreach($book->awards as $award)
                        addAwardRow("{{ str_replace('"', '\"', $award->name) }}", "{{ str_replace('"', '\"', $award->year) }}");
                    @endforeach
                @else
                    addAwardRow();
                @endif
            });
        </script>

        <div class="form-group">
            <label for="image">Cover Image (Leave blank to keep current)</label>
            @if($book->image)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset($book->image) }}" alt="Current Image" style="width: 100px; border-radius: 4px;">
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="short_description">Short Description (Summary)</label>
            <textarea id="short_description" name="short_description" rows="3" required>{{ old('short_description', $book->short_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" rows="10" required>{{ old('description', $book->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="amazon_link">Amazon Link (Optional)</label>
            <input type="url" id="amazon_link" name="amazon_link" value="{{ old('amazon_link', $book->amazon_link) }}">
        </div>

        <div class="form-group">
            <label for="goodreads_link">Goodreads Link (Optional)</label>
            <input type="url" id="goodreads_link" name="goodreads_link" value="{{ old('goodreads_link', $book->goodreads_link) }}">
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Update Book</button>
        </div>
    </form>
</div>
@endsection
