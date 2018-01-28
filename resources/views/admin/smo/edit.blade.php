@extends('layouts.app-admin')

@section('content')
<h1 class="">SMOCreate account</h1>
<h3 class="">SMO/Facility accountEdit・Delete</h3>

<form id="edit_smo" action="{{ route('admin_smo_edit_action', ['id' => $smo->id]) }}" method="POST">
    {{ csrf_field() }}

    @include('admin.smo.form')
    <button name="action" value="{{ config('enum.form_action.save') }}" type="submit" class="btn btn-primary">Save</button>
    <button name="action" value="{{ config('enum.form_action.delete') }}" type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection
