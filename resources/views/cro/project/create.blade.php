@extends('layouts.app-cro')

@section('content')
<h1 class="">Project creation</h1>

<form id="cro_project_create_form" action="{{ route('cro_project_create_action') }}" method="POST">
    {{ csrf_field() }}

    @include('cro.project.form')
    <button id="create" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
