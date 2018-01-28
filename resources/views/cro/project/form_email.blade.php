<div class="form-inline puzz-table__form-inline notification-email-panel notification-email-panel--template">
    <input type="email" class="form-control" placeholder="">
</div>

@if (!empty($project))
    @php
        // todo: null check
        $emails = json_decode($project->notification_email);
    @endphp

    @foreach ($emails as $email)
    <div class="form-inline puzz-table__form-inline notification-email-panel">
        <input name="notification_email[]" type="email" class="form-control" value="{{ $email }}" placeholder="">
    </div>
    @endforeach
@endif

<div class="form-inline puzz-table__form-inline">
    <button id="add-notification-email-panel" type="button" class="btn btn-primary">Add to</button>
    <button id="remove-notification-email-panel" type="button" class="btn btn-danger" style="display: none;">Delete</button>
</div>