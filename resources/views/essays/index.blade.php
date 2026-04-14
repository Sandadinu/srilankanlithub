@extends('layouts.app')

@section('content')

<div class="container fade-in">

    <!-- HEADER -->
    <div class="page-intro text-center">
        <h1 class="section-title">Critical Reflections</h1>

        <p class="text-body-large">
            Thoughtful interpretations, thematic explorations, and critical perspectives on the works that shape Sri Lankan literary identity.
        </p>
    </div>

    <!-- ESSAY GRID -->
    <div class="grid essays-grid">
        @foreach($essays as $essay)
        <a href="{{ route('essays.show', $essay) }}" class="card essay-card">

            <h3 class="essay-title">
                {{ $essay->title }}
            </h3>

            <span class="essay-writer">
                Written by {{ $essay->writer_name }}
            </span>

            <div class="essay-book">
                Reflecting on: {{ $essay->book->title }}
            </div>

            <p class="essay-excerpt">
                {{ $essay->excerpt }}
            </p>

            <span class="essay-read-more">
                Read Essay →
            </span>

        </a>
        @endforeach
    </div>

    <!-- EMPTY STATE -->
    @if($essays->isEmpty())
        <div class="text-center mt-4">
            <p class="empty-text">No critical essays found.</p>
        </div>
    @endif

    <!-- PAGINATION -->
    <div class="pagination-container">
        {{ $essays->links() }}
    </div>

</div>

@endsection