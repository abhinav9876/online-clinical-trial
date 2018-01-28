@php
    if (empty($question)) {
        $display = false;
    } else {
        $display = $question->answer_type == config('enum.online_screening_answer_type.checkbox');
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
        $text_input_name = 'oscr_panel['.$panel_id.'][checkbox_item][]';
        $ng_name = 'oscr_panel[' . $panel_id . '][ng_item][]';
    }

    if (empty($checkbox_values) || count($checkbox_values) <= 1) {
        $remove_button_style = 'display: none;';
    } else {
        $remove_button_style = '';
    }
@endphp

<div class="panel-body oscr-checkbox" style="{{ $style }}">
    <div class="input-group puzz-table__form-inline oscr-checkbox-item oscr-checkbox-item--template">
        <span class="input-group-addon">checkbox</span>
        <input type="text" class="form-control" value="">
        <span class="input-group-addon">
            <input type="hidden" value="">
            <label class="inline-checkbox-label">NG <input type="checkbox"></label>
        </span>
    </div>

    @if (empty($checkbox_values))
        <div class="input-group puzz-table__form-inline oscr-checkbox-item">
            <span class="input-group-addon">checkbox</span>
            <input type="text" name="{{ $text_input_name }}" class="form-control" value="">
            <span class="input-group-addon">
                <input type="hidden" name="{{ $ng_name }}" value="">
                <label class="inline-checkbox-label">NG <input type="checkbox"></label>
            </span>
        </div>
    @else
        @foreach ($checkbox_values as $c)
            <div class="input-group puzz-table__form-inline oscr-checkbox-item">
                <span class="input-group-addon">checkbox</span>
                <input type="text" name="{{ $text_input_name }}" class="form-control" value="{{ $c }}" required>
                <span class="input-group-addon">
                    <input type="hidden" name="{{ $ng_name }}" value="">
                    @if (!empty($question->ng_values) && in_array($c, json_decode($question->ng_values)))
                        <label class="inline-checkbox-label">NG <input type="checkbox" checked></label>
                    @else
                        <label class="inline-checkbox-label">NG <input type="checkbox"></label>
                    @endif
                </span>
            </div>
        @endforeach
    @endif

    <div class="form-inline puzz-table__form-inline oscr-checkbox-tools">
        <button type="button" class="btn btn-primary add-oscr-checkbox-item">Add to</button>
        <button type="button" class="btn btn-danger remove-oscr-checkbox-item" style="{{ $remove_button_style }}">Delete</button>
    </div>
</div>
