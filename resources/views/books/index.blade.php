@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <h1 class="section-title">The Collection</h1>
    
    <style>
        .premium-search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 6rem;
            width: 100%;
            padding: 0 1rem;
            box-sizing: border-box;
        }
        
        .premium-search-wrapper {
            display: flex;
            align-items: center;
            background-color: #fdfcfb; /* Premium warm paper tint */
            border-radius: 12px;
            width: 100%;
            max-width: 680px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        
        .premium-search-wrapper:focus-within {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            border-color: rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .premium-search-spacer {
            width: 110px;
            flex-shrink: 0;
        }

        .premium-search-input {
            flex-grow: 1;
            background: transparent;
            border: none;
            outline: none;
            padding: 1.4rem 0;
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            color: #2c2a28;
            text-align: center;
        }

        .premium-search-input::placeholder {
            color: #a19d98;
            font-weight: 300;
            letter-spacing: 0.02em;
            transition: opacity 0.3s ease;
        }
        
        .premium-search-input:focus::placeholder {
            opacity: 0.4;
        }

        .premium-search-button {
            width: 110px;
            flex-shrink: 0;
            background: transparent;
            border: none;
            padding: 1.4rem 0;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            color: #63605a;
            cursor: pointer;
            transition: color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            text-align: center;
        }

        .premium-search-button:hover {
            color: #111;
        }
    </style>

    <div class="premium-search-container">
        <form action="/books" method="GET" class="premium-search-wrapper">
            <div class="premium-search-spacer"></div>
            <input type="text" name="search" class="premium-search-input" placeholder="Search by title or author..." value="{{ request('search') }}" autocomplete="off">
            <button type="submit" class="premium-search-button">Search</button>
        </form>
    </div>

    <div class="grid">
        @foreach($books as $book)
        <a href="/book/{{ $book->id }}" class="card">
            @if($book->image)
                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
            @else
                <div style="width: 100%; aspect-ratio: 2/3; background:#fff; display:flex; align-items:center; justify-content:center; margin-bottom:1.5rem; border-radius: 2px;">No Image</div>
            @endif
            <h3 class="card-title">{{ $book->title }}</h3>
            <span class="card-subtitle">{{ $book->author->name }}</span>
            <p style="font-size:0.9rem; opacity:0.8;">{{ Str::limit($book->short_description, 120) }}</p>
        </a>
        @endforeach
    </div>

    @if($books->isEmpty())
        <div class="text-center mt-4">
            <p style="font-size: 1.1rem; opacity: 0.6;">No works found matching your perspective.</p>
        </div>
    @endif

    <div style="margin-top: 4rem;">
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
