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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/kulogo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loginform.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @yield('styles')

</head>
<body>
    @include('partials.navbar')

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
        
        {{-- Login and Register form error check --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div id="success-toast" class="toast-notification" role="alert">
                {{ $error }}
            </div>    
            @endforeach  
        @endif
        @error('file')
            <div class="alert alert-warning">{{ $message }}</div>
        @enderror
    <!-- END OF FLASH MESSAGES -->
    <div class="d-flex">
        @auth
            @include('partials.sidebar')
        @endauth
        @yield('content')
    </div>
    @include('partials.footer')
    <!-- The empty space for page content -->
    
    
    <!-- JS scripts -->
    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('js/loginform.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    @yield('scripts')
    
</body>
</html>