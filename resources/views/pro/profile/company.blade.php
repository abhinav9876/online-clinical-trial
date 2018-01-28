@extends('layouts.app-pro')

@section('content')
    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h1>@lang('pro/profile.company.title')</h1>

    <form id="" action="{{ route('pro_profile_update_company') }}" method="POST">
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
                        <th class="puzz-table-label">@lang('model.pro.name')</th>
                        <td>
                            <div class="form-inline">
                                <input name="name" type="text" class="form-control" placeholder="@lang('model.pro.name')" value="{{ $pro->name }}" required autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">@lang('pro/profile.company.address')</th>
                        <td>
                            <div class="input-group">
                                <label class="sr-only" for="smo_zipcode">@lang('model.pro.zip_code')</label>
                                <input type="text" name="zip_code" id="smo_zipcode" value="{{ $pro->zip_code }}" class="form-control" placeholder="@lang('model.pro.zip_code')">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="btn-search-smo-address" type="button">@lang('pro/profile.company.address_auto_fill')</button>
                                </span>
                            </div>

                            <div class="form-inline cro-address">
                                <div class="form-group">
                                    <label for="smo_address">@lang('model.pro.address')</label>
                                    <input type="text" name="address" id="smo_address" value="{{ $pro->address }}" class="form-control" placeholder="@lang('model.pro.address')">
                                </div>
                                <div class="form-group">
                                    <label for="smo_address_sup">@lang('model.pro.address_sup')</label>
                                    <input type="text" name="address_sup" id="smo_address_sup" value="{{ $pro->address_sup }}" class="form-control" placeholder="@lang('model.pro.address_sup')">
                                </div>
                                <div class="form-group">
                                    <label for="smo_address_notes">@lang('model.pro.address_notes')</label>
                                    <input type="text" name="address_notes" id="smo_address_notes" value="{{ $pro->address_notes }}" class="form-control" placeholder="@lang('model.pro.address_notes')">
                                </div>
                            </div>

                            <button type="button" id="btn-clear-smo-address" class="btn btn-default btn-block">@lang('pro/profile.company.clear_btn')</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">@lang('model.pro.contact')</th>
                        <td>
                            <div class="form-inline">
                                <input name="contact" type="text" class="form-control" placeholder="@lang('model.pro.contact')" value="{{ $pro->contact }}">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button id="create" type="submit" class="btn btn-primary">@lang('pro/profile.company.save')</button>
            </div>
        </div>
    </form>
@endsection