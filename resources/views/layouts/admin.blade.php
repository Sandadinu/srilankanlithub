<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SL Lit Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; color: #111827; margin: 0; padding: 0; }
        .navbar { background: #111827; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: white; text-decoration: none; font-weight: 500; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        .card { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { text-align: left; padding: 0.75rem; border-bottom: 1px solid #e5e7eb; }
        th { font-weight: 500; color: #6b7280; text-transform: uppercase; font-size: 0.8rem; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 4px; border: 1px solid transparent; cursor: pointer; text-decoration: none; font-size: 0.9rem; }
        .btn-primary { background: #2563eb; color: white; }
        .btn-outline { border-color: #d1d5db; color: #374151; }
        .btn-danger { background: #dc2626; color: white; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.9rem; }
        input, textarea, select { width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 4px; font-family: 'Inter', sans-serif; box-sizing: border-box; }
        .alert-success { padding: 1rem; background: #dcfce3; color: #166534; border-radius: 4px; margin-bottom: 1rem; }
        .alert-danger { padding: 1rem; background: #fee2e2; color: #991b1b; border-radius: 4px; margin-bottom: 1rem; }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div style="display: flex; align-items: center; gap: 2rem;">
            <a href="/admin?key={{ request()->query('key') }}" style="font-size: 1.1rem; font-weight: 600;">SL Lit Hub Admin</a>
            <div style="display: flex; gap: 1.5rem; margin-left: 2rem; border-left: 1px solid rgba(255,255,255,0.2); padding-left: 2rem;">
                <a href="/admin?key={{ request()->query('key') }}" style="font-size: 0.9rem; opacity: 0.8;">Dashboard</a>
                <a href="/admin/submissions?key={{ request()->query('key') }}" style="font-size: 0.9rem; opacity: 0.8;">Submissions</a>
                <a href="/admin/contributors?key={{ request()->query('key') }}" style="font-size: 0.9rem; opacity: 0.8;">Contributors</a>
            </div>
        </div>
        <a href="/" target="_blank" style="font-size: 0.9rem; opacity: 0.7;">View Live Site &rarr;</a>
    </nav>
    <main class="container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-danger">
                <ul style="margin:0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
