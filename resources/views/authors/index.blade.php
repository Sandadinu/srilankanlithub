@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <h1 class="section-title">The Voices</h1>
    
    <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 5rem;">
        @foreach($authors as $author)
        <a href="/author/{{ $author->id }}" class="card" style="text-align: center; box-shadow: none;">
            @if($author->image)
                <img src="{{ asset($author->image) }}" alt="{{ $author->name }}" style="aspect-ratio: 1/1; border-radius: 50%; width: 220px; height: 220px; margin: 0 auto 2.5rem; box-shadow: var(--shadow-soft);">
            @else
                <div style="aspect-ratio: 1/1; border-radius: 50%; width: 220px; height: 220px; margin: 0 auto 2.5rem; background:#fff; border: 1px solid rgba(0,0,0,0.05); display:flex; align-items:center; justify-content:center;">No Image</div>
            @endif
            <h3 class="card-title" style="font-size: 1.6rem; letter-spacing: 0.5px;">{{ $author->name }}</h3>
        </a>
        @endforeach
    </div>

    @if($authors->isEmpty())
        <div class="text-center mt-4">
            <p style="font-size: 1.1rem; opacity: 0.6;">No voices found in the archive.</p>
        </div>
    @endif

    <div style="margin-top: 5rem;">
        {{ $authors->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
