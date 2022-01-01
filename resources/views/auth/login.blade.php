@extends('auth.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="login-card">
            <form method="POST" action="{{ route('login') }}" class="theme-form login-form needs-validation" novalidate="">
                @csrf

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="text-center">
                    <img src="{{ asset('assets/images/sigit-logo.png') }}" alt="Logo" width="200" height="140">

                    {{-- <h4 class="mt-3">Login</h4> --}}
                    <h4 class="mt-3 mb-3">Sistem Arsip Surat Digital</h4>
                </div>

                <div class="form-group">
                    <label>Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="icon-email"></i></span>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="" placeholder="Test@gmail.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Kata Sandi</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required="" placeholder="*********">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <button class="btn btn-primary" type="submit">Masuk</button>
                    </div>
                </div>
                <p><a class="link" href="{{ route('password.request') }}">Lupa Password ?</a></p>
                <p>Tidak punya akun ?<a class="ms-2" href="{{ route('register') }}">Daftar Disini</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
