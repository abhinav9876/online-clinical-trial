@extends('layouts.app-admin')

@section('content')
<h3 class="">CRO/Pharmaceutical company account list</h3>

{{ $cros->links() }}

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>CRO ID</th>
                <th>Organization name</th>
                <th>Group type</th>
                <th>Manager</th>
                <th>mail address</th>
                <th>Street address</th>
                <th>Edit</th>
                <th>Project List</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cros as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->type_display() }}</td>
                    <td>{{ $c->admin_user()->name }}</td>
                    <td>{{ $c->admin_user()->email }}</td>
                    <td>{{ $c->address_display() }}</td>
                    <td>
                        <a href="{{ route('admin_cro_edit', ['id' => $c->id]) }}">
                        <button type="button" class="btn btn-sm btn-primary">Edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin_cro_projects', ['cro_id' => $c->id]) }}">
                        <button type="button" class="btn btn-sm btn-primary">Project List</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
