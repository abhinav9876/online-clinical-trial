@extends('layouts.app-cro')

@section('content')
<h1 class="">Project List</h1>

{{ $projects->links() }}

<div class="table-responsive puzz-table-responsive">
    <table id="cro-project-list" class="table puzz-table table-striped">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Protocol number</th>
                <th>Disease name</th>
                <th>Create User</th>
                <th class="{{ $cro->type == config('enum.cro_type.maker') ? 'hidden' : '' }}">Pharmaceutical companies</th>
                <th>Category list</th>
                <th>Post count</th>
                <th>Status</th>
                <th>Status Change</th>
                <th>Edit</th>
                <th>posts</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $p)
                <tr>
                    <td class="puzz-table__cell">{{ $p->id }}</td>
                    <td class="puzz-table__cell">{{ $p->protocol }}</td>
                    <td class="puzz-table__cell">{{ $p->name }}</td>
                    <td class="puzz-table__cell">{{ isset($p->owner) ? $p->owner->name : '' }}</td>
                    <td class="puzz-table__cell {{ $cro->type == config('enum.cro_type.maker') ? 'hidden' : '' }}">{{ $p->maker ? $p->maker->name : '' }}</td>
                    <td class="puzz-table__cell">{{ $p->category_display() }}</td>
                    <td class="puzz-table__cell">{{ $p->posts->count() }}</td>
                    <td id="cro-project-status-{{ $p->id }}" class="puzz-table__cell">{{ $p->status_display() }}</td>
                    <td class="puzz-table__cell">
                        <div class="dropdown">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             ChangeTo
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li class="puzz-table__action-link" data-project-id="{{ $p->id }}" data-status="{{ config('enum.project_status.pending') }}"><a>保留</a></li>
                            <li class="puzz-table__action-link" data-project-id="{{ $p->id }}" data-status="{{ config('enum.project_status.opening') }}"><a>公開</a></li>
                            <li class="puzz-table__action-link" data-project-id="{{ $p->id }}" data-status="{{ config('enum.project_status.closed') }}"><a>終了</a></li>
                          </ul>
                        </div>
                    </td>
                    <td class="puzz-table__cell">
                        <a href="{{ route('cro_project_edit', ['id' => $p->id]) }}">
                            <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                    </td>
                    <td class="puzz-table__cell">
                      <a href="{{ route('cro_project_posts', ['project_id' => $p->id]) }}" class="btn btn-xs btn-default">
                            <button type="button" class="btn btn-primary">posts list</button>
                      </a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
