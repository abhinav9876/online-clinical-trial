@extends('layouts.app-admin')

@section('content')
<h3 class="">SMO/Facility account一覧</h3>

{{ $smos->links() }}

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>SMO ID</th>
                <th>Organization name</th>
                <th>Manager</th>
                <th>mail address</th>
                <th>Street address</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($smos as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->admin_user()->name }}</td>
                    <td>{{ $s->admin_user()->email }}</td>
                    <td>{{ $s->address_display() }}</td>
                    <td>
                        <a href="{{ route('admin_smo_edit', ['id' => $s->id]) }}">
                        <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
