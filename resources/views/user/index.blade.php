@extends('layouts.app')

@section('content')

{{-- Breadcrumb Start --}}
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Daftar User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus-square"></i> Tambah User
                </a>
            </div>
        </div>

        @if (session('userPageMessage'))
        <div class="row mt-3 justify-content-end">
            <div class="col-sm-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i data-feather="check"></i> {{ session('userPageMessage') }}
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
                                    <th>Nama Pengguna</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Tgl Daftar</th>
                                    <th>Login Terakhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">{{ ucwords($user->level) }}</td>
                                        <td class="text-center">
                                            @if ($user->status)
                                                <span class="badge badge-primary">Aktif</span>
                                            @else
                                                <span class="badge badge-warning">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->last_login_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('user.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="icon-pencil-alt"></i></a>
                                            <a href="javascript:;;" onclick="deleteUserModal({{ $user->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
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

    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteUser" class="d-none" action="" method="post">
                    @csrf
                    @method('delete')
                </form>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="button" onclick="$('#deleteUser').submit()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('scripts')
<script>
    function deleteUserModal(id) {
        $('#deleteUser').attr('action', '{{url('user/delete/')}}/'+id)
        $('#deleteUserModal').modal('show')
    }
</script>
@endsection

