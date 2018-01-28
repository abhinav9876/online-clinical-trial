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
                <th class="puzz-table-label">@lang('model.project.name')</th>
                <td>
                    <label class="sr-only" for="project-name">@lang('model.project.name')</label>
                    <input type="text" name="project-name" id="project-name" value="{{ $project->name }}" class="form-control" disabled>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.project.protocol')</th>
                <td>
                    <label class="sr-only" for="project-protocol">@lang('model.project.protocol')</label>
                    <input type="text" name="project-protocol" id="project-protocol" value="{{ $project->protocol }}" class="form-control" disabled>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.project.drug_type')</th>
                <td>
                    <label class="sr-only" for="project-drug-type">@lang('model.project.drug_type')</label>
                    <input type="text" name="project-drug-type" id="project-drug-type" value="{{ $project->drug_type_display() }}" class="form-control" disabled>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.project.drug')</th>
                <td>
                    <label class="sr-only" for="project-drug">@lang('model.project.drug')</label>
                    <input type="text" name="project-drug" id="project-drug" value="{{ $project->drug }}" class="form-control" disabled>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered puzz-table">
            <tbody>
            <tr>
                <th class="puzz-table-label">@lang('model.post.title')</th>
                <td>
                    <label class="sr-only" for="title">@lang('model.post.title')</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->exists ? $post->title : $drug_info['title']) }}" class="form-control" placeholder="@lang('model.post.title')" required>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.description')</th>
                <td>
                    <label class="sr-only" for="description">@lang('model.post.description')</label>
                    <input type="text" name="description" id="description" value="{{ old('description', $post->exists ? $post->description : $drug_info['description']) }}" class="form-control" placeholder="@lang('model.post.description')" required>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.required_subject_gender')</th>
                <td>
                    <div class="radio">
                        <label>
                            <input type="radio" name="required_subject_gender" id="required_subject_gender_male" value="{{ config('enum.post_gender_conditions.male') }}" {{ $post->required_subject_gender == config('enum.post_gender_conditions.male') ? 'checked' : '' }}>@lang('model.post.required_subject_gender_male')
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="required_subject_gender" id="required_subject_gender_male_female" value="{{ config('enum.post_gender_conditions.female') }}" {{ $post->required_subject_gender == config('enum.post_gender_conditions.female') ? 'checked' : '' }}>@lang('model.post.required_subject_gender_female')
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="required_subject_gender" id="required_subject_gender_male_any" value="{{ config('enum.post_gender_conditions.any') }}" {{ $post->required_subject_gender == config('enum.post_gender_conditions.any') ? 'checked' : '' }}>@lang('model.post.required_subject_gender_any')
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('smo/posts.form.subject_age_range')</th>
                <td>
                    <div class="age-range-form-container">
                        <div>
                            <label class="sr-only" for="minimum_subject_age">@lang('model.post.minimum_subject_age')</label>
                            <input id="minimum_subject_age" type="number" min="0" max="200" name="minimum_subject_age" value="{{ $post->minimum_subject_age }}" class="form-control" required>
                        </div>
                        <span class="age-range-form-container__input-separator">〜</span>
                        <div>
                            <label class="sr-only" for="maximum_subject_age">@lang('model.post.maximum_subject_age')</label>
                            <input id="maximum_subject_age" type="number" min="0" max="200" name="maximum_subject_age" value="{{ $post->maximum_subject_age }}" class="form-control" required>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered puzz-table">
            <tbody>
            <tr>
                <th class="puzz-table-label">@lang('model.post.facility_name')</th>
                <td>
                    <label class="sr-only" for="facility_name">@lang('model.post.facility_name')</label>
                    <div class="input-group">
                        <input type="text" name="facility_name" id="facility_name" value="{{ old('facility_name', $post->exists ? $post->facility_name : App\Helper\inputDefaultName()) }}" class="form-control" placeholder="@lang('model.post.facility_name')" required>
                        <div class="input-group-addon">
                            <label class="inline-checkbox-label">非表示
                                @if($post->prefers_hidden_facility_name)
                                    <input type="checkbox" name="prefers_hidden_facility_name" id="prefers_hidden_facility_name" checked>
                                @else
                                    <input type="checkbox" name="prefers_hidden_facility_name" id="prefers_hidden_facility_name">
                                @endif
                            </label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('smo/posts.form.facility_address')</th>
                <td>
                    <div class="input-group">
                        <label class="sr-only" for="facility_zip_code">@lang('model.post.facility_zip_code')</label>
                        <input type="text" name="facility_zip_code" id="facility_zip_code" value="{{ old('facility_zip_code', $post->exists ? $post->facility_zip_code : App\Helper\inputDefaultZipCode()) }}" class="form-control" placeholder="@lang('model.post.facility_zip_code')" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="btn-search-address" type="button">@lang('smo/posts.form.address_auto_search')</button>
                        </span>
                    </div>

                    <div class="form-inline facility_address">
                        <div class="form-group">
                            <label for="facility_address">@lang('model.post.facility_address')</label>
                            <input type="text" name="facility_address" id="facility_address" value="{{ old('facility_address', $post->exists ? $post->facility_address : App\Helper\inputDefaultAddress()) }}" class="form-control" placeholder="@lang('model.post.facility_address')" required>
                        </div>
                        <div class="form-group">
                            <label for="facility_address_sup">@lang('model.post.facility_address_sup')</label>
                            <input type="text" name="facility_address_sup" id="facility_address_sup" value="{{ old('facility_address_sup', $post->exists ? $post->facility_address_sup : App\Helper\inputDefaultAddressSup()) }}" class="form-control" placeholder="@lang('model.post.facility_address_sup')" required>
                        </div>
                        <div class="form-group">
                            <label for="facility_address_notes">@lang('model.post.facility_address_notes')</label>
                            <input type="text" name="facility_address_notes" id="facility_address_notes" value="{{ old('facility_address_notes', $post->facility_address_notes) }}" class="form-control" placeholder="@lang('model.post.facility_address_notes')">
                        </div>
                    </div>

                    <button type="button" id="btn-clear-address" class="btn btn-default btn-block">@lang('smo/posts.form.clear')</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="form-group form-group--exam_schedule_items">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>@lang('smo/posts.form.label')</th>
                    <th>@lang('model.post.exam_schedule_items')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (count($post->exam_schedule_items) > 0)
                    @foreach($post->exam_schedule_items as $exam_schedule_item)
                        <tr class="exam_schedule_item" id="exam_schedule_items[{{ $loop->index }}]">
                            <td>
                                <input type="text" name="exam_schedule_items[{{ $loop->index }}][label]" id="exam_schedule_items[{{ $loop->index }}][label]" value="{{ $post->exam_schedule_items[$loop->index ]['label'] }}" class="form-control exam_schedule_item__label" placeholder="@lang('smo/posts.form.label')">
                            </td>
                            <td>
                                <div class='input-group date datetimepicker'>
                                    <input type="text" name="exam_schedule_items[{{ $loop->index }}][conduct_at]" id="exam_schedule_items[{{ $loop->index }}][conduct_at]" value="{{ App\Helper\changeLocaleModelToDisplay($post->exam_schedule_items[$loop->index ]['conduct_at']) }}" class="form-control exam_schedule_item__conduct_at" placeholder="@lang('model.post.exam_schedule_items')">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-block button--delete"><i class="glyphicon glyphicon-remove"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="exam_schedule_item" id="exam_schedule_items[0]">
                        <td>
                            <input type="text" name="exam_schedule_items[0][label]" id="exam_schedule_items[0][label]" class="form-control exam_schedule_item__label" placeholder="@lang('smo/posts.form.label')">
                        </td>
                        <td>
                            <div class='input-group date datetimepicker'>
                                <input type="text" name="exam_schedule_items[0][conduct_at]" id="exam_schedule_items[0][conduct_at]" class="form-control exam_schedule_item__conduct_at" placeholder="@lang('model.post.exam_schedule_items')">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-block button--delete"><i class="glyphicon glyphicon-remove"></i></button>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            <button type="button" id="add-exam-schedule-item-btn" class="btn btn-default btn-block">@lang('smo/posts.form.add')</button>
        </div>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered puzz-table">
            <tbody>
            <tr>
                <th class="puzz-table-label">@lang('model.post.required_no_scr')</th>
                <td>
                    <label class="sr-only" for="required_no_scr">@lang('model.post.required_no_scr')</label>
                    <input type="number" name="required_no_scr" id="required_no_scr" class="form-control" value="{{ old('required_no_scr', $post->exists ? $post->required_no_scr : App\Helper\inputDefaultNumber()) }}" min="0" placeholder="@lang('model.post.required_no_scr')" required>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.start_recruitment_at')</th>
                <td>
                    <div class='input-group date datetimepicker'>
                        <label class="sr-only" for="start_recruitment_at">@lang('model.post.start_recruitment_at')</label>
                        <input type="text" name="start_recruitment_at" id="start_recruitment_at" class="form-control" value="{{ old('start_recruitment_at', App\Helper\changeLocaleModelToDisplay($post->start_recruitment_at)) }}" placeholder="@lang('model.post.start_recruitment_at')" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.end_recruitment_at')</th>
                <td>
                    <div class='input-group date datetimepicker'>
                        <label class="sr-only" for="end_recruitment_at">@lang('model.post.end_recruitment_at')</label>
                        <input type="text" name="end_recruitment_at" id="end_recruitment_at" class="form-control" value="{{ old('end_recruitment_at', App\Helper\changeLocaleModelToDisplay($post->end_recruitment_at)) }}" placeholder="@lang('model.post.end_recruitment_at')" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered puzz-table">
            <tbody>
            <tr>
                <th class="puzz-table-label">@lang('model.post.selection_criteria')</th>
                <td>
                    <textarea class="form-control" name="selection_criteria" id="selection_criteria" rows="3" placeholder="@lang('model.post.selection_criteria')">{{ old('selection_criteria', $post->exists ? $post->selection_criteria : $drug_info['inclusion']) }}</textarea>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.exclusion_criteria')</th>
                <td>
                    <textarea class="form-control" name="exclusion_criteria" id="exclusion_criteria" rows="3" placeholder="@lang('model.post.exclusion_criteria')">{{ old('exclusion_criteria', $post->exists ? $post->exclusion_criteria : $drug_info['exclusion']) }}</textarea>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.participation_benefits')</th>
                <td>
                    <textarea class="form-control" name="participation_benefits" id="participation_benefits" rows="3" placeholder="@lang('model.post.participation_benefits')">{{ old('participation_benefits', $post->exists ? $post->participation_benefits : __('smo/posts.form.benefits_template')) }}</textarea>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered puzz-table">
            <tbody>
            <tr>
                <th class="puzz-table-label">@lang('model.post.crc_name')</th>
                <td>
                    <label class="sr-only" for="crc_name">@lang('model.post.crc_name')</label>
                    <input type="text" name="crc_name" id="crc_name" value="{{ old('crc_name', $post->exists ? $post->crc_name : App\Helper\currentSMOUser()->name) }}" class="form-control" placeholder="@lang('model.post.crc_name')" required>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.crc_email')</th>
                <td>
                    <label class="sr-only" for="crc_email">@lang('model.post.crc_email')</label>
                    <input type="email" name="crc_email" id="crc_email" value="{{ old('crc_email', $post->exists ? $post->crc_email : App\Helper\currentSMOUser()->email) }}" class="form-control" placeholder="@lang('model.post.crc_email')" required>
                </td>
            </tr>
            <tr>
                <th class="puzz-table-label">@lang('model.post.exam_day_notes')</th>
                <td>
                    <textarea name="exam_day_notes" id="exam_day_notes" class="form-control" rows="3" placeholder="@lang('model.post.exam_day_notes')">{{ old('exam_day_notes', $post->exam_day_notes) }}</textarea>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="form-group form-group--reward_items">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>@lang('smo/posts.form.label')</th>
                    <th>@lang('model.post.reward_items')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (count($post->reward_items) > 0)
                    @foreach($post->reward_items as $reward_item)
                        <tr class="reward_item" id="reward_items[{{ $loop->index }}]">
                            <td>
                                <input type="text" name="reward_items[{{ $loop->index }}][label]" id="reward_items[{{ $loop->index }}][label]" value="{{ $post->reward_items[$loop->index]['label'] }}" class="form-control reward_item__label" placeholder="@lang('smo/posts.form.label')">
                            </td>
                            <td>
                                <input type="text" name="reward_items[{{ $loop->index }}][reward]" id="reward_items[{{ $loop->index }}][reward]" value="{{ $post->reward_items[$loop->index]['reward'] }}" class="form-control reward_item__reward" placeholder="@lang('model.post.reward_items')">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-block button--delete"><i class="glyphicon glyphicon-remove"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="reward_item" id="reward_items[0]">
                        <td>
                            <input type="text" name="reward_items[0][label]" id="reward_items[0][label]" class="form-control reward_item__label" placeholder="@lang('smo/posts.form.label')">
                        </td>
                        <td>
                            <input type="text" name="reward_items[0][reward]" id="reward_items[0][reward]" class="form-control reward_item__reward" placeholder="@lang('model.post.reward_items')">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-block button--delete"><i class="glyphicon glyphicon-remove"></i></button>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            <button type="button" id="add-reward-item-btn" class="btn btn-default btn-block">@lang('smo/posts.form.add')</button>
        </div>
    </div>
</div>