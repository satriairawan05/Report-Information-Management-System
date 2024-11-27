<form action="{{ $action }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="table-responsive">
        <table class="table-striped table-bordered table" role="grid" id="user-list-table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text"
                            class="form-control @error('name')
                        is-invalid
                    @enderror"
                            name="name" id="name" placeholder="Example : Budi"
                            value="{{ old('name', $userActive->name) }}">
                        @error('name')
                            <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="text"
                            class="form-control @error('email')
                        is-invalid
                    @enderror"
                            name="email" id="email" placeholder="Example : budi@gmail.com"
                            value="{{ old('email', $userActive->email) }}">
                        @error('email')
                            <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Nomor Induk Pegawai</th>
                    <td>
                        <input type="text"
                            class="form-control @error('nip')
                        is-invalid
                    @enderror"
                            name="nip" id="nip" placeholder="Example : 1999####2024#######"
                            value="{{ old('nip', $userActive->nip) }}" maxLength="18">
                        @error('nip')
                            <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Pangkat/Golongan</th>
                    <td>
                        <div class="row">
                            <div class="col-6">
                                <input type="text"
                                    class="form-control @error('rank')
                        is-invalid
                    @enderror"
                                    name="rank" id="rank" placeholder="Example : Pembina"
                                    value="{{ old('rank', $userActive->rank) }}">
                                @error('rank')
                                    <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text"
                                    class="form-control @error('group')
                        is-invalid
                    @enderror"
                                    name="group" id="group" placeholder="Example : III.c"
                                    value="{{ old('group', $userActive->group) }}">
                                @error('group')
                                    <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>
                        <input type="text"
                            class="form-control @error('position')
                        is-invalid
                    @enderror"
                            name="position" id="position" placeholder="Example : Kepala Bidang"
                            value="{{ old('position', $userActive->position) }}">
                        @error('position')
                            <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        <select class="form-control" id="selectuserrole" name="role_id">
                            <option>Select</option>
                            @if (isset($roles))
                                @foreach ($roles as $role)
                                    @if ($role->role_id == $userActive->role_id)
                                        <option value="{{ $role->group_id }}" selected>{{ $role->group_name }}
                                        </option>
                                    @else
                                        <option value="{{ $role->group_id }}">{{ $role->group_name }}</option>
                                    @endif
                                @endforeach
                                @error('role_id')
                                    <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                            @endif
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>
                        <div class="row">
                            <div class="col-6 input-group">
                                <input name="password" type="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter Password" autocomplete="new-password" maxlength="20" />
                                <span class="input-group-text">
                                    <a href="javascript:;" id="togglePassword"><i
                                            class="fas fa-lock text-4 text-dark"></i></a>
                                </span>
                                @error('password')
                                    <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
                                @enderror
                            </div>
                            <div class="col-6 input-group">
                                <input name="password_confirmation" type="password" id="passwordConfirm"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Enter Confirm Password" autocomplete="new-password" maxlength="20" />
                                <span class="input-group-text">
                                    <a href="javascript:;" id="togglePasswordConfirm"><i
                                            class="fas fa-lock text-4 text-dark"></i></a>
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-center">
                    <th colspan="2">
                        <a href="{{ route('profile.index') }}" class="btn btn-secondary"><i
                                class="fas fa-reply"></i></a>
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

</form>
