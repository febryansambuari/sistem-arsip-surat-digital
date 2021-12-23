@extends('auth.layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div class="login-main">
                    <form class="theme-form login-form" action="{{ route('password.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <h4 class="mb-3">Reset Password</h4>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" name="email" value="{{ $request->email }}" required="" placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required="" placeholder="Masukkan Password Baru">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Masukkan Konfirmasi Password Baru">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
