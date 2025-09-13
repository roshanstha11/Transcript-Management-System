<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Transcript Management System')</title>
    <!-- CSS links & styles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/kulogo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    @include('layouts.navbar')

    <main>
        <!-- DISPLAY ALL FLASH MESSAGES -->
       @if(session('success'))
            <!-- The HTML for the toast. Note the new ID and class -->
            <div id="success-toast" class="toast-notification" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div id="success-toast" class="toast-notification" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @error('file')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
        <!-- The empty space for page content -->
        @yield('content')
    </main>
    <!-- JS scripts -->
    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset('js/notification.js') }}"></script>
    
    @include('layouts.footer')
</body>
</html>