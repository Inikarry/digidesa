<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Administrasi Kecamatan Donri-Donri</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
        @stack('predent-style')
        @include('includes.style')
        @stack('addon-style')

        
    </head>
    <body>
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>
        <div class="connect-container align-content-stretch d-flex flex-wrap">
            <div class="page-container">
                <div class="page-header">
                    @include('includes.navbar')
                </div>
                <div class="horizontal-bar">
                    @include('includes.horizontal')
                </div>
                <div class="page-content">
                    @yield('content')
                </div>
                <div class="page-footer">
                    @include('includes.footer')
                </div>
            </div>
        </div>
        @include('includes.profile')
        @stack('predent-script')
        @include('includes.scripts')
        @stack('addon-script')      
    </body>
</html>