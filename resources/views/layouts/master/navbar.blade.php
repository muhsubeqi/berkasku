<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav" id="navbar_burger">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar date-->
        <li class="nav-item">
            <a class="nav-link active fw-bold" href="#" role="button">
                {{ date('d M Y') }}
            </a>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if (Auth::user()->picture != null)
                    <img src="{{ 'https://siakad.dalwa.ac.id/picture_users/' . Auth::user()->picture }}"
                        class="user-image img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ 'https://picsum.photos/' . 100 }}" class="user-image img-circle elevation-2"
                        alt="User Image">
                @endif
                <span class="d-none d-md-inline">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-dark">
                    @if (Auth::user()->picture != null)
                        <img src="{{ 'https://siakad.dalwa.ac.id/picture_users/' . Auth::user()->picture }}"
                            class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="{{ 'https://picsum.photos/' . 100 }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                    <p>
                        {{ Auth::user()->username }}
                        <small>{{ Auth::user()->email }}</small>
                    </p>
                </li>

                <li class="user-footer">
                    <a href="{{ route('admin.profil') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                        onclick="logout(event)">
                        Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline" action="{{ route('admin.searching') }}">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" name="search" type="search"
                            placeholder="Search" aria-label="Search" id="nav-search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>
<!-- /.navbar -->
