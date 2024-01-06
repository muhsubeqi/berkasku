<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link ">
        {{-- <img src="" alt="AdminLTE Logo" class="brand-image bg-success img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light"><i class="fa fa-file"></i> BERKASKU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->picture != null)
                    <img src="https://siakad.dalwa.ac.id/picture_users/{{ Auth::user()->picture }}"
                        class="img-circle elevation-2" style="width: 40px;height:40px;object-fit:cover" alt="User Image">
                @else
                    <img src="{{ 'https://picsum.photos/' . 100 }}" class="img-circle elevation-2"
                        style="width: 40px;height:40px;object-fit:cover" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        {{-- <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-collapse-hide-child nav-child-indent flex-column"
                data-widget="treeview" role="menu" data-accordion="false" id="list-sidebar">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"> <i
                            class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                {{-- Master --}}
                <li
                    class="nav-item  {{ request()->routeIs('admin.master.kategori*') ? 'menu-open' : '' }}
                {{ request()->routeIs('admin.master.sub-kategori*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('admin.master.kategori*') ? 'active' : '' }}
                    {{ request()->routeIs('admin.master.sub-kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.kategori') }}"
                                class="nav-link {{ request()->routeIs('admin.master.kategori*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.master.sub-kategori') }}"
                                class="nav-link {{ request()->routeIs('admin.master.sub-kategori*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Kategori dan Sub Kategroi --}}
                @php
                    $kategori = App\Models\Kategori::all();
                    $currentUrl = Request::url();
                    $dokUrl = URL::to('/administrator/dokumen/'); //fix url to dokumen
                @endphp
                @foreach ($kategori as $val)
                    <li class="nav-item {{ str_contains($currentUrl, "$dokUrl/$val->id/") ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas  {{ $val->ikon }}"></i>
                            <p>
                                {{ $val->nama_kategori }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @foreach ($val->subKategori as $sub)
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.dokumen.index', ['kategori' => $val->id, 'subKategori' => $sub->id]) }}"
                                        class="nav-link {{ str_contains($currentUrl, "$dokUrl/$val->id/$sub->id") ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $sub->nama_sub_kategori }}</p>
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                    </li>
                @endforeach

                {{-- Profil --}}
                <li class="nav-item">
                    <a href="{{ route('admin.profil') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link " onclick="logout(event)">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
