@extends('layouts.app-cro')

@section('content')
<h1 class="">Group information setting</h1>

<form id="" action="{{ route('cro_profile_company_action') }}" method="POST">
    {{ csrf_field() }}

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
                        <th class="puzz-table-label">Organization name</th>
                        <td>
                            <div class="form-inline">
                                <input name="name" type="text" class="form-control" placeholder="" value="{{ $cro->name }}" required autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Street address</th>
                        <td>
                            <div class="input-group">
                                <label class="sr-only" for="facility_zip_code">@lang('model.post.facility_zip_code')</label>
                                <input type="text" name="zip_code" id="cro_zipcode" value="{{ $cro->zip_code }}" class="form-control" placeholder="@lang('model.post.facility_zip_code')">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="btn-search-cro-address" type="button">@lang('smo/posts.form.address_auto_search')</button>
                                </span>
                            </div>

                            <div class="form-inline cro-address">
                                <div class="form-group">
                                    <label for="cro_address">@lang('model.post.facility_address')</label>
                                    <input type="text" name="address" id="cro_address" value="{{ $cro->address }}" class="form-control" placeholder="@lang('model.post.facility_address')">
                                </div>
                                <div class="form-group">
                                    <label for="cro_address_sup">@lang('model.post.facility_address_sup')</label>
                                    <input type="text" name="address_sup" id="cro_address_sup" value="{{ $cro->address_sup }}" class="form-control" placeholder="@lang('model.post.facility_address_sup')">
                                </div>
                                <div class="form-group">
                                    <label for="cro_address_notes">@lang('model.post.facility_address_notes')</label>
                                    <input type="text" name="address_notes" id="cro_address_notes" value="{{ $cro->address_notes }}" class="form-control" placeholder="@lang('model.post.facility_address_notes')">
                                </div>
                            </div>

                            <button type="button" id="btn-clear-cro-address" class="btn btn-default btn-block">@lang('smo/posts.form.clear')</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">contact information</th>
                        <td>
                            <div class="form-inline">
                                <input name="contact" type="text" class="form-control" placeholder="" value="{{ $cro->contact }}">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button id="create" type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection
