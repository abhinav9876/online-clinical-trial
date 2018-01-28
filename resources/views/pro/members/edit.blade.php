@extends('layouts.app-pro')

@section('content')
    <h1>@lang('pro/members.edit.title')</h1>

    <form action="{{ route('pro_members_update', ['id' => $user->id]) }}" method="POST">
        {{ csrf_field() }}
        @include('pro.members.form')
        <button name="action" type="submit" value="{{ config('enum.form_action.save') }}" class="btn btn-primary">@lang('pro/members.edit.save')</button>
        <button name="action" type="submit" value="{{ config('enum.form_action.delete') }}" class="btn btn-danger">@lang('pro/members.edit.delete')</button>
    </form>
@endsection
