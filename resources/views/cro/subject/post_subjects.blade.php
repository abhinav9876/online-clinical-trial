@extends('layouts.app-smo')

@section('content')
    <header class="header">
        <h3 class="header__title">post情報</h3>
    </header>

    <section class="section">
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
                    <th>1 Phone call</th>
                    <th>2 Phone call</th>
                    <th>3 Phone call</th>
                    <th>The appointment is finished</th>
                    <th>First visit</th>
                    <th>Consent Acquired</th>
                    <th>Incorporated</th>
                    <th>Disqualification</th>
                    <th>NG</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->project->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->crc_name }}</td>
                        <td>{{ $total_subjects }}</td>
                        <td>{{ $status_map[config('enum.subject_status.default')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.phone_1')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.phone_2')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.phone_3')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.booked')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.visited')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.informed_consent_obtained')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.incorporated')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.disqualified')] }}</td>
                        <td>{{ $status_map[config('enum.subject_status.ng')] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <hr>

    <header class="header">
        <h3 class="header__title">Applicant list</h3>
    </header>

    {{ $subjects->links() }}

    <section class="section">
        <div class="table-responsive puzz-table-responsive">
            <table id="smo-subject-list" class="table">
                <thead>
                <tr>
                    <th>ApplicantID</th>
                    <th>Application time</th>
                    <th>gender</th>
                    <th>name</th>
                    <th>phone number</th>
                    <th>Street address</th>
                    <th>Status</th>
                    <th>Status Change operating</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $s)
                        <tr>
                            <td>{{ $s->application_id }}</td>
                            <td>{{ $s->application_date }}</td>
                            <td>{{ $s->sex_display() }}</td>
                            <td>{{ $s->application_name }}</td>
                            <td>{{ $s->application_tel }}</td>
                            <td>{{ $s->application_address_state }}</td>
                            <td id="smo-subject-status-{{ $s->application_id }}" class="puzz-table__cell">{{ $s->status_display() }}</td>
                            <td class="include-dropdown">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                         ChangeTo
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        @php
                                            $status_displays = App\Subject::status_displays();
                                            $status = config('enum.subject_status');
                                        @endphp
                                        @foreach($status as $key => $val)
                                            @if($val != config('enum.subject_status.ng'))
                                                <li class="puzz-table__action-link" data-subject-id="{{ $s->application_id }}" data-status="{{ $val }}">
                                                    <a>{{ $status_displays[$key] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                  </ul>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('show_smo_subject', ['id' => $s->application_id]) }}" class="btn btn-xs btn-primary btn-block">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
