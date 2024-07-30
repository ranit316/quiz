<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Application')</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('quiz.index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('quiz')}}">Quiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('question.create')}}">Question</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="">Settings</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.logout')}}">Logout</a>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Signup</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mt-4">
        @yield('content')
    </div>
    

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    @stack('scripts')
</body>
</html>
