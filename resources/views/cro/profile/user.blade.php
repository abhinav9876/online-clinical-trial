@extends('layouts.app-cro')

@section('content')
<h1 class="">User setting</h1>

<form id="" action="{{ route('cro_profile_user_action') }}" method="POST">
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
                <th class="puzz-table-label">name</th>
                <td>
                    <div class="form-inline">
                        <input name="name" type="text" class="form-control" value="{{ $user->name }}" placeholder="" required autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">Position</th>
                <td>
                    <div class="form-inline">
                        <input name="position" type="text" class="form-control" value="{{ $user->attribute->position }}" placeholder="">
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">mail address</th>
                <td>
                    <div class="form-inline">
                        <input name="email" type="text" class="form-control" value="{{ $user->email }}" placeholder="" required>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">password</th>
                <td>
                    <div class="form-inline">
                        <input name="password" type="password" class="form-control" placeholder="@lang('cro/members.form.password_reset_placeholder')">
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">password（confirmation）</th>
                <td>
                    <div class="form-inline">
                        <input name="password_confirmation" type="password" class="form-control" placeholder="@lang('cro/members.form.password_reset_placeholder')">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <button id="create" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
