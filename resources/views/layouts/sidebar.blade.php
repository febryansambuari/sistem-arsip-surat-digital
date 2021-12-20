<header class="main-nav">
    <div class="sidebar-user text-center">
        <a class="setting-primary" href="{{ route('user.profile') }}"><i data-feather="settings"></i></a>
        <img class="img-90 rounded-circle" src="{{ asset('assets/images/dashboard/1.png') }}" alt="Profile Image">
        <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->name }}</h6>
        <p class="mb-0 font-roboto">Super Admin</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title link-nav @if(Route::currentRouteName() === 'home') active @endif" href="{{ route('home') }}">
                            <i data-feather="home"></i><span>Beranda</span>
                        </a>
                    </li>
                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <i data-feather="hard-drive"></i><span>Master Data</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('user.index') }}">User</a></li>
                        </ul>
                    </li>
                    <li class="dropdown mb-1">
                        <a class="nav-link menu-title" href="javascript:void(0)">
                            <i data-feather="folder"></i><span>Data Surat</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('incoming-mail.index') }}">Surat Masuk</a></li>
                            <li><a href="{{ route('outgoing-mail.index') }}">Surat Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
