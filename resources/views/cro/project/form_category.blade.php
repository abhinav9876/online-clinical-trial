@php
    $c = config('enum.project_category');
    $default_key = 'phase_1' ;
    $keys = App\Project::category_displays();
@endphp

@if (!empty($project))
    <select name="category" class="form-control">
        @foreach ($keys as $key => $display)
            <option value="{{ $c[$key] }}" {{ $project->category == $c[$key] ? 'selected' : '' }}>{{ $display }}</option>
        @endforeach
    </select>
@else
    <select name="category" class="form-control">
        @foreach ($keys as $key => $display)
            <option value="{{ $c[$key] }}" {{ $key == $default_key ? 'selected' : '' }}>{{ $display }}</option>
        @endforeach
    </select>
@endif
