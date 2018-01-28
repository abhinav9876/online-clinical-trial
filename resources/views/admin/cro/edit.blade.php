@extends('layouts.app-admin')

@section('content')
<h3 class="">CRO / Pharmaceutical company account edit / delete</h3>

<form id="edit_cro" action="{{ route('admin_cro_edit_action', ['id' => $cro->id]) }}" method="POST">
    {{ csrf_field() }}

    @include('admin.cro.form')
    <button name="action" value="{{ config('enum.form_action.save') }}" type="submit" class="btn btn-primary">Save</button>
    <button name="action" value="{{ config('enum.form_action.delete') }}" type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection
