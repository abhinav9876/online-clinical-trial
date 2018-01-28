@extends('layouts.app-smo')

@section('content')
    <input type="hidden" id="subjectId" name="subjectId" value="{{ $subject->application_id }}" readonly>

    <header class="header">
        <h1 class="header__title"> ApplicationDetails</h1>
    </header>
    <section class="section">
        <div id="alert-info" class="alert alert-info" style="display: none;">
            <ul>
                <li></li>
            </ul>
        </div>
        <div id="alert-danger" class="alert alert-danger" style="display: none;">
            <ul>
                <li></li>
            </ul>
        </div>

        <div id="smo-subject-show" class="row">
            <div class="col-md-6">
                <table class="table table-bordered puzz-table">
                    <tbody>
                    <tr>
                        <th class="puzz-table-label">name</th>
                        <td>{{ $subject->application_name }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">フリガナ</th>
                        <td>{{ $subject->application_name_furigana }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">mail address</th>
                        <td><a href="mailto:{{ $subject->application_email }}">{{ $subject->application_email }}</a></td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">phone number</th>
                        <td>{{ $subject->application_tel }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Time to connect easily</th>
                        <td>
                            <ol class="table-data__ol">
                                {{-- Todo: Fix attribute spelling --}}
                                <li>{{ $subject->application_calender_1 }} ({{ $subject->application_time_1 }}時〜)</li>
                                <li>{{ $subject->application_calender_2 }} ({{ $subject->application_time_2 }}時〜)</li>
                                <li>{{ $subject->application_calender_3 }} ({{ $subject->application_time_3 }}時〜)</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">gender</th>
                        <td>{{ $subject->sex_display() }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Birthday</th>
                        <td>{{ $subject->application_birth }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Contact by e-mail</th>
                        <td>{{ $subject->application_by_mail ? 'hope' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Street address</th>
                        <td>
                            <address class="address--subject">
                                <strong>{{ $subject->application_zip }}</strong><br>
                                {{ $subject->application_address_state }}<br>
                                {{ $subject->application_address_city }}<br>
                            </address>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">A question</th>
                        <td>{{ $subject->application_other }}</td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Status</th>
                        <td>
                            <div class="form-inline">
                                <div id="smo-subject-status" class="form-group">
                                    {{ $subject->status_display() }}
                                </div>
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
                                                <li class="puzz-table__action-link" data-subject-id="{{ $subject->application_id }}" data-status="{{ $val }}">
                                                    <a>{{ $status_displays[$key] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                  </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Examination date</th>
                        <td>
                            <div class="form-inline">
                                <div class='input-group date datetimepicker'>
                                    <input type="text" name="application_exam_date" id="application_exam_date" value="{{ $subject->application_exam_date }}" class="form-control" placeholder="Examination date">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <button id="application_exam_date_update_button" class="btn btn-default" data-loading-text="更新中...">更新</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">The appointment is finished Notice</th>
                        <td>
                            <div id="send_subject_booking_alert"></div>
                            <button type="button" id="send-subject-booking-notification" class="btn btn-primary" data-loading-text="送信中...">The appointment is finished Noticeをメール送信To</button>
                        </td>
                    </tr>
                    </tbody>
                </table>


                <table class="table table-bordered puzz-table">
                    <thead>
                        <tr>
                            <th class="puzz-table-label">A question</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers_table as $answer)
                        <tr>
                            <td class="puzz-table-label">{{ $answer['question'] }}</td>
                            <td>{{ $answer['answer'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
