<!doctype html>
<html lang="en">
<head>
    @include('Partials._head')
    
    <link rel="stylesheet" href="{{ URL::to('src/css/app.css') }}">

    @yield('styles')
</head>
<body>

@include('partials._navigation')

    <div class="container">
        @yield('content')
    </div>

      
    @include('Partials._javascript')
    @yield('scripts')
    @include('partials._footer')
</body>
</html>