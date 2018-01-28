@extends('layouts.app-pro')

@section('content')
    <h1 class="">@lang('pro/profile.show.title')</h1>

    <form id="" action="{{ route('pro_profile_update') }}" method="POST">
        {{ csrf_field() }}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered puzz-table">
            <tbody>
            <tr>
                <th class="puzz-table-label">@lang('model.user.name')</th>
                <td>
                    <div class="form-inline">
                        <input name="name" type="text" class="form-control" value="{{ $user->name }}" placeholder="@lang('model.user.name')" required autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.pro_user_attribute.position')</th>
                <td>
                    <div class="form-inline">
                        <input name="position" type="text" class="form-control" value="{{ $user->attribute->position }}" placeholder="@lang('model.pro_user_attribute.position')">
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.user.email')</th>
                <td>
                    <div class="form-inline">
                        <input name="email" type="text" class="form-control" value="{{ $user->email }}" placeholder="@lang('model.user.email')" required>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.user.password')</th>
                <td>
                    <div class="form-inline">
                        <input name="password" type="password" class="form-control" placeholder="@lang('model.user.password')">
                        <p class="help-block small paragraph--input-help-text">※@lang('pro/profile.show.password_help_text')</p>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.user.password_confirmation')</th>
                <td>
                    <div class="form-inline">
                        <input name="password_confirmation" type="password" class="form-control" placeholder="@lang('model.user.password_confirmation')">
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <button id="create" type="submit" class="btn btn-primary">@lang('pro/profile.show.save')</button>
    </form>
@endsection
