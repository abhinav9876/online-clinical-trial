<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('shared.meta')
</head>
<body class="v2">
<div id="wrapper">
    @include('shared.v2.header')
    @include('pro.shared.menu')

    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row sub-navbar">
                <p class="pull-left">{{  App\Helper\breadcrumb($activeMenuType) }} CRO管理画面</p>

                @if(\Illuminate\Support\Facades\Auth::user()->type == config('enum.user_type.cro'))
                    <p class="pull-right">Welcome、{{ \App\Helper\currentCROUser()->cro()->name }} / {{ \Illuminate\Support\Facades\Auth::user()->name }} Mr.</p>
                @elseif(\Illuminate\Support\Facades\Auth::user()->type == config('enum.user_type.smo'))
                    <p class="pull-right">Welcome、{{ \App\Helper\currentSMOUser()->smo()->name }} / {{ \Illuminate\Support\Facades\Auth::user()->name }} Mr.</p>
                @else
                    <p class="pull-right">Welcome、{{ \Illuminate\Support\Facades\Auth::user()->name }} Mr.</p>
                @endif
            </div>


            <main class="row" id="main">
                @yield('content')
            </main>
        </div>
    </div>
    @include('shared.footer')
</div>
</body>
</html>
