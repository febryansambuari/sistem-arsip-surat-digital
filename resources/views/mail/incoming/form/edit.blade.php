@extends('layouts.app')

@section('content')

{{-- Breadcrumb Start --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-2">Perbaharuan Surat Masuk</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">Data Surat</li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('incoming-mail.index') }}">Surat Masuk</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui</li>
                </ol>
            </div>
        </div>
    </div>
</div>
{{-- Breadcrumb End --}}

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form class="form theme-form" action="{{ route('incoming-mail.update', $incomingMail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label>Kategori Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio1" type="radio" name="mail_category" value="biasa" {{ $incomingMail->mail_category == 'biasa' ? 'checked' : '' }}>
                                        <label class="mb-0" for="kategoriRadio1">Biasa</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio2" type="radio" name="mail_category" value="segera" {{ $incomingMail->mail_category == 'segera' ? 'checked' : '' }}>
                                        <label class="mb-0" for="kategoriRadio2">Segera</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio3" type="radio" name="mail_category" value="penting" {{ $incomingMail->mail_category == 'penting' ? 'checked' : '' }}>
                                        <label class="mb-0" for="kategoriRadio3">Penting</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio4" type="radio" name="mail_category" value="rahasia" {{ $incomingMail->mail_category == 'rahasia' ? 'checked' : '' }}>
                                        <label class="mb-0" for="kategoriRadio4">Rahasia</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label>No. Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_number" value="{{ old('mail_number') ?? $incomingMail->mail_number }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label>Tgl. Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="datepicker-here form-control digits" type="text" data-language="en" name="mail_date" value="{{ old('mail_date') ?? $incomingMail->mail_date }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Asal Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_from" value="{{ old('mail_from') ?? $incomingMail->mail_from }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Informasi <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_information" value="{{ old('mail_information') ?? $incomingMail->mail_information }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Diteruskan Kepada <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_to" value="{{ old('mail_to') ?? $incomingMail->mail_to }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Perihal <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_subject" value="{{ old('mail_subject') ?? $incomingMail->mail_subject }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="document">Upload Lampiran</label>
                                <div class="needsclick dropzone" id="document-dropzone">

                                </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="text-end">
                                    <button class="btn btn-primary me-2" type="submit">Simpan</button>
                                    <a class="btn btn-light" href="{{ route('incoming-mail.index') }}">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('scripts')
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('incoming-mail.storeMedia') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function() {
            @if (isset($documents))
                var files = {!! json_encode($documents) !!}
                for (var i in files) {
                    var file = files[i]
                    console.log(file);
                    file = {
                        ...file,
                        width: 226,
                        height: 324
                    }
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.original_url)
                    file.previewElement.classList.add('dz-complete')

                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }
</script>
@endsection
