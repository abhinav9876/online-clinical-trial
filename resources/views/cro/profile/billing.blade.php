@extends('layouts.app-cro')

@section('content')
<h1 class="">Request first setting</h1>


<form id="" action="{{ route('cro_profile_billing_action') }}" method="POST">
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
                        <th class="puzz-table-label">company name</th>
                        <td>
                            <div class="form-inline">
                                <input name="company" type="text" class="form-control" value="{{ $cro->billing->company }}" placeholder="" autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Responsible name</th>
                        <td>
                            <div class="form-inline">
                                <input name="person" type="text" class="form-control" value="{{ $cro->billing->person }}" placeholder="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">Street address</th>
                        <td>
                            <div class="input-group">
                                <label class="sr-only" for="billing_zipcode">郵便番号</label>
                                <input type="text" name="zip_code" id="billing_zipcode" value="{{ $cro->billing->zip_code }}" class="form-control" placeholder="郵便番号">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" id="btn-search-billing-address" type="button">Street address自動入力</button>
                                </span>
                            </div>

                            <div class="form-inline cro-address">
                                <div class="form-group">
                                    <label for="billing_address">Street address1</label>
                                    <input type="text" name="address" id="billing_address" value="{{ $cro->billing->address }}" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="billing_address_sup">Street address2</label>
                                    <input type="text" name="address_sup" id="billing_address_sup" value="{{ $cro->billing->address_sup }}" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="billing_address_notes">Remarks</label>
                                    <input type="text" name="address_notes" id="billing_address_notes" value="{{ $cro->billing->address_notes }}" class="form-control" placeholder="">
                                </div>
                            </div>

                            <button type="button" id="btn-clear-billing-address" class="btn btn-default btn-block">クリア</button>
                        </td>
                    </tr>
                    <tr>
                        <th class="puzz-table-label">contact information</th>
                        <td>
                            <div class="form-inline">
                                <input name="contact" type="text" class="form-control" value="{{ $cro->billing->contact }}" placeholder="">
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
