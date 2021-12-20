@extends('layouts.app')

@section('content')
<div class="container-fluid general-widget calendar-basic">
    <div class="alert alert-primary" role="alert">
        <h3 class="text-center">Sistem Arsip <br> Surat Masuk & Surat Keluar Digital <br> Kelurahan Tomang</h3>
    </div>

    <div class="row">
        <div class="col-sm-4 col-xl-4 col-lg-4">
            <div class="card o-hidden border-0">
                <div class="bg-info b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="download"></i></div>
                        <div class="media-body">
                            <span class="m-0">Total Surat Masuk</span>
                            <h4 class="mb-0 counter">{{ $countIncomingMail }}</h4><i class="icon-bg" data-feather="download"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4 col-lg-4">
            <div class="card o-hidden border-0">
                <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="upload"></i></div>
                        <div class="media-body">
                            <span class="m-0">Total Surat Keluar</span>
                            <h4 class="mb-0 counter">{{ $countOutgoingMail }}</h4><i class="icon-bg" data-feather="upload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xl-4 col-lg-4">
            <div class="card o-hidden border-0">
                <div class="bg-warning b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="user"></i></div>
                        <div class="media-body">
                            <span class="m-0">Total User</span>
                            <h4 class="mb-0 counter">{{ $countUser }}</h4><i class="icon-bg" data-feather="user"></i>
                        </div>
                    </div>
                    <a href="{{ route('user.index') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
