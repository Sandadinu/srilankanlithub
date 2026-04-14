@extends('layouts.app')

@section('content')
<div class="container fade-in">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 class="book-title" style="font-size: 2.2rem; margin-bottom: 0;">Review Submission</h1>
        <a href="/admin/submissions?key={{ env('ADMIN_KEY') }}" class="btn-outline" style="width: auto; padding: 0.5rem 1.5rem;">Back to List</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="book-layout">
        <!-- Sidebar: Submission Info -->
        <div class="book-sidebar">
            <div class="guidelines-box" style="margin-bottom: 2rem; border-left-color: var(--accent-gold);">
                <h3 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 1px;">Submission Info</h3>
                <p><strong>Contributor:</strong> {{ $submission->name }}</p>
                <p><strong>Email:</strong> {{ $submission->email }}</p>
                <p><strong>Date:</strong> {{ $submission->created_at->format('M d, Y') }}</p>
                <p><strong>Status:</strong> 
                    @if($submission->status == 'pending')
                        <span style="background: #fff3e0; color: #ffb100; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600;">PENDING</span>
                    @elseif($submission->status == 'accepted')
                        <span style="background: #e8f5e9; color: #2d5a27; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600;">ACCEPTED</span>
                    @else
                        <span style="background: #ffebee; color: #c62828; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600;">REJECTED</span>
                    @endif
                </p>
                @if($submission->book)
                    <p><strong>Related Book:</strong> {{ $submission->book->title }}</p>
                @endif
            </div>

            <div class="guidelines-box" style="background: rgba(0,0,0,0.02); border-left-color: #ddd;">
                <h3 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 1px;">Editorial Policy</h3>
                <p style="font-size: 0.9rem; opacity: 0.7;">Edits should be limited to <strong>grammar, clarity, and formatting</strong>. Avoid altering the original meaning of the essay.</p>
            </div>

            <div style="margin-top: 2rem; display: flex; flex-direction: column; gap: 1rem;">
                @if($submission->status == 'pending')
                    <form action="/admin/submissions/{{ $submission->id }}/accept?key={{ env('ADMIN_KEY') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn" style="width: 100%; cursor: pointer;">Accept & Publish</button>
                    </form>
                    <form action="/admin/submissions/{{ $submission->id }}/reject?key={{ env('ADMIN_KEY') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-outline" style="width: 100%; cursor: pointer; border-color: #c62828; color: #c62828;">Reject Submission</button>
                    </form>
                @elseif($submission->status == 'accepted')
                     <form action="/admin/submissions/{{ $submission->id }}/reject?key={{ env('ADMIN_KEY') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-outline" style="width: 100%; cursor: pointer; border-color: #c62828; color: #c62828;">Unpublish & Reject</button>
                    </form>
                @elseif($submission->status == 'rejected')
                    <form action="/admin/submissions/{{ $submission->id }}/accept?key={{ env('ADMIN_KEY') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn" style="width: 100%; cursor: pointer;">Re-accept & Publish</button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Main Content: Editor -->
        <div class="book-content">
            <div class="form-section" style="margin-top: 0; padding: 2rem;">
                <form action="/admin/submissions/{{ $submission->id }}?key={{ env('ADMIN_KEY') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $submission->title) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Content (Editorial Draft)</label>
                        <textarea name="content" class="form-control" style="min-height: 500px;">{{ old('content', $submission->content) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contributor Bio</label>
                        <textarea name="short_bio" class="form-control" style="min-height: 100px;">{{ old('short_bio', $submission->short_bio) }}</textarea>
                    </div>

                    <button type="submit" class="btn-outline" style="width: auto; padding: 0.8rem 2.5rem;">Save Editorial Edits</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
