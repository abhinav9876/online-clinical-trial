@extends('layouts.app-smo')

@section('content')
    <header class="header">
        <h1 class="header__title">Public post a-覧</h1>
    </header>

    {{ $posts->links() }}

    <section class="section">
        @if ($posts)
            <div class="table-responsive puzz-table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>post ID</th>
                        <th>project name</th>
                        <th>Test Title</th>
                        <th>Details</th>
                        <th>CRC name</th>

                        <th>Number of applications</th>
                        <th>Not compatible</th>
                        <th>TEL1</th>
                        <th>TEL2</th>
                        <th>TEL3</th>
                        <th>Disqualification数</th>
                        <th> operating</th>
                        @if (env('APP_SMT_DEBUG'))
                            <th>(Debug)Random entryAdd to</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->project_name }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ $post->crc_name }}</td>

                            <td>{{ $status_map[$post->id]->values()->sum() }}</td>
                            <td>{{ $status_map[$post->id][config('enum.subject_status.default')] }}</td>
                            <td>{{ $status_map[$post->id][config('enum.subject_status.phone_1')] }}</td>
                            <td>{{ $status_map[$post->id][config('enum.subject_status.phone_2')] }}</td>
                            <td>{{ $status_map[$post->id][config('enum.subject_status.phone_3')] }}</td>
                            <td>{{ $status_map[$post->id][config('enum.subject_status.disqualified')] }}</td>

                            <td>
                                <a href="{{ route('smo_post_subjects', ['id' => $post->id]) }}" class="btn btn-xs btn-primary"> Application一覧</a>
                            </td>
                            @if (env('APP_SMT_DEBUG'))
                                <td>
                                    
                                    <form action="{{ route('create_smo_post_subject', ['post' => $post->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input name="redirect" type="hidden" value="{{ route('smo_posts_open') }}">
                                        <button type="submit" class="btn btn-xs btn-primary"> Application作成</button>
                                    </form>
                                </td>
                            @endif
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