@extends('layouts.app')

@section('content')

{{-- Breadcrumb Start --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-2">Detail Surat Masuk</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">Data Surat</li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('incoming-mail.index') }}">Surat Masuk</a>
                    </li>
                    <li class="breadcrumb-item active">Detail</li>
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
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label>Kategori Surat <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="mail_category" value="{{ $incomingMail->mail_category }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label>No. Surat <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="mail_number" value="{{ $incomingMail->mail_number }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label>Tgl. Surat <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="datepicker-here form-control digits" type="text" data-language="en" name="mail_date" value="{{ $incomingMail->mail_date }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label for="col-form-label">Asal Surat <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="mail_from" value="{{ $incomingMail->mail_from }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label for="col-form-label">Informasi <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="mail_information" value="{{ $incomingMail->mail_information }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label for="col-form-label">Diteruskan Kepada <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="mail_to" value="{{ $incomingMail->mail_to }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label for="col-form-label">Perihal <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="mail_subject" value="{{ $incomingMail->mail_subject }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <label class="col-form-label">Lampiran</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-primary">
                                        <th class="text-center">No</th>
                                        <th>Berkas</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($incomingMail->documents as $idx => $document)
                                            <th class="text-center">{{ ++$idx }}</th>
                                            <th>
                                                <a href="/storage/{{ $document->id }}/{{ $document->file_name }}" target="_blank">{{ $document->file_name }}</a>
                                            </th>
                                            <th class="text-center">
                                                <a href="/storage/{{ $document->id }}/{{ $document->file_name }}" download><i class="icon-save-alt"></i></a>
                                            </th>
                                        @empty
                                            <th colspan="2">Tidak Ada Data</th>
                                        @endforelse
                                    </tbody>
                                </table>
                                <p class="mt-3">
                                    <small class="p-3 txt-info">* Untuk melihat detail dokumen, klik pada nama dokumen.</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-end">
                            <a class="btn btn-light" href="{{ route('incoming-mail.index') }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
