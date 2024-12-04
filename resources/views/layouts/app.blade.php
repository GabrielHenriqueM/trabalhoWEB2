<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head') 
</head>
<body>
    @include('layouts.navigation')

    <div class="container mt-4">
        @yield('content') 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
