@extends('layouts.admin')

@section('content')
<div class="header-actions">
    <h2>Contributor Directory</h2>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Published Essays</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contributors as $contributor)
            <tr>
                <td><strong>{{ $contributor->name }}</strong></td>
                <td>{{ $contributor->email }}</td>
                <td>{{ $contributor->essays_count }}</td>
                <td>
                    <a href="/admin/contributors/{{ $contributor->slug }}?key={{ request()->query('key') }}" class="btn btn-outline" style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">View Profile</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($contributors->isEmpty())
<p style="text-align: center; opacity: 0.5; margin-top: 2rem;">No contributors found in the system yet.</p>
@endif
@endsection
