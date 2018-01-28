@php
    if (empty($question)) {
        $display = false;
    } else {
        $display = $question->answer_type == config('enum.online_screening_answer_type.matrix');
    }

    if ($display) {
        $style = '';
    } else {
        $style = 'display: none;';
    }

    if (!isset($panel_id)) {
        $text_input_name = '';
        $ng_name = '';
    } else {
        $text_input_name = 'oscr_panel['.$panel_id.'][matrix_item][]';
        $ng_name = 'oscr_panel[' . $panel_id . '][ng_item][]';
    }

    if (empty($matrix_question_values) || count($matrix_question_values) <= 1) {
        $remove_button_style = 'display: none;';
    } else {
        $remove_button_style = '';
    }
@endphp

<div class="panel-body oscr-matrix" style="{{ $style }}">
    <div class="input-group puzz-table__form-inline oscr-matrix-item oscr-matrix-item--template">
        <span class="input-group-addon">matrix</span>
        <input type="text" class="form-control" value="">

    </div>

    @if (empty($matrix_question_values))
        <div class="input-group puzz-table__form-inline oscr-matrix-item">
            <span class="input-group-addon">matrix</span>
            <input type="text" name="{{ $text_input_name }}" class="form-control" value="">
       </div>
    @else
        @foreach ($matrix_question_values as $c)
            <div class="input-group puzz-table__form-inline oscr-matrix-item">
                <span class="input-group-addon">matrix</span>
                <input type="text" name="{{ $text_input_name }}" class="form-control" value="{{ $c }}" required>
            </div>
        @endforeach
    @endif

    <div class="form-inline puzz-table__form-inline oscr-matrix-tools">
        <button type="button" class="btn btn-primary add-oscr-matrix-item">Add to</button>
        <button type="button" class="btn btn-danger remove-oscr-matrix-item" style="{{ $remove_button_style }}">Delete</button>
    </div>
</div>
