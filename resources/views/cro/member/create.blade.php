@extends('layouts.app-cro')

@section('content')
<h3 class="">Create CRO login account</h3>

<form id="" action="{{ route('cro_member_create_action') }}" method="POST">
    {{ csrf_field() }}

    @include('cro.member.form')
    <button id="create" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
