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
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i>
                        <span>Dashboard</span></a>
                </li>
            @endcan

            <li class="menu-header">MASTER</li>
            @can('Rw View')
                <li>
                    <a class="nav-link" href="{{ route('admin.rw.index') }}"><i class="fas fa-folder"></i>
                        <span>RW</span></a>
                </li>
            @endcan
            @can('Rt View')
                <li>
                    <a class="nav-link" href="{{ route('admin.rt.index') }}"><i class="fas fa-folder"></i>
                        <span>RT</span></a>
                </li>
            @endcan
            @can('Agama View')
                <li>
                    <a class="nav-link" href="{{ route('admin.agama.index') }}"><i class="fas fa-folder"></i>
                        <span>Agama</span></a>
                </li>
            @endcan
            @can('Pendidikan View')
                <li>
                    <a class="nav-link" href="{{ route('admin.pendidikan.index') }}"><i class="fas fa-folder"></i>
                        <span>Pendidikan</span></a>
                </li>
            @endcan
            @can('Pekerjaan View')
            <li>
                <a class="nav-link" href="{{ route('admin.pekerjaan.index') }}"><i class="fas fa-folder"></i>
                    <span>Pekerjaan</span></a>
            </li>
        @endcan
            @can('User View')
                <li>
                    <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>
                        <span>User</span></a>
                </li>
            @endcan
            @can('Role View')
                <li>
                    <a class="nav-link" href="{{ route('admin.roles.index') }}"><i class="fas fa-folder"></i>
                        <span>Role</span></a>
                </li>
            @endcan
            @can('Permission View')
                <li>
                    <a class="nav-link" href="{{ route('admin.permissions.index') }}"><i class="fas fa-folder"></i>
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
