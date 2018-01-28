@php
    $s = config('enum.project_status');
    $default_key = 'p' ;
    $keys = App\Project::status_displays();
@endphp

@if (!empty($project))
    <select name="status" class="form-control">
        @foreach ($keys as $key => $display)
            <option value="{{ $s[$key] }}" {{ $project->status == $s[$key] ? 'selected' : '' }}>{{ $display }}</option>
        @endforeach
    </select>
@endif
