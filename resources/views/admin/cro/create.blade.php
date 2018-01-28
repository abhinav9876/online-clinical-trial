@extends('layouts.app-admin')

@section('content')
<h3 class="">Create CRO / Pharmaceutical company account</h3>

<form id="create_cro" action="{{ route('admin_cro_create_action') }}" method="POST">
    {{ csrf_field() }}

    @include('admin.cro.form')
    <button id="create" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
