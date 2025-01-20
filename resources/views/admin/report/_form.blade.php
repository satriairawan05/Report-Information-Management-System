<form action="{{ $action }}" method="post" onsubmit="btnsubmit.disabled=true; return true;"
    enctype="multipart/form-data">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="row">
        <div class="col-12">
            <input type="hidden" name="folder_id" value="{{ request()->input('folder_id') }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="documentation">Documentation</label>
            <p class="text-dark text-small fs-6">Accepted : PDF,PPT,PPTX,XLS,XLSX,DOC,DOCX,PNG,JPG,JPEG.</p>
            <input type="file" name="documentation" class="form-control form-control-file"
                value="{{ old('documentation') }}" accept=".pdf,.xls,.xlsx,.doc,.docx,.png,.jpg,.jpeg">
            @error('documentation')
                <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="description">Description</label>
            <input type="text" name="description"
                class="form-control @error('description')
                is-invalid
            @enderror"
                placeholder="Ex: Dokumentasi Perjalanan Dinas"
                value="{{ old('description', isset($report) ? $report->description : '') }}" autofocus>
            @error('description')
                <p class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></p>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ $routeBack }}" class="btn btn-secondary"><i class="fas fa-reply"></i></a>
            <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
