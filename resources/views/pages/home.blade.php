@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero fade-in">
    <div class="hero-content text-center">
        <p class="hero-tagline">A quiet collection of Sri Lankan voices</p>
        <h1>Where Sri Lankan Stories Meet the World</h1>
        <p class="hero-subtext">
            Discover voices shaped by history, identity, and quiet resilience.<br>
            Brought together for readers who seek depth beyond the surface.
        </p>
        <a href="/books" class="btn">Explore Collection</a>
    </div>
    <div class="scroll-indicator fade-in-delayed">
        &darr;
    </div>
</section>

<!-- FEATURED BOOKS -->
<section class="container fade-in">
    <h2 class="section-title">Featured Works</h2>

    <div class="grid">
        @foreach($featuredBooks as $book)
        <a href="/book/{{ $book->id }}" class="card">
            
            <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="card-image">

            <h3 class="card-title">{{ $book->title }}</h3>
            <span class="card-subtitle">{{ $book->author->name }}</span>

            <p class="card-description">
                {{ Str::limit($book->short_description, 110) }}
            </p>
        </a>
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 4rem;">
        <a href="/books" style="font-size: 1.1rem; font-weight: 400; letter-spacing: 1px; border-bottom: 1px solid var(--accent-gold); padding-bottom: 4px;">
            Explore More Works &rarr;
        </a>
    </div>
</section>

<!-- WHY THIS MATTERS -->
<section class="container fade-in highlight-section">
    <div class="reader-container text-center">
        <h2 class="section-title">Why This Matters</h2>

        <p class="text-body-large">
            Sri Lankan English literature captures the complexities of a nation shaped by colonialism, fractured by civil war, and bound by an enduring search for identity. These works are not merely stories. They are reflections of memory, silence, and survival.
        </p>

        <p class="text-body">
            Through these narratives, readers encounter perspectives that are often overlooked, yet deeply relevant to understanding both history and humanity.
        </p>
    </div>
</section>



@endsection