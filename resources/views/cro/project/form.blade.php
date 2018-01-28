@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered puzz-table">
            <tbody>
                <tr>
                    <th class="puzz-table-label">Disease name</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($project))
                                <input name="name" type="text" class="form-control" value="{{ $project->name }}" placeholder="" required autofocus>
                            @else
                                <input name="name" type="text" class="form-control" placeholder="" required autofocus value="{{ env('APP_DEBUG') ? Faker\Factory::create()->name() : old('name') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">Protocol number</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($project))
                                <input name="protocol" type="text" class="form-control" value="{{ $project->protocol }}" placeholder="" required>
                            @else
                                <input name="protocol" type="text" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? Faker\Factory::create()->name() : old('protocol') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">Drug ID setting</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($project))
                                <input name="drug" type="text" class="form-control" value="{{ $project->drug }}" placeholder="">
                            @else
                                <input name="drug" type="text" class="form-control" placeholder="" value="{{ env('APP_DEBUG') ? 'C000000001' : old('drug') }}">
                            @endif
                        </div>
                        @if (!empty($project))
                            <div class="form-inline">
                                <label class="radio-inline"><input type="radio" name="drug_type"
                                    value="{{ config('enum.drug_type.japic') }}" {{ $project->drug_type == config('enum.drug_type.japic') ? 'checked' : '' }}>Japic(input example: JapicCTI-050001)</label>
                            </div>
                            <div class="form-inline">
                                <label class="radio-inline"><input type="radio" name="drug_type"
                                    value="{{ config('enum.drug_type.umin') }}" {{ $project->drug_type == config('enum.drug_type.umin') ? 'checked' : '' }}>UminID(input example: C000000001)</label>
                            </div>
                            <div class="form-inline">
                                <label class="radio-inline"><input type="radio" name="drug_type"
                                    value="{{ config('enum.drug_type.jmacct') }}" {{ $project->drug_type == config('enum.drug_type.jmacct') ? 'checked' : '' }}>JMACCTID(input example: JMA-IIA00001)</label>
                            </div>
                        @else
                            <div class="form-inline"><label class="radio-inline"><input type="radio" name="drug_type" value="{{ config('enum.drug_type.japic') }}" {{ old('drug_type') == config('enum.drug_type.japic') ? 'checked' : '' }}>Japic(input example: JapicCTI-050001)</label></div>
                            <div class="form-inline"><label class="radio-inline"><input type="radio" name="drug_type" value="{{ config('enum.drug_type.umin') }}" {{ old('drug_type') == config('enum.drug_type.umin') ? 'checked' : '' }}>UminID(input example: C000000001)</label></div>
                            <div class="form-inline"><label class="radio-inline"><input type="radio" name="drug_type" value="{{ config('enum.drug_type.jmacct') }}" {{ old('drug_type') == config('enum.drug_type.jmacct') ? 'checked' : '' }}>JMACCTID(input example: JMA-IIA00001)</label></div>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered puzz-table">
            <tbody>
                <tr>
                    <th class="puzz-table-label">Mail notification settings</th>
                    <td>
                        <div class="checkbox">
                            <label>
                                @if (!empty($project))
                                    <input type="checkbox" name="notification_enabled" value="{{ config('enum.form_checkbox_on') }}" {{ $project->notification_enabled == config('enum.project_notification.enabled') ? 'checked' : '' }}> Notify project creator of e-mail
                                @else
                                    <input type="checkbox" name="notification_enabled" value="{{ config('enum.form_checkbox_on') }}" {{ old('notification_enabled') == config('enum.form_checkbox_on') ? 'checked' : '' }}> Notify project creator of e-mail
                                @endif
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">Add e-mail notification target</th>
                    <td>
                        @include('cro.project.form_email')
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered puzz-table">
            <tbody>
                <tr class="{{ $owner->cro()->type == config('enum.cro_type.cro') ? '' : 'hidden' }}">
                    <th class="puzz-table-label">Pharmaceutical company selection</th>
                    <td>
                        @include('cro.project.form_maker')
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">Category setting</th>
                    <td>
                        @include('cro.project.form_category')
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered puzz-table">
            <tbody>
                <tr>
                    <th class="puzz-table-label">SMO assignment setting</th>
                    <td>
                        @include('cro.project.form_smo')
                    </td>
                </tr>
            </tbody>
        </table>

        @if (!empty($project))
            <table class="table table-bordered puzz-table">
                <tbody>
                    <tr>
                        <th class="puzz-table-label">公開Statussetting</th>
                        <td>
                            @include('cro.project.form_status')
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif

        <table class="table table-bordered puzz-table">
            <tbody>
                <tr>
                    <th class="puzz-table-label">Online Screeningsetting</th>
                    <td>
                        @if (empty($project) || $project->posts->count() == 0)
                            @include('cro.project.form_online_screening.edit')
                        @else
                            @include('cro.project.form_online_screening.show')
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
