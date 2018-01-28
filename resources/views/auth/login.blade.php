@extends('layouts.app')

@section('content')
<div class="puzz-login">
    <div class="puzz-login-table puzz-login-table--shadow">
        <div class="puzz-login-table-cell">
            <div class="puzz-login-header clearfix">
                <h3 class="puzz-login__brand">
                    <img src="{{ asset('images/logo_w.png') }}">
                </h3>
            </div>

            <div class="puzz-login-content container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="puzz-login-content__catch1 text-left">@lang('login.catch1')</div>
                        <div class="puzz-login-content__catch2 text-left">@lang('login.catch2')</div>
                        <div class="puzz-login-content__catch-logo text-left">
                            <img src="{{ asset('images/logo_smt.png') }}">
                            <img src="{{ asset('images/logo.png') }}">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <h2 class="text-left">Welcome. If you are PUZZ you can make innovation for recruitment of subjects.</h2>

                        <form id="login-form" class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <input id="email" type="email" id="inputEmail" name="email" class="form-control puzz-login__input" value="{{ env('APP_DEBUG') ? 'cro@example.com' : '' }}" placeholder="user-id" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <input type="password" id="password" name="password" class="form-control puzz-login__input" value="{{ env('APP_DEBUG') ? 'password' : '' }}" placeholder="form-password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            <div class="checkbox text-left">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Save ID / password.
                                </label>
                            </div>

                            <p class="text-left puzz-login-content__forget-password">
                        If you have forgotten your user ID or password, please contact us from here . We will send you a procedure e-mail of reissue. Please note that if you mistake ID / PASS more than 3 times for security reasons, account lock will be applied.    </p>
                            <button class="btn btn-lg btn-primary btn-block puzz-login__btn" type="submit">
                                <img src="{{ asset('images/login.png') }}">
                                <span class="puzz-login__text">
                                    submit
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
