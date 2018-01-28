@php
    $questions = $project->online_screener->questions;
@endphp

@if (count($questions) == 0)
    settingなし
@else
    @foreach ($questions as $key => $q)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="input-group">
                <span class="input-group-addon oscr-panel__question-label">A question{{ $key + 1 }}</span>
                <input type="text" class="form-control" value="{{ $q->text }}" disabled>
            </div>
            <div class="input-group">
                <label class="radio-inline"><input type="radio" value="{{ config('enum.online_screening_answer_type.dropdown') }}" {{ config('enum.online_screening_answer_type.dropdown') == $q->answer_type ? 'checked' : '' }} disabled>dropdown</label>
                <label class="radio-inline"><input type="radio" value="{{ config('enum.online_screening_answer_type.checkbox') }}" {{ config('enum.online_screening_answer_type.checkbox') == $q->answer_type ? 'checked' : '' }} disabled>checkbox</label>
                <label class="radio-inline"><input type="radio" value="{{ config('enum.online_screening_answer_type.freetext') }}" {{ config('enum.online_screening_answer_type.freetext') == $q->answer_type ? 'checked' : '' }} disabled>Free Word</label>
                <label class="radio-inline"><input type="radio" value="{{ config('enum.online_screening_answer_type.matrix') }}" {{ config('enum.online_screening_answer_type.matrix') == $q->answer_type ? 'checked' : '' }} disabled>matrix</label>
          </div>
        </div>

        @if ($q->answer_type == config('enum.online_screening_answer_type.dropdown'))
            <div class="panel-body">
                @php
                    $dropdown_values = json_decode($q->dropdown_values);
                @endphp

                @foreach ($dropdown_values as $dropdown_key => $d)
                    <div class="form-inline puzz-table__form-inline">
                        <div class="input-group">
                            <span class="input-group-addon">checkbox{{ $dropdown_key + 1 }}</span>
                            <input type="text" class="form-control" value="{{ $d }}" disabled>
                            <span class="input-group-addon">
                                @if (!empty($q->ng_values) && in_array($d, json_decode($q->ng_values)))
                                    <label class="inline-checkbox-label">NG <input type="checkbox" disabled checked></label>
                                @else
                                    <label class="inline-checkbox-label">NG <input type="checkbox" disabled></label>
                                @endif
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($q->answer_type == config('enum.online_screening_answer_type.checkbox'))
            <div class="panel-body">
                @php
                    $checkbox_values = json_decode($q->checkbox_values);
                @endphp

                @foreach ($checkbox_values as $checkbox_key => $c)
                    <div class="form-inline puzz-table__form-inline">
                        <div class="input-group">
                            <span class="input-group-addon">checkbox{{ $checkbox_key + 1 }}</span>
                            <input type="text" class="form-control" value="{{ $c }}" disabled>
                            <span class="input-group-addon">
                                @if (!empty($q->ng_values) && in_array($c, json_decode($q->ng_values)))
                                    <label class="inline-checkbox-label">NG <input type="checkbox" disabled checked></label>
                                @else
                                    <label class="inline-checkbox-label">NG <input type="checkbox" disabled></label>
                                @endif
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($q->answer_type == config('enum.online_screening_answer_type.freetext'))
            <div class="panel-body">
                Ask for answers in free text
            </div>
        @elseif ($q->answer_type == config('enum.online_screening_answer_type.matrix'))
            <div class="panel-body">
                @php
                    $matrix_question_values = json_decode($q->matrix_question_values);
                @endphp

                @foreach ($matrix_question_values as $matrix_key => $c)
                    <div class="form-inline puzz-table__form-inline">
                        <div class="input-group">
                            <span class="input-group-addon">matrix{{ $matrix_key + 1 }}</span>
                            <input type="text" class="form-control" value="{{ $c }}" disabled>

                        </div>
                    </div>
                    @endforeach
                </div>
        @endif
    </div>
    @endforeach
@endif
