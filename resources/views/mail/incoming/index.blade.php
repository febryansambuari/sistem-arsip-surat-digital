@extends('layouts.app')

@section('content')

{{-- Breadcrumb Start --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Surat Masuk</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">Data Surat</li>
                    <li class="breadcrumb-item active">Surat Masuk</li>
                </ol>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('incoming-mail.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-square"></i> Tambah Surat
                </a>
            </div>
        </div>

        @if (session('incomingMailMessage'))
            <div class="row mt-3 justify-content-end">
                <div class="col-sm-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i data-feather="check"></i> {{ session('incomingMailMessage') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
{{-- Breadcrumb End --}}

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No. Surat</th>
                                    <th>Tgl. Surat</th>
                                    <th>Asal</th>
                                    <th>Informasi</th>
                                    <th>Diteruskan Kepada</th>
                                    <th>Perihal</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($incomingMails as $mail)
                                    <tr>
                                        <td>{{ $mail->mail_number }}</td>
                                        <td>{{ $mail->mail_date }}</td>
                                        <td>{{ $mail->mail_from }}</td>
                                        <td>{{ $mail->mail_information }}</td>
                                        <td>{{ $mail->mail_to }}</td>
                                        <td>{{ $mail->mail_subject }}</td>
                                        <td>{{ $mail->mail_category }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('incoming-mail.show', $mail->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="icon-eye"></i></a>
                                            <a href="{{ route('incoming-mail.edit', $mail->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="icon-pencil-alt"></i></a>
                                            <a href="javascript:;;" onclick="deleteIncomingMailModal({{ $mail->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <p class="text-muted">No Data Available</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteIncomingMailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteIncomingMail" class="d-none" action="" method="post">
                    @csrf
                    @method('delete')
                </form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Masuk</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus data ini ?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="button" onclick="$('#deleteIncomingMail').submit()">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('scripts')
<script>
    function deleteIncomingMailModal(id) {
        $('#deleteIncomingMail').attr('action', '{{url('incoming-mail/')}}/'+id)
        $('#deleteIncomingMailModal').modal('show')
    }
</script>
@endsection
