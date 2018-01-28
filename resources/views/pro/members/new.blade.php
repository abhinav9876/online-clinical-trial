@extends('layouts.app-pro')

@section('content')
<h1>@lang('pro/members.new.title')</h1>

<form action="{{ route('pro_members_create') }}" method="POST">
    {{ csrf_field() }}

    @include('pro.members.form')

    <button id="create" type="submit" class="btn btn-primary">@lang('pro/members.new.submit')</button>
</form>
@endsection

