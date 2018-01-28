@php
    if (empty($question)) {
        $display = true;
    } else {
        $display = $question->answer_type == config('enum.online_screening_answer_type.dropdown');
    }

    if ($display) {
        $style = '';
    } else {
        $style = 'display:none;';
    }
    
    if (!isset($panel_id)) {
        $text_input_name = '';
        $ng_name = '';
    } else {
        $text_input_name = 'oscr_panel[' . $panel_id . '][dropdown_item][]';
        $ng_name = 'oscr_panel[' . $panel_id . '][ng_item][]';
    }
    
    if (empty($dropdown_values) || count($dropdown_values) <= 1) {
        $remove_button_style = 'display:none;';
    } else {
        $remove_button_style = '';
    }
@endphp

<div class="panel-body oscr-dropdown" style="{{ $style }}">
    <div class="input-group puzz-table__form-inline oscr-dropdown-item oscr-dropdown-item--template">
        <span class="input-group-addon">checkbox</span>
        <input type="text" class="form-control" value="">
        <span class="input-group-addon">
            <input type="hidden" value="">
            <label class="inline-checkbox-label">NG <input type="checkbox"></label>
        </span>
    </div>

    @if (empty($dropdown_values))
        <div class="input-group puzz-table__form-inline oscr-dropdown-item">
            <span class="input-group-addon">checkbox</span>
            <input type="text" name="{{ $text_input_name }}" class="form-control" value="">
            <span class="input-group-addon">
                <input type="hidden" name="{{ $ng_name }}" value="">
                <label class="inline-checkbox-label">NG <input type="checkbox"></label>
            </span>
        </div>
    @else
        @foreach ($dropdown_values as $d)
            <div class="input-group puzz-table__form-inline oscr-dropdown-item">
                <span class="input-group-addon">checkbox</span>
                <input type="text" name="{{ $text_input_name }}" class="form-control" value="{{ $d }}" required>
                <span class="input-group-addon">
                    <input type="hidden" name="{{ $ng_name }}" value="">
                    @if (!empty($question->ng_values) && in_array($d, json_decode($question->ng_values)))
                        <label class="inline-checkbox-label">NG <input type="checkbox" checked></label>
                    @else
                        <label class="inline-checkbox-label">NG <input type="checkbox"></label>
                    @endif
                </span>
            </div>
        @endforeach
    @endif

    <div class="form-inline puzz-table__form-inline oscr-dropdown-tools">
        <button type="button" class="btn btn-primary add-oscr-dropdown-item">Add to</button>
        <button type="button" class="btn btn-danger remove-oscr-dropdown-item" style="{{ $remove_button_style }}">Delete</button>
    </div>
</div>
