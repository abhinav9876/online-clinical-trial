@extends('layouts.app-smo')

@section('content')
    <header class="header">
        <h1 class="header__title">@lang('smo/posts.index.header')</h1>
        <a href="{{ route('new_smo_project_post', ['id' => $project_id]) }}" class="btn btn-primary">@lang('smo/projects.index.actions.new-post')</a>
    </header>

    {{ $posts->links() }}

    <section class="section">

        @if (count($posts) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Test Title</th>
                        <th>施設 name</th>
                        <th>募集期間</th>
                        <th>必要SCR数</th>
                        <th>担当CRC</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->facility_name }}</td>
                            @if (empty($post->start_recruitment_at) && empty($post->end_recruitment_at))
                                <td></td>
                            @else
                                <td>{{ $post->start_recruitment_at }} ~ {{ $post->end_recruitment_at }}</td>
                            @endif
                            <td>{{ $post->required_no_scr }}</td>
                            <td>{{ $post->crc_name }}</td>
                            <td>
                                <a href="{{ route('edit_smo_project_post', ['project_id' => $project_id, 'post_id' => $post->id]) }}" class="btn btn-xs btn-primary btn-block">Edit</a>

                                <form class="form--btn-block form--delete-post" action="{{ route('delete_smo_project_post', ['project_id' => $project_id, 'post_id' => $post->id]) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-xs btn-danger btn-block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @else
        @endif
    </section>
@endsection
