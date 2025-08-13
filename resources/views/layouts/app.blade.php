<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaskForge')</title>
    <!-- Core CSS -->
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet">
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-200">
    @include('partials.sidebar')
    <main class="main-content position-relative border-radius-lg" style="margin-left: 250px;">

    <div class="container-fluid py-4">
        @yield('content')
    </div>

    @include('partials.footer')
</main>

    <!-- Core JS -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/material-dashboard.min.js') }}"></script>
</body>
</html>
