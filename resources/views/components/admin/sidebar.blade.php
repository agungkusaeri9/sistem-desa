<div>
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $setting->site_name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $alias }}</a>
        </div>
        <ul class="sidebar-menu">
            @can('Dashboard')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
            @endcan

            <li class="menu-header">BANTUAN SOSIAL</li>
            <li>
                <a class="nav-link" href="{{ route('admin.bantuan-sosial.index') }}">
                    <i class="fas fa-hands-helping"></i>
                    <span>Bantuan Sosial</span></a>
            </li>
            <li class="menu-header">MASTER</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    @can('Rw View')
                        <li>
                            <a class="nav-link" href="{{ route('admin.rw.index') }}">
                                <span>RW</span></a>
                        </li>
                    @endcan
                    @can('Rt View')
                        <li>
                            <a class="nav-link" href="{{ route('admin.rt.index') }}">
                                <span>RT</span></a>
                        </li>
                    @endcan
                    @can('Agama View')
                        <li>
                            <a class="nav-link" href="{{ route('admin.agama.index') }}">
                                <span>Agama</span></a>
                        </li>
                    @endcan
                    @can('Pendidikan View')
                        <li>
                            <a class="nav-link" href="{{ route('admin.pendidikan.index') }}">
                                <span>Pendidikan</span></a>
                        </li>
                    @endcan
                    @can('Pekerjaan View')
                        <li>
                            <a class="nav-link" href="{{ route('admin.pekerjaan.index') }}">
                                <span>Pekerjaan</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('Warga View')
                <li>
                    <a class="nav-link" href="{{ route('admin.warga.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Data Warga</span></a>
                </li>
            @endcan
            @can('Kartu Keluarga View')
                <li>
                    <a class="nav-link" href="{{ route('admin.kartu-keluarga.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Kartu Keluarga</span></a>
                </li>
            @endcan
            @can('Kematian View')
                <li>
                    <a class="nav-link" href="{{ route('admin.warga-kematian.index') }}">
                        <i class="fas fa-user-alt-slash"></i>
                        <span>Data Kematian</span></a>
                </li>
            @endcan
            @can('Pindahan View')
                <li>
                    <a class="nav-link" href="{{ route('admin.warga-pindahan.index') }}">
                        <i class="fas fa-house-user"></i>
                        <span>Data Pindahan</span></a>
                </li>
            @endcan
            @can('User View')
                <li>
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Data User</span></a>
                </li>
            @endcan
            @can('Role View')
                <li>
                    <a class="nav-link" href="{{ route('admin.roles.index') }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Role</span></a>
                </li>
            @endcan
            @can('Permission View')
                <li>
                    <a class="nav-link" href="{{ route('admin.permissions.index') }}">
                        <i class="fas fa-universal-access"></i>
                        <span>Hak Akses</span></a>
                </li>
            @endcan
            @can('Setting View')
                <li>
                    <a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog"></i>
                        <span>Pengaturan Web</span></a>
                </li>
            @endcan


        </ul>

    </aside>
</div>
