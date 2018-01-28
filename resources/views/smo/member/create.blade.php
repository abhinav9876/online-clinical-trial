@extends('layouts.app-smo')

@section('content')
<h3 class="">SMO ログインCreate account</h3>

<form id="" action="{{ route('smo_member_create_action') }}" method="POST">
    {{ csrf_field() }}

    @include('smo.member.form')
    <button id="create" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
