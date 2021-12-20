@extends('auth.layouts.app')

@section('content')
<div class="row m-0">
    <div class="col-12 p-0">
        <div class="login-card">
            <form class="theme-form login-form" action="{{ route('register') }}" method="POST">
                @csrf

                <h4>Create your account</h4>
                <h6>Enter your personal details to create account</h6>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $message)
                            <span>{{ $message }}</span>
                        @endforeach
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title title></button>
                    </div>
                @endif

                <div class="form-group">
                    <label>Your Name</label>
                    <div class="small-group">
                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                            <input class="form-control" type="text" name="first_name" required="" placeholder="Fist Name">
                        </div>
                        <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                            <input class="form-control" type="text" name="last_name" required="" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                        <input class="form-control" type="email" name="email" required="" placeholder="Test@gmail.com">
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                        <input class="form-control" type="password" name="password" required="" placeholder="*********">
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                        <input class="form-control" type="password" name="password_confirmation" required="" placeholder="*********">
                    </div>
                </div>
                <div class="form-group justify-content-center">
                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                </div>
                <p>Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
