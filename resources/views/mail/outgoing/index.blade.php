@extends('layouts.app')

@section('content')

{{-- Breadcrumb Start --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Surat Keluar</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">Data Surat</li>
                    <li class="breadcrumb-item active">Surat Keluar</li>
                </ol>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('outgoing-mail.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-square"></i> Tambah Surat
                </a>
            </div>
        </div>

        @if (session('outgoingMailMessage'))
            <div class="row mt-3 justify-content-end">
                <div class="col-sm-6">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i data-feather="check"></i> {{ session('outgoingMailMessage') }}
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
                                    <th>Dari</th>
                                    <th>Kepada</th>
                                    <th>Perihal</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($outgoingMails as $mail)
                                    <tr>
                                        <td>{{ $mail->mail_number }}</td>
                                        <td>{{ $mail->mail_date }}</td>
                                        <td>{{ $mail->mail_from }}</td>
                                        <td>{{ $mail->mail_to }}</td>
                                        <td>{{ $mail->mail_subject }}</td>
                                        <td>{{ $mail->incoming_date }}</td>
                                        <td>{{ $mail->mail_category }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('outgoing-mail.show', $mail->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="icon-eye"></i></a>
                                            <a href="{{ route('outgoing-mail.edit', $mail->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="icon-pencil-alt"></i></a>
                                            <a href="javascript:;;" onclick="deleteOutgoingMailModal({{ $mail->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="icon-trash"></i></a>
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

    <div class="modal fade" id="deleteOutgoingMailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteOutgoingMail" class="d-none" action="" method="post">
                    @csrf
                    @method('delete')
                </form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Surat Keluar</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus data ini ?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" type="button" onclick="$('#deleteOutgoingMail').submit()">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('scripts')
<script>
    function deleteOutgoingMailModal(id) {
        $('#deleteOutgoingMail').attr('action', '{{url('outgoing-mail/')}}/'+id)
        $('#deleteOutgoingMailModal').modal('show')
    }
</script>
@endsection
