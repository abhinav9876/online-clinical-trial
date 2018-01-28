@extends('layouts.app-pro')

@section('content')
    <header class="header">
        <h1 class="header__title">施設一覧</h1>
    </header>

    {{ $posts->links() }}

    <section class="section">
        @if ($posts)
            <div class="table-responsive puzz-table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>postID</th>
                        <th>project name</th>
                        <th>Test Title</th>
                        <th>Details</th>
                        <th>CRC name</th>
                        <th>Status</th>
                        <th>Number of applications</th>
                        <th>Not compatible</th>
                        <th>TEL1</th>
                        <th>TEL2</th>
                        <th>TEL3</th>
                        <th>Disqualification数</th>
                        <th> operating</th>
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
                            <td>(todo)</td> {{-- $post->status --}}

                            <td>{{ $post->num_subj }}</td>
                            <td>{{ $post->num_subj_default }}</td>
                            <td>{{ $post->num_subj_phone_1 }}</td>
                            <td>{{ $post->num_subj_phone_2 }}</td>
                            <td>{{ $post->num_subj_phone_3 }}</td>
                            <td>{{ $post->num_subj_disqualified }}</td>

                            <td>
                                <a href="{{ route('smo_post_subjects', ['id' => $post->id]) }}" class="btn btn-xs btn-primary"> Application一覧</a>
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
