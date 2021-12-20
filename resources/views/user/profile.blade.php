@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3>My Profile</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>

            @if (session('updateProfileMessage'))
                <div class="col-sm-6">
                    <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                        {{ session('updateProfileMessage') }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('status') == "password-updated")
                <div class="col-sm-6">
                    <div class="alert alert-primary dark alert-dismissible fade show" role="alert">
                        Password Updated Successfully
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user-profile-information.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-2 text-center">
                                <div class="profile-title">
                                    <div class="media">
                                        <img class="img-70 rounded-circle" alt="Profile Image" src="../assets/images/user/7.jpg">
                                        <div class="media-body">
                                            <h3 class="mb-1 f-20 txt-primary">{{ $user->name }}</h3>
                                            <p class="f-12">Super Admin</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email-Address</label>
                                <input type="email" name="email" class="form-control" placeholder="your-email@domain.com" value="{{ $user->email }}">
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <form class="card" action="{{ route('user-password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Change Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Current Password <span class="text-danger">*</span></label>
                                    <input class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" type="password" name="current_password">

                                    @error('current_password', 'updatePassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">New Password <span class="text-danger">*</span></label>
                                    <input class="form-control @error('password', 'updatePassword') is-invalid @enderror" type="password" name="password">

                                    @error('password', 'updatePassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                    <input class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" type="password" name="password_confirmation">

                                    @error('password_confirmation', 'updatePassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-8 text-left align-self-center">
                                <small class="txt-info">Last Updated Password : {{ $user->password_latest_update }}</small>
                            </div>
                            <div class="col-md-4 text-end">
                                <button class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
