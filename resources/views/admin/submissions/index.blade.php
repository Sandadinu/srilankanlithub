@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Contributor Submissions</h2>
    <a href="/admin?key={{ request()->query('key') }}" class="btn btn-outline">Back to Dashboard</a>
</div>

<!-- FILTER TABS -->
<div style="display: flex; gap: 0.5rem; margin-bottom: 2rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 1rem;">
    <a href="/admin/submissions?key={{ request()->query('key') }}" 
       class="btn {{ !$status ? 'btn-primary' : 'btn-outline' }}" style="font-size: 0.8rem;">
       All ({{ $counts['total'] }})
    </a>
    <a href="/admin/submissions?key={{ request()->query('key') }}&status=pending" 
       class="btn {{ $status == 'pending' ? 'btn-primary' : 'btn-outline' }}" style="font-size: 0.8rem;">
       Pending ({{ $counts['pending'] }})
    </a>
    <a href="/admin/submissions?key={{ request()->query('key') }}&status=accepted" 
       class="btn {{ $status == 'accepted' ? 'btn-primary' : 'btn-outline' }}" style="font-size: 0.8rem;">
       Accepted ({{ $counts['accepted'] }})
    </a>
    <a href="/admin/submissions?key={{ request()->query('key') }}&status=rejected" 
       class="btn {{ $status == 'rejected' ? 'btn-primary' : 'btn-outline' }}" style="font-size: 0.8rem;">
       Rejected ({{ $counts['rejected'] }})
    </a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Contributor</th>
                <th>Essay Title</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $submission)
            <tr>
                <td>
                    <strong>{{ $submission->name }}</strong><br>
                    <span style="font-size: 0.8rem; opacity: 0.6;">{{ $submission->email }}</span>
                </td>
                <td>
                    {{ $submission->title }}<br>
                    @if($submission->book)
                        <span style="font-size: 0.8rem; font-style: italic; color: #6b7280;">Re: {{ $submission->book->title }}</span>
                    @endif
                </td>
                <td>
                    @if($submission->status == 'pending')
                        <span style="background: #fff3e0; color: #ffb100; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Pending</span>
                    @elseif($submission->status == 'accepted')
                        <span style="background: #e8f5e9; color: #2d5a27; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Accepted</span>
                    @else
                        <span style="background: #ffebee; color: #c62828; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">Rejected</span>
                    @endif
                </td>
                <td style="font-size: 0.9rem; opacity: 0.6;">
                    {{ $submission->created_at->format('M d, Y') }}
                </td>
                <td>
                    <a href="/admin/submissions/{{ $submission->id }}?key={{ request()->query('key') }}" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Review & Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($submissions->isEmpty())
        <p style="text-align: center; padding: 3rem; opacity: 0.5;">No submissions found for this category.</p>
    @endif
</div>
@endsection
