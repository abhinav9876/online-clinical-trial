<div class="form-inline puzz-table__form-inline smo-panel smo-panel--template">
    <select class="form-control">
        @foreach ($smos as $smo)
            <option value="{{ $smo->id }}">{{ $smo->name }}</option>
        @endforeach
    </select>
</div>
@if (!empty($project))
    @foreach ($project->smos as $project_smo)
        <div class="form-inline puzz-table__form-inline smo-panel">
            <select name="smo[]" class="form-control">
                @foreach ($smos as $smo)
                    <option value="{{ $smo->id }}" {{ $project_smo->smo_id == $smo->id ? 'selected' : '' }}>{{ $smo->name }}</option>
                @endforeach
            </select>
        </div>
    @endforeach
@endif

<div class="form-inline puzz-table__form-inline">
    <button id="add-smo-panel" type="button" class="btn btn-primary">Add to</button>
    <button id="remove-smo-panel" type="button" class="btn btn-danger" style="display: none;">Delete</button>
</div>