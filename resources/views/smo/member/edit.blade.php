@extends('layouts.app-smo')

@section('content')
<h3 class="">SMO Login Account MembersーEdit</h3>

<form action="{{ route('smo_member_edit_action', ['id' => $user->id]) }}" method="POST">
    {{ csrf_field() }}

    @include('smo.member.form')
    <button name="action" value="{{ config('enum.form_action.save') }}" type="submit" class="btn btn-primary">Save</button>
    <button name="action" value="{{ config('enum.form_action.delete') }}" type="submit" class="btn btn-danger">Delete</button>
</form>
@endsection
