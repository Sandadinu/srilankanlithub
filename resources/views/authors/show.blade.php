@extends('layouts.app')

@section('content')
<div class="container fade-in" style="margin-top: 2rem;">
    <div style="max-width: 800px; margin: 0 auto; text-align: center;">
        @if($author->image)
            <img src="{{ asset($author->image) }}" alt="{{ $author->name }}" style="width: 280px; height: 280px; object-fit: cover; border-radius: 50%; box-shadow: var(--shadow-soft); margin-bottom: 3.5rem;">
        @else
            <div style="width: 280px; height: 280px; border-radius: 50%; background:#fff; border: 1px solid rgba(0,0,0,0.05); display:flex; align-items:center; justify-content:center; margin: 0 auto 3.5rem;">No Image</div>
        @endif
        
        <h1 style="font-size: 4rem; margin-bottom: 2.5rem; line-height: 1.2;">{{ $author->name }}</h1>
        
        <div class="reader-container" style="text-align: left; margin: 0 auto;">
            <div style="white-space: pre-wrap; font-size: 1.1rem; opacity: 0.85; line-height: 2.2;">{{ $author->bio }}</div>
        </div>
    </div>

    @if($author->books->count() > 0)
    <div style="margin-top: 8rem; padding-top: 5rem; border-top: 1px solid rgba(0,0,0,0.05);">
        <h2 class="section-title" style="margin-bottom: 4rem;">Selected Works</h2>
        <div class="grid">
            @foreach($author->books as $book)
            <a href="/book/{{ $book->id }}" class="card">
                @if($book->image)
                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                @else
                    <div style="width: 100%; aspect-ratio: 2/3; background:#fff; display:flex; align-items:center; justify-content:center; margin-bottom:1.5rem; border-radius: 2px;">No Image</div>
                @endif
                <h3 class="card-title">{{ $book->title }}</h3>
                <p style="font-size:0.95rem; opacity:0.8; line-height: 1.6;">{{ Str::limit($book->short_description, 100) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
