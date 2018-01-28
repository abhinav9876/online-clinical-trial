@extends('layouts.app-admin')

@section('content')
<h3 class="">CRO/Pharmaceutical company information</h3>

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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $cro->id }}</td>
                <td>{{ $cro->name }}</td>
                <td>{{ $cro->type_display() }}</td>
                <td>{{ $cro->admin_user()->name }}</td>
                <td>{{ $cro->admin_user()->email }}</td>
                <td>{{ $cro->address_display() }}</td>
            </tr>
        </tbody>
    </table>
</div>

<h3 class="">CRO/Pharmaceutical companies　Project List</h3>

{{ $projects->links() }}

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Protocol number</th>
                <th>Disease name</th>
                <th>Category list</th>
                <th>Status</th>
                <th>Public post number</th>
                <th>Public post number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->protocol }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category_display() }}</td>
                    <td>{{ $p->status_display() }}</td>
                    <td>{{ $p->openPostsCount() }}</td>
                    <td>{{ $p->closedPostsCount() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
