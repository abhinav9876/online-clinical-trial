@extends('layouts.app-smo')

@section('content')
<h1 class="">Group information setting</h1>

<form id="" action="{{ route('smo_profile_company_action') }}" method="POST">
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
                                <input name="name" type="text" class="form-control" placeholder="" value="{{ $smo->name }}" required autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Street address</th>
                        <td>
                            <div class="input-group">
                                <label class="sr-only" for="smo_zipcode">郵便番号</label>
                                <input type="text" name="zip_code" id="smo_zipcode" value="{{ $smo->zip_code }}" class="form-control" placeholder="郵便番号">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="btn-search-smo-address" type="button">Street address自動入力</button>
                                </span>
                            </div>

                            <div class="form-inline cro-address">
                                <div class="form-group">
                                    <label for="smo_address">Street address1</label>
                                    <input type="text" name="address" id="smo_address" value="{{ $smo->address }}" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="smo_address_sup">Street address2</label>
                                    <input type="text" name="address_sup" id="smo_address_sup" value="{{ $smo->address_sup }}" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="smo_address_notes">Remarks</label>
                                    <input type="text" name="address_notes" id="smo_address_notes" value="{{ $smo->address_notes }}" class="form-control" placeholder="">
                                </div>
                            </div>
                            
                            <button type="button" id="btn-clear-smo-address" class="btn btn-default btn-block">クリア</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">contact information</th>
                        <td>
                            <div class="form-inline">
                                <input name="contact" type="text" class="form-control" placeholder="" value="{{ $smo->contact }}">
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
