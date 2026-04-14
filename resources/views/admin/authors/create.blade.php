@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Add New Author</h2>
    <a href="/admin?key={{ request()->query('key') }}" class="btn btn-outline">&larr; Back to Dashboard</a>
</div>

<div class="card" style="max-width: 800px;">
    <form action="/admin/authors/store?key={{ request()->query('key') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="name">Author Name</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="image">Author Portrait (Optional)</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="bio">Biography</label>
            <textarea id="bio" name="bio" rows="8" required>{{ old('bio') }}</textarea>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Save Author</button>
        </div>
    </form>
</div>
@endsection
