@php
    if (!isset($panel_id)) {
        $question_name = '';
        $answer_type_name = '';
        $label = 'A question';
    } else {
        $question_name = 'oscr_panel['.$panel_id.'][question]';
        $answer_type_name = 'oscr_panel['.$panel_id.'][answer_type]';
        $label = 'A question'.($panel_id + 1);
    }
@endphp

<div class="panel-heading">
    <div class="input-group">
        <span class="input-group-addon oscr-panel__question-label">{{ $label }}</span>
        @if (empty($question))
            <input type="text" name="{{ $question_name }}" class="form-control oscr-panel__question-text" value="">
        @else
            <input type="text" name="{{ $question_name }}" class="form-control oscr-panel__question-text" value="{{ $question->text }}" required>
        @endif
    </div>
    <div class="input-group">
        @if (empty($question))
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.dropdown') }}" checked>dropdown
            </label>
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.checkbox') }}">checkbox
            </label>
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.freetext') }}">Free Word
            </label>
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.matrix') }}">matrix
            </label>

        @else
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.dropdown') }}" {{ config('enum.online_screening_answer_type.dropdown') == $question->answer_type ? 'checked' : '' }}>dropdown
            </label>
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.checkbox') }}" {{ config('enum.online_screening_answer_type.checkbox') == $question->answer_type ? 'checked' : '' }}>checkbox
            </label>
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.freetext') }}" {{ config('enum.online_screening_answer_type.freetext') == $question->answer_type ? 'checked' : '' }}>Free Word
            </label>
            <label class="radio-inline oscr-answer-type">
                <input type="radio" name="{{ $answer_type_name }}" value="{{ config('enum.online_screening_answer_type.matrix') }}" {{ config('enum.online_screening_answer_type.matrix') == $question->answer_type ? 'checked' : '' }}>matrix
            </label>

        @endif
    </div>
</div>
