<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-2">
                <label for="group_name">Role Name <span class="text-danger">*</span> </label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control @error('group_name') is-invalid @enderror" id="group_name"
                    placeholder="Masukan Role Name" value="{{ old('group_name', $group->group_name ?? '') }}"
                    name="group_name">
                @error('group_name')
                    <p class="invalid-feedback" role="alert">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="table-responsive">
                    <table class="table-striped table-bordered table" role="grid" id="user-list-table">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Pages</th>
                                <th class="text-center">Create</th>
                                <th class="text-center">Read</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                                {{-- Uncomment bagian ini untuk aktifkan fitur download --}}
                                {{-- <th class="text-center">Download</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($page_distincts as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{!! str_replace('_', ' ', $d->page_name) . 's' !!}</td>
                                    <td class="text-center">
                                        @foreach ($pages as $p)
                                            @if ($p->page_name == $d->page_name && $p->action == 'Create')
                                                <div class="d-inline">
                                                    <input type="checkbox" id="{!! $p->page_id !!}"
                                                        name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($pages as $p)
                                            @if ($p->page_name == $d->page_name && $p->action == 'Read')
                                                <div class="d-inline">
                                                    <input type="checkbox" id="{!! $p->page_id !!}"
                                                        name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($pages as $p)
                                            @if ($p->page_name == $d->page_name && $p->action == 'Update')
                                                <div class="d-inline">
                                                    <input type="checkbox" id="{!! $p->page_id !!}"
                                                        name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($pages as $p)
                                            @if ($p->page_name == $d->page_name && $p->action == 'Delete')
                                                <div class="d-inline">
                                                    <input type="checkbox" id="{!! $p->page_id !!}"
                                                        name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    {{-- uncomment ini untuk aktifkan checkbox buat download --}}
                                    {{-- <td class="text-center">
                                        @foreach ($pages as $p)
                                            @if ($p->page_name == $d->page_name && $p->action == 'Download')
                                                <div class="d-inline">
                                                    <input type="checkbox" id="{!! $p->page_id !!}"
                                                        name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ $cancelRoute }}" class="btn btn-sm btn-secondary mx-2"><i class="fa fa-reply-all"></i></a>
                <button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">{{ $submitButton }}</button>
            </div>
        </div>
    </div>
</form>
