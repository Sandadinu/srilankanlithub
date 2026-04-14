@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <div>
        <a href="/admin/contributors?key={{ request()->query('key') }}" style="font-size: 0.9rem; opacity: 0.6; text-decoration: none;">&larr; Back to Directory</a>
        <h2 style="margin-top: 0.5rem;">Contributor: {{ $contributor->name }}</h2>
    </div>
</div>

<div class="card">
    <h3 style="margin-top: 0; font-size: 1.1rem; border-bottom: 1px solid #eee; padding-bottom: 0.8rem;">Profile Overview</h3>
    <div style="margin-top: 1.5rem;">
        <p><strong>Email:</strong> {{ $contributor->email }}</p>
        <p><strong>Bio:</strong></p>
        <div style="background: #fcfcfc; padding: 1.5rem; border-radius: 4px; border-left: 3px solid #eee; font-style: italic; color: #555;">
            {{ $contributor->bio ?: 'No biography provided.' }}
        </div>
    </div>
</div>

<div class="card">
    <h3 style="margin-top: 0; font-size: 1.1rem; border-bottom: 1px solid #eee; padding-bottom: 0.8rem;">Published Essays</h3>
    @if($contributor->essays->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Essay Title</th>
                <th>Related Book</th>
                <th>Published Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contributor->essays as $essay)
            <tr>
                <td>{{ $essay->title }}</td>
                <td>{{ $essay->book->title }}</td>
                <td>{{ $essay->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="/essays/{{ $essay->slug }}" target="_blank" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">View Publicly</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="opacity: 0.5; font-style: italic; margin-top: 1.5rem;">No essays published by this contributor yet.</p>
    @endif
</div>
@endsection
