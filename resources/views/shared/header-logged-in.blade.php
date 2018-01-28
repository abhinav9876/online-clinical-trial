<div>
    <nav class="navbar-fixed-top puzz-header">
        <div class="puzz-header-left">
        </div>
        <div class="puzz-header-center">
            <a class="" href="#">
                <img class="puzz-header__logo" src="{{ asset('images/logo_w.png') }}">
            </a>
        </div>
        <div class="puzz-header-right">
            <form class="navbar-form navbar-right" method="POST" action="{{ route('logout') }}">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default puzz-header__btn-logout">
                    <img src="{{ asset('images/logout.png') }}">
                </button>
            </form>
        </div>
    </nav>
    <div class="col-xs-9 col-md-10 col-xs-offset-3 col-md-offset-2 header--welcome">
        <ol class="breadcrumb puzz-breadcrumb">
            <li>{{  App\Helper\breadcrumb($activeMenuType) }}</li>
        </ol>
        @if(\Illuminate\Support\Facades\Auth::user()->type == config('enum.user_type.cro'))
            <p>Welcome、{{ \App\Helper\currentCROUser()->cro()->name }} / {{ \Illuminate\Support\Facades\Auth::user()->name }} Mr.</p>
        @elseif(\Illuminate\Support\Facades\Auth::user()->type == config('enum.user_type.smo'))
            <p>Welcome、{{ \App\Helper\currentSMOUser()->smo()->name }} / {{ \Illuminate\Support\Facades\Auth::user()->name }} Mr.</p>
        @else
            <p>Welcome、{{ \Illuminate\Support\Facades\Auth::user()->name }} Mr.</p>
        @endif
    </div>
</div>