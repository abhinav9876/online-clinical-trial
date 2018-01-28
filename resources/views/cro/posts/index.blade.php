@extends('layouts.app-cro')

@section('content')


    {{ $posts->links() }}

    <section class="section">

        @if (count($posts) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Test Title</th>
                        <th>Name of the facility</th>
                        <th>Recruitment period</th>
                        <th>Number of required SCRs</th>
                        <th>Responsible CRC</th>
                        <th>Add Status</th>
                        <th>Status</th>

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
                              <select name="status">
                                <option value="Suspended">Suspended</option>
                                <option value="Published">Published</option>
                                <option value="Closed">Closed</option>
                              </select>
                            </td>
                            <td>
                              <form class="form-btn-indent " action="{{route('set_project_status', ['project_id' => $project_id, 'sel_post' => $post])}}" method="POST">
                                {{ csrf_field() }}
                                  <button type="submit" class="btn btn-xs btn-primary btn-block ">Add Status</button>
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
