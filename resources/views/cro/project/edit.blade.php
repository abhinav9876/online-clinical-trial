@extends('layouts.app-cro')

@section('content')
<h1 class="">projectEdit</h1>

<form id="cro_project_update_form" action="{{ route('cro_project_edit_action', ['id' => $project->id]) }}" method="POST">
    {{ csrf_field() }}

    @include('cro.project.form')
    <button name="action" value="{{ config('enum.form_action.save') }}" type="submit" class="btn btn-primary">Save</button>
    <button name="action" value="{{ config('enum.form_action.delete') }}" type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection
