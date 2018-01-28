<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('shared.meta')
</head>
<body>
    @include('shared.header')
    @yield('content')
    @include('shared.footer')
</body>
</html>
