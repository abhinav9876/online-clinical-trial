
@if (!empty($project))
    @if (!empty($makers))
        <select name="maker" class="form-control">
            <option value="{{ config('enum.form_select_unselected') }}" selected>Unselected</option>
            @foreach ($makers as $maker)
                <option value="{{ $maker->id }}" {{ $project->maker_id == $maker->id ? 'selected' : '' }}>{{ $maker->name }}</option>
            @endforeach
        </select>
    @else
      There are no selectable Pharmaceutical companies
    @endif
@else
    <select name="maker" class="form-control">
        <option value="{{ config('enum.form_select_unselected') }}" selected>Unselected</option>
        @foreach ($makers as $maker)
            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
        @endforeach
    </select>
@endif
