@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div class="journal-container">
        <!-- HEADER SECTION -->
        <header class="submission-header">
            <h1>Write for Us</h1>
            <p class="submission-invitation">“Share your perspective on Sri Lankan literature with a global audience.”</p>
        </header>

        <!-- GUIDELINES SECTION -->
        <section class="editorial-guidelines">
            <p>
                We welcome original essays, reviews, and literary critiques focused on Sri Lankan English literature. 
                Our journal values clarity of thought, critical depth, and a pure passion for the written word. 
                Essays are typically between <strong>800–1500 words</strong>, though we prioritize substance over strict constraints. 
            </p>
        </section>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 3rem;">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM SECTION -->
        <div class="submission-journal-box">
            <form action="{{ url('/write-for-us') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="journal-label">Full Name</label>
                    <input type="text" name="name" class="journal-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label class="journal-label">Email Address</label>
                    <input type="email" name="email" class="journal-control" value="{{ old('email') }}" required>
                    <small class="bio-helper">We will use this to contact you regarding your submission.</small>
                </div>

                <div class="form-group">
                    <label class="journal-label">Essay Title</label>
                    <input type="text" name="title" class="journal-control" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label class="journal-label">Related Book (Optional)</label>
                    <select name="book_id" class="journal-control" style="border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 0.5rem; appearance: none;">
                        <option value="">-- Select a Book --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                {{ $book->title }}
                            </option>
                        @endforeach
                    </select>
                    <small class="bio-helper">If your essay is about a specific work in our database.</small>
                </div>

                <div class="form-group">
                    <label class="journal-label">Essay Content</label>
                    <textarea name="content" class="journal-control" style="min-height: 300px; resize: vertical;" required>{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="journal-label">Short Bio (Optional)</label>
                    <textarea name="short_bio" class="journal-control" style="min-height: 100px; resize: vertical;">{{ old('short_bio') }}</textarea>
                    <small class="bio-helper">If this is your first submission, you may include a short bio to introduce yourself.</small>
                </div>

                <div style="text-align: left;">
                    <button type="submit" class="btn-charcoal">Submit Essay</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
