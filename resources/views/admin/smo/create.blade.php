@extends('layouts.app-admin')

@section('content')
<h3 class="">SMO/Facility account creation</h3>

<form id="create_smo" action="{{ route('admin_smo_create_action') }}" method="POST">
    {{ csrf_field() }}

    @include('admin.smo.form')
    <button id="create" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
