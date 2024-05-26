<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode@1.4.0/dist/html5-qrcode.min.js"></script>
    <style>
        .active {
            font-weight: bold;
            color: #007bff;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Attendance System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('employees') ? 'active' : '' }}" href="{{ route('employees.index') }}">Employee List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('attendance/scan') ? 'active' : '' }}" href="{{ route('attendance.scan') }}">Scan Here</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        @if(Request::is('/'))
            <div class="alert alert-primary" role="alert">
                Welcome to the Employee Attendance System!
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
