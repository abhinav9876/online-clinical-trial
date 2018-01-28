@extends('layouts.app-pro')

@section('content')
    <h1>@lang('pro/members.index.title')</h1>

    {{ $member_attributes->links() }}

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('model.user.id')</th>
                <th>@lang('model.user.name')</th>
                <th>@lang('model.user.email')</th>
                <th>@lang('model.pro_user_attribute.position')</th>
                <th>@lang('model.pro_user_attribute.account_type')</th>
                <th>@lang('model.user.status')</th>
                <th>@lang('pro/members.index.edit')</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($member_attributes as $attr)
                <tr>
                    <td>{{ $attr->user->id }}</td>
                    <td>{{ $attr->user->name }}</td>
                    <td>{{ $attr->user->email }}</td>
                    <td>{{ $attr->position }}</td>
                    <td>{{ $attr->user->account_type_display() }}</td>
                    <td>{{ $attr->user->status_display() }}</td>
                    <td>
                        <a href="{{ route('pro_members_edit', ['id' => $attr->user->id]) }}">
                            <button type="button" class="btn btn-primary btn-xs">@lang('pro/members.index.edit')</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection