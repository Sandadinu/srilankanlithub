<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Lankan English Literature Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="fade-in">
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="brand">Sri Lankan English Literature Hub</a>
            <ul class="nav-links">
		<li><a href="/">Home</a></li>
                <li><a href="/books">Books</a></li>
                <li><a href="/authors">Authors</a></li>
                <li><a href="/essays">Essays</a></li>
                <li><a href="/write-for-us">Write for Us</a></li>
                <li><a href="/about">About</a></li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Sri Lankan English Literature Hub.<br>A digital sanctuary for literature.</p>
        </div>
    </footer>
</body>
</html>
