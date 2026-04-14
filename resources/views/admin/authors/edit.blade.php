@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Edit Author</h2>
    <a href="/admin?key={{ request()->query('key') }}" class="btn btn-outline">&larr; Back to Dashboard</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="/admin/authors/update/{{ $author->id }}?key={{ request()->query('key') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Author Name</label>
            <input type="text" id="name" name="name" required value="{{ old('name', $author->name) }}">
        </div>

        <div class="form-group">
            <label for="image">Author Portrait (Optional - Upload to replace current)</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if($author->image)
                <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #666;">Current Image: 
                    <img src="{{ asset($author->image) }}" alt="Current Image" style="max-height: 50px; vertical-align: middle; margin-left: 10px; border-radius: 4px;">
                </p>
            @endif
        </div>

        <div class="form-group">
            <label for="bio">Biography</label>
            <textarea id="bio" name="bio" rows="8" required>{{ old('bio', $author->bio) }}</textarea>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Update Author</button>
        </div>
    </form>
</div>
@endsection
