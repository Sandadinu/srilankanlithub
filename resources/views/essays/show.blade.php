@extends('layouts.app')

@section('content')
<div class="container fade-in" style="margin-top: 3rem;">
    <div class="reader-container">
        <div style="text-align: center; margin-bottom: 5rem;">
            <h1 style="font-size: 3.5rem; margin-bottom: 1.5rem; line-height: 1.3;">{{ $essay->title }}</h1>
            <span style="display: block; font-size: 1.15rem; opacity: 0.6; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 1px;">
                By {{ $essay->contributor ? $essay->contributor->name : $essay->writer_name }}
            </span>
            <a href="/books/{{ $essay->book_id }}" style="display: inline-block; font-size: 1.1rem; color: var(--accent-gold); font-style: italic; transition: opacity 0.3s;">In response to: {{ $essay->book->title }}</a>
        </div>
        
        <div style="white-space: pre-wrap; font-size: 1.15rem; opacity: 0.85; line-height: 2.2; margin-bottom: 5rem;">{{ $essay->content }}</div>

        @if($essay->contributor && $essay->contributor->bio)
        <div style="background: rgba(0,0,0,0.02); padding: 3rem; border-radius: 4px; margin: 5rem 0; border-top: 1px solid rgba(0,0,0,0.05);">
            <h3 style="font-family: var(--font-body); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px; opacity: 0.5; margin-bottom: 1rem;">About the Contributor</h3>
            <p style="font-style: italic; opacity: 0.8; line-height: 1.8;">{{ $essay->contributor->bio }}</p>
        </div>
        @endif
        
        <div style="margin-top: 6rem; text-align: center; padding-top: 4rem; border-top: 1px solid rgba(0,0,0,0.05); display: flex; flex-direction: column; align-items: center; gap: 2rem;">
            <div style="max-width: 400px; opacity: 0.7; font-size: 0.95rem;">
                <p>Inspired to share your own thoughts on Sri Lankan literature?</p>
                <a href="/write-for-us" style="color: var(--accent-green); text-transform: uppercase; letter-spacing: 1px; font-weight: 500; font-size: 0.85rem;">Write for Us</a>
            </div>
            <a href="/books/{{ $essay->book_id }}" class="btn btn-outline" style="letter-spacing: 2px; width: auto; padding-left: 3rem; padding-right: 3rem;">&larr; Return to Book</a>
        </div>
    </div>
</div>
@endsection
