@extends('layouts.app-cro')

@section('content')
<h1 class="">Member list</h1>

{{ $users->links() }}

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>@lang('model.user.id')</th>
                <th>@lang('model.user.name')</th>
                <th>@lang('model.user.email')</th>
                <th>@lang('model.cro_user_attribute.position')</th>
                <th>@lang('model.cro_user_attribute.account_type')</th>
                <th>@lang('model.user.status')</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->user->id }}</td>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->user->email }}</td>
                    <td>{{ $user->position }}</td>
                    <td>{{ $user->user->account_type_display() }}</td>
                    <td>{{ $user->user->status_display() }}</td>
                    <td>
                        <a href="{{ route('cro_member_edit', ['id' => $user->user->id]) }}">
                            <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
