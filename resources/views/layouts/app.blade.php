<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split Bill App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .split-navbar {
            background: linear-gradient(135deg, #4c6fe2ff, #290555ff);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 0.8rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1.2rem !important;
            border-radius: 50px;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
            color: rgba(255,255,255,0.9) !important;
        }
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: white !important;
        }
       
        .card {
            transition: transform 0.2s;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            background-color: #4c6fe2ff;
            border-color: #4c6fe2ff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg split-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">SplitBill</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                style="border: none; outline: none; box-shadow: none;">
                <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox=\'0 0 30 30\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath stroke=\'rgba(255,255,255,1)\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M4 7h22M4 15h22M4 23h22\'/%3E%3C/svg%3E');"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bills') ? 'active' : '' }}" href="{{ url('/bills') }}">My Bills</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>