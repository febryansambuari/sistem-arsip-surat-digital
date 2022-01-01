@extends('auth.layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div class="login-main">
                    <form class="theme-form login-form" action="{{ route('password.email') }}" method="POST">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Permintaan reset password berhasil. Silahkan cek link yang dikirimkan ke email yang telah di input.
                            </div>
                        @endif

                        <h4>Permintaan Lupa Password </h4>
                        <div class="form-group">
                            <label class="col-form-label">Masukkan Email</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" name="email" required="" placeholder="Masukkan email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <button class="btn btn-primary btn-block" type="submit">Kirim Permintaan</button>
                            </div>
                        </div>
                        <a href="{{ route('login') }}" class="text-muted">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
