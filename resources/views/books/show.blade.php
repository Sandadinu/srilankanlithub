@extends('layouts.app')

@section('content')

<div class="container fade-in book-page">

    <style>
        .book-page-wrapper {
            display: flex;
            gap: 5rem;
            align-items: flex-start;
            padding: 2rem 0 6rem 0;
            max-width: 1100px;
            margin: 0 auto;
        }

        .book-left-panel {
            width: 300px;
            flex-shrink: 0;
            position: sticky;
            top: 6rem;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }

        .premium-book-cover {
            width: 100%;
            height: auto;
            aspect-ratio: 2 / 3;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12), 0 4px 12px rgba(0, 0, 0, 0.06);
            display: block; /* prevents inline baseline gap */
        }

        .premium-book-cover-placeholder {
            width: 100%;
            aspect-ratio: 2 / 3;
            background-color: #fdfcfb;
            border: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.05);
            color: #a19d98;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
        }

        .book-metadata-panel {
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
        }

        .metadata-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .metadata-label {
            color: #9c9994;
        }
        
        .metadata-value {
            font-weight: 500;
            color: #3b3834;
        }

        .premium-links-container {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .premium-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 1.1rem;
            background: #f4efeb; /* Soft contrasting warm beige */
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 6px;
            color: #3b3631;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .premium-action-btn:hover {
            background: #ebe5df;
            border-color: rgba(0, 0, 0, 0.1);
            color: #1a1816;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        .book-right-content {
            flex-grow: 1;
            padding-top: 1rem;
            max-width: 650px;
        }
        
        @media (max-width: 900px) {
            .book-page-wrapper {
                flex-direction: column;
                gap: 4rem;
                align-items: center;
            }
            .book-left-panel {
                position: static;
                width: 100%;
                max-width: 320px;
            }
        }
    </style>

    <div class="book-page-wrapper">

        <!-- LEFT PANEL: COVER, META, ACTIONS -->
        <div class="book-left-panel">

            @if($book->image)
                <img src="{{ asset($book->image) }}" alt="" class="premium-book-cover">
            @else
                <div class="premium-book-cover-placeholder">Cover Not Available</div>
            @endif

            @if($book->published_year || $book->genre)
            <div class="book-metadata-panel">
                @if($book->published_year)
                <div class="metadata-row">
                    <span class="metadata-label">Published</span>
                    <span class="metadata-value">{{ $book->published_year }}</span>
                </div>
                @endif
                @if($book->genre)
                <div class="metadata-row">
                    <span class="metadata-label">Genre</span>
                    <span class="metadata-value">{{ $book->genre }}</span>
                </div>
                @endif
            </div>
            @endif

            @if(isset($book->awards) && $book->awards->count() > 0)
            <div class="book-awards-panel" style="margin-top: -1rem; padding-top: 1rem; border-top: 1px solid rgba(0,0,0,0.04);">
                <span class="metadata-label" style="display:block; margin-bottom:0.6rem; font-size: 0.85rem; font-family: 'Inter', sans-serif;">Awards & Recognition</span>
                @foreach($book->awards as $award)
                <div style="font-family: 'Inter', sans-serif; font-size: 0.9rem; color: #3b3834; font-weight: 500; margin-bottom: 0.4rem; padding-left: 0.2rem; border-left: 2px solid #e0ddd8;">
                    {{ $award->name }} <span style="font-weight:400; color:#888;">— {{ $award->year }}</span>
                </div>
                @endforeach
            </div>
            @endif

            <div class="premium-links-container">
                @if($book->amazon_link)
                    <a href="{{ $book->amazon_link }}" target="_blank" class="premium-action-btn">View on Amazon</a>
                @endif

                @if($book->goodreads_link)
                    <a href="{{ $book->goodreads_link }}" target="_blank" class="premium-action-btn">Explore on Goodreads</a>
                @endif

                <a href="/write-for-us?book_id={{ $book->id }}" class="premium-action-btn" style="background: #e9ece6; color: #4e5d44; border-color: rgba(107, 122, 97, 0.1);">Write an Essay</a>
            </div>

        </div>

        <!-- RIGHT PANEL: CONTENT -->
        <div class="book-right-content">

            <h1 class="book-title">{{ $book->title }}</h1>

            <a href="/author/{{ $book->author_id }}" class="book-author">
                By {{ $book->author->name }}
            </a>

            <p class="book-short-description">
                {{ $book->short_description }}
            </p>

            <div class="book-description">
                {{ $book->description }}
            </div>

        </div>

    </div>

    <!-- ESSAYS -->
    <div class="book-essays" style="margin-top: 4rem;">

        <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 3rem;">
            <h2 class="section-title" style="margin-bottom: 0;">Related Insights</h2>
            <a href="/write-for-us?book_id={{ $book->id }}" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: var(--accent-green); font-weight: 500;">Contribute your own &rarr;</a>
        </div>

        @if($book->essays->count() > 0)
        <div class="grid essays-grid">

            @foreach($book->essays as $essay)
            <a href="{{ route('essays.show', $essay) }}" class="card essay-card">

                <h3 class="essay-title">{{ $essay->title }}</h3>

                <span class="essay-writer">
                    By {{ $essay->contributor ? $essay->contributor->name : $essay->writer_name }}
                </span>

                <p class="essay-excerpt">
                    {{ $essay->excerpt }}
                </p>

                <span class="essay-read-more">
                    Read Insight →
                </span>

            </a>
            @endforeach

        </div>
        @else
        <div style="text-align: center; padding: 4rem; background: rgba(0,0,0,0.02); border-radius: 4px;">
            <p style="opacity: 0.6; font-style: italic;">No essays have been written for this book yet.</p>
            <a href="/write-for-us?book_id={{ $book->id }}" class="btn-outline" style="width: auto; padding: 0.8rem 2rem; margin-top: 1.5rem;">Be the first to contribute</a>
        </div>
        @endif

    </div>

</div>

@endsection