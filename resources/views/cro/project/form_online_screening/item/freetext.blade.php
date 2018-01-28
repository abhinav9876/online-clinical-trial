@php
    if (empty($question)) $display = false;
    else $display = $question->answer_type == config('enum.online_screening_answer_type.freetext');

    if ($display) $style = '';
    else $style = 'display: none;';
@endphp

<div class="panel-body oscr-freetext" style="{{ $style }}">
    <div class="input-group puzz-table__form-inline oscr-freetext-item">
        Answer by free description
    </div>
</div>
