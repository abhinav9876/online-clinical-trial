@php
    if (empty($project)) $questions = [];
    else $questions = $project->online_screener->questions;
@endphp

<!-- hidden template for clone -->
<div class="panel panel-default oscr-panel oscr-panel--template" data-oscr-id="-1">
    @include('cro.project.form_online_screening.item.header')
    @include('cro.project.form_online_screening.item.dropdown')
    @include('cro.project.form_online_screening.item.checkbox')
    @include('cro.project.form_online_screening.item.freetext')
    @include('cro.project.form_online_screening.item.matrix')
</div>

@foreach ($questions as $key => $q)
    <div class="panel panel-default oscr-panel oscr-panel" data-oscr-id="{{ $key }}">
        @include('cro.project.form_online_screening.item.header',
            [
                'panel_id' => $key,
                'question' => $q,
            ]
        )
        @include('cro.project.form_online_screening.item.dropdown',
            [
                'panel_id' => $key,
                'question' => $q,
                'dropdown_values' => json_decode($q->dropdown_values),
            ]
        )
        @include('cro.project.form_online_screening.item.checkbox',
            [
                'panel_id' => $key,
                'question' => $q,
                'checkbox_values' => json_decode($q->checkbox_values),
            ]
        )
        @include('cro.project.form_online_screening.item.freetext',
            [
                'panel_id' => $key,
                'question' => $q,
            ]
        )
        @include('cro.project.form_online_screening.item.matrix',
            [
                'panel_id' => $key,
                'question' => $q,
                'matrix_question_values' => json_decode($q->matrix_question_values),
            ]
        )
    </div>
@endforeach

<button id="add-oscr-panel" type="button" class="btn btn-primary">Add to</button>
<button id="remove-oscr-panel" type="button" class="btn btn-danger" style="{{ empty($questions) ? 'display:none;' : '' }}">Delete</button>
