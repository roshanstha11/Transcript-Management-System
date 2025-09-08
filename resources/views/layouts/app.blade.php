<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Transcript Management System')</title>
    <!-- CSS links & styles -->
    <meta charset="UTF-8">
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
        <!-- The empty space for page content -->
        @yield('content')
    </main>
    <!-- JS scripts -->
     <script src="{{ asset('js/notification.js') }}"></script>
    @include('layouts.footer')
</body>
</html>