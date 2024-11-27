<form action="{{ $action }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="row mb-3">
        <div class="col-12">
            <label for="name">Name</label>
            <input type="text" name="name"
                class="form-control @error('name')
                is-invalid
            @enderror"
                placeholder="Ex: Perjalanan Dinas" value="{{ isset($folder) ? old('name',$folder->name) : old('name') }}" autofocus>
            @error('name')
                <small class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></small>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-check">
                <input type="checkbox" name="is_for_admin" id="is_for_admin" class="form-check-input"
                    {{ isset($folder) && $folder->is_for_admin ? 'checked' : '' }}>
                <label for="is_for_admin" class="form-check-label">Visible to Admin</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ $routeBack }}" class="btn btn-secondary"><i class="fas fa-reply"></i></a>
            <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
