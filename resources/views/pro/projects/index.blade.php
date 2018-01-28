@extends('layouts.app-pro')

@section('content')
    <header class="header">
        <h1 class="header__title">@lang('pro/projects.index.title')</h1>
    </header>

    <section class="section">
        @if (count($pro_projects))
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>@lang('model.project.id')</th>
                        <th>@lang('model.project.name')</th>
                        <th>@lang('model.project.protocol')</th>
                        <th>@lang('model.project.category')</th>
                        <th>@lang('model.project.status')</th>
                        <th>@lang('pro/projects.index.view_posts')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pro_projects as $project)
                        <tr>
                            <td>{{ $project->project->id }}</td>
                            <td>{{ $project->project->name }}</td>
                            <td>{{ $project->project->protocol }}</td>
                            <td>{{ $project->project->category }}</td>
                            <td>{{ $project->project->status_display() }}</td>
                            <td>
                                <a href="{{ route('pro_project_posts', ['id' => $project->project->id]) }}" class="btn btn-xs btn-default">@lang('pro/projects.index.view_posts')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info" role="alert">@lang('pro/projects.index.no_projects_message')</div>
        @endif
    </section>
@endsection