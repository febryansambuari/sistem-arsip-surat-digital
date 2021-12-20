@extends('layouts.app')

@section('content')

{{-- Breadcrumb Start --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-2">Penambahan Surat Masuk</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">Data Surat</li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('incoming-mail.index') }}">Surat Masuk</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah</li>
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
                    <form class="form theme-form" action="{{ route('incoming-mail.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label>Kategori Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio1" type="radio" name="mail_category" value="biasa">
                                        <label class="mb-0" for="kategoriRadio1">Biasa</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio2" type="radio" name="mail_category" value="segera">
                                        <label class="mb-0" for="kategoriRadio2">Segera</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio3" type="radio" name="mail_category" value="penting">
                                        <label class="mb-0" for="kategoriRadio3">Penting</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="kategoriRadio4" type="radio" name="mail_category" value="rahasia">
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
                                <input class="form-control" type="text" name="mail_number" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label>Tgl. Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="datepicker-here form-control digits" type="text" data-language="en" name="mail_date" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Asal Surat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_from" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Informasi <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_information" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Diteruskan Kepada <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_to" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <label for="col-form-label">Perihal <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="mail_subject" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="document">Upload Lampiran <span class="text-danger">*</span></label>
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
        }
    }
</script>
@endsection
