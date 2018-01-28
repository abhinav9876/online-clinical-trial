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
                    <th class="puzz-table-label">name</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($user))
                                <input name="name" type="text" class="form-control" placeholder="" required autofocus value="{{ $user->name }}">
                            @else
                                <input name="name" type="text" class="form-control" placeholder="" required autofocus value="{{ env('APP_DEBUG') ? Faker\Factory::create()->name() : old('name') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">Position</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($user))
                                <input name="position" type="text" class="form-control" placeholder="" autofocus value="{{ $user->attribute->position }}">
                            @else
                                <input name="position" type="text" class="form-control" placeholder="" required autofocus value="{{ env('APP_DEBUG') ? Faker\Factory::create()->name() : old('position') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">mail address</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($user))
                                <input name="email" type="email" class="form-control" placeholder="" required value="{{ $user->email }}">
                            @else
                                <input name="email" type="email" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? Faker\Factory::create()->safeEmail() : old('email') }}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="puzz-table-label">password</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($user))
                                <input name="password" type="password" class="form-control" placeholder="@lang('smo/members.form.password_reset_placeholder')" value="">
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
                    <th class="puzz-table-label">password（confirmation）</th>
                    <td>
                        <div class="form-inline">
                            @if (!empty($user))
                                <input name="password_confirmation" type="password" class="form-control" placeholder="@lang('smo/members.form.password_reset_placeholder')" value="">
                            @else
                                <input name="password_confirmation" type="password" class="form-control" placeholder="" required value="{{ env('APP_DEBUG') ? 'password' : '' }}">
                            @endif
                        </div>
                        <div class="form-inline has-error hidden has-error-password">
                            <span class="form-text text-danger">password Does not match</span>
                        </div>
                    </td>
                </tr>
                @if (!empty($user))
                    <tr>
                        <th class="puzz-table-label">Active checkBOX</th>
                        <td>
                            <div class="form-inline">
                                <select name="status" class="form-control">
                                    <option value="{{ config('enum.user_status.active') }}" {{ $user->status == config('enum.user_status.active') ? 'selected' : '' }}>有効</option>
                                    <option value="{{ config('enum.user_status.inactive') }}" {{ $user->status == config('enum.user_status.inactive') ? 'selected' : '' }}>無効</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
