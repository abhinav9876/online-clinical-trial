<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('shared.meta')
</head>
<body>
    @include('shared.header-logged-in')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-3 col-md-2 puzz-sidebar">
                @include('smo.shared.menu')
            </div>

            <div class="col-xs-15 col-md-10 col-xs-offset-3 col-md-offset-2 puzz-main puzz-home">
                @yield('content')
            </div>
        </div>
    </div>
    @include('shared.footer')
</body>
</html>
