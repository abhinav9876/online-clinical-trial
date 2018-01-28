@extends('layouts.app-smo')

@section('content')
    <header class="header">
        <h1 class="header__title">@lang('smo/projects.index.header')</h1>
    </header>

    <section class="section">
        @if ($smo_projects)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>@lang('model.project.id')</th>
                        <th>@lang('model.project.name')</th>
                        <th>@lang('model.project.protocol')</th>
                        <th>@lang('model.project.category')</th>
                        <th>@lang('model.project.status')</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($smo_projects as $smo_project)
                        <tr>
                            <td>{{ $smo_project->project->id }}</td>
                            <td>{{ $smo_project->project->name }}</td>
                            <td>{{ $smo_project->project->protocol }}</td>
                            <td>{{ $smo_project->project->category }}</td>
                            <td>{{ $smo_project->project->status_display() }}</td>
                            <td>
                                <a href="{{ route('new_smo_project_post', ['id' => $smo_project->project->id]) }}" class="btn btn-xs btn-primary">@lang('smo/projects.index.actions.new-post')</a>
                                <a href="{{ route('smo_project_posts', ['id' => $smo_project->project->id]) }}" class="btn btn-xs btn-default">@lang('smo/projects.index.actions.view-posts')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>@lang('smo/projects.index.no-projects')</p>
        @endif
    </section>
@endsection
