@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h3>Penambahan Data User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.index') }}">User</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="col-form-label" id="input-full-name">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="full_name" id="input-full-name" placeholder="Nama Lengkap Pengguna" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="col-form-label" id="input-name">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="input-name" placeholder="Nama Pengguna" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="col-form-label" id="input-email">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="input-email" class="form-control" placeholder="contohemail@gmail.com" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="col-form-label" id="input-level">Level</label>
                                    <select class="form-select" name="level" id="input-level">
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="col-form-label" id="input-status">Status</label>
                                    <select class="form-select" name="status" id="input-status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-8 text-left">
                                <p>
                                    <small class="txt-danger">* Kata sandi akan dibuatkan secara otomatis oleh sistem. Setelahnya dapat diubah pada menu <strong>Profile</strong>.</small>
                                    <small class="text-danger">* Nama dan Email digunakan untuk masuk / login ke dalam aplikasi.</small>
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <button class="btn btn-primary me-2" type="submit">Simpan</button>
                                <a class="btn btn-light" href="{{ route('user.index') }}">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
