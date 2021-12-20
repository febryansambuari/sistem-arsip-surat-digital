<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" src="{{ asset('assets/images/sigit-logo.png') }}" width="50" height="50" alt="Brand Logo"> Sigit Tomang
                </a>
            </div>
            <div class="dark-logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" src="{{ asset('assets/images/sigit-logo.png') }}" width="50" height="50" alt="Brand Logo Dark"> Sigit Tomang
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i>
            </div>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li class="onhover-dropdown p-0">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button class="btn btn-primary-light" type="submit">
                            <i data-feather="log-out"></i>Log out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
