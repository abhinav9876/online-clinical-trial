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
    <div class="col-md-8">
        <table class="table table-bordered puzz-table">
            <tbody>
                <tr>
                    <th class="puzz-table-label">@lang('admin/smos.form.name')</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($smo))
                                <input name="name" type="text" class="form-control" placeholder="" required autofocus value="{{ $smo->name }}">
                            @else
                                <input name="name" type="text" class="form-control" placeholder="" required autofocus value="{{ env('APP_DEBUG') ? Faker\Factory::create()->company() : old('name') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">@lang('admin/smos.form.admin_name')</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($smo))
                                <input name="admin_name" type="text" class="form-control" placeholder="" required value="{{ $admin->name }}">
                            @else
                                <input name="admin_name" type="text" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? Faker\Factory::create()->name() : old('admin_name') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">@lang('admin/smos.form.admin_email')</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($smo))
                                <input name="admin_email" type="email" class="form-control" placeholder="" required value="{{ $admin->email }}">
                            @else
                                <input name="admin_email" type="email" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? Faker\Factory::create()->safeEmail() : old('admin_email') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">@lang('admin/smos.form.address')</th>
                    <td>
                        <div class="input-group">
                            <label class="sr-only" for="facility_zip_code">@lang('model.post.facility_zip_code')</label>
                            @if (!empty($smo))
                                <input type="text" name="zip_code" id="smo_zipcode" class="form-control" value="{{ $smo->zip_code }}" placeholder="@lang('model.post.facility_zip_code')">
                            @else
                                <input type="text" name="zip_code" id="smo_zipcode" class="form-control" value="{{ old('zip_code') }}" placeholder="@lang('model.post.facility_zip_code')">
                            @endif
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="btn-search-smo-address" type="button">@lang('smo/posts.form.address_auto_search')</button>
                            </span>
                        </div>

                        <div class="form-inline address">
                            <div class="form-group">
                                <label for="smo_address">@lang('model.post.facility_address')</label>
                                @if (!empty($smo))
                                    <input type="text" name="address" id="smo_address" class="form-control" value="{{ $smo->address }}" placeholder="@lang('model.post.facility_address')">
                                @else
                                    <input type="text" name="address" id="smo_address" class="form-control" value="{{ old('address') }}" placeholder="@lang('model.post.facility_address')">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="smo_address_sup">@lang('model.post.facility_address_sup')</label>
                                @if (!empty($smo))
                                    <input type="text" name="address_sup" id="smo_address_sup" class="form-control" value="{{ $smo->address_sup }}" placeholder="@lang('model.post.facility_address_sup')">
                                @else
                                    <input type="text" name="address_sup" id="smo_address_sup" class="form-control" value="{{ old('address_sup') }}" placeholder="@lang('model.post.facility_address_sup')">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="smo_address_notes">@lang('model.post.facility_address_notes')</label>
                                @if (!empty($smo))
                                    <input type="text" name="address_notes" id="smo_address_notes" class="form-control" value="{{ $smo->address_notes }}" placeholder="@lang('model.post.facility_address_notes')">
                                @else
                                    <input type="text" name="address_notes" id="smo_address_notes" class="form-control" value="{{ old('address_notes') }}" placeholder="@lang('model.post.facility_address_notes')">
                                @endif
                            </div>
                        </div>

                        <button type="button" id="btn-clear-smo-address" class="btn btn-default btn-block">@lang('smo/posts.form.clear')</button>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">@lang('model.user.password')</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($smo))
                                <input name="password" type="password" class="form-control" placeholder="Enter for re-setting only" value="">
                            @else
                                <input name="password" type="password" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? 'password' : '' }}">
                            @endif
                        </div>
                        <div class="form-inline has-error hidden has-error-password">
                            <span class="form-text text-danger">password Does not match</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">@lang('model.user.password_confirmation')</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($smo))
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Enter for re-setting only" value="">
                            @else
                                <input name="password_confirmation" type="password" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? 'password' : '' }}">
                            @endif
                        </div>
                        <div class="form-inline has-error hidden has-error-password">
                            <span class="form-text text-danger">password Does not match</span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
