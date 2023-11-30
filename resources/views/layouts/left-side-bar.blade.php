<div class="left-side-bar">
    <div class="brand-logo">
        <a href="/">
            <h2 class="text-white light-logo">Absensi</h2>
            <h2 class="text-black dark-logo">Absensi</h2>
            {{-- <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
            <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"> --}}
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                @if(Auth::user()->role == 3)
                <li>
                    <div class="sidebar-small-cap">Home</div>
                </li>
                <li>
                    <a href="/asdos/index" class="dropdown-toggle no-arrow {{ Request::is('/') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dvashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('asdos.presensi.showmapel')}}" class="dropdown-toggle no-arrow {{ Request::is('/asdos/presensi') ? 'active' : '' }}">
                        <span class="micon dw dw-pen"></span><span class="mtext">Presensi</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == 2)
                <li>
                    <div class="sidebar-small-cap">Home</div>
                </li>
                <li>
                    <a href="/dosen/index" class="dropdown-toggle no-arrow {{ Request::is('/') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dvashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dosen.presensi.showmapel')}}" class="dropdown-toggle no-arrow {{ Request::is('/dosen/presensi') ? 'active' : '' }}">
                        <span class="micon dw dw-pen"></span><span class="mtext">Presensi</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == 1)
                <li>
                    <div class="sidebar-small-cap">Home</div>
                </li>
                <li>
                    <a href="/mahasiswa/index" class="dropdown-toggle no-arrow {{ Request::is('/') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mahasiswa.presensi.showmapel')}}" class="dropdown-toggle no-arrow {{ Request::is('/mahasiswa/presensi') ? 'active' : '' }}">
                        <span class="micon dw dw-pen"></span><span class="mtext">Presensi</span>
                    </a>
                </li>
                @elseif(Auth::user()->role == 0)
                <li>
                    <div class="sidebar-small-cap">Home</div>
                </li>
                <li>
                    <a href="/admin/index" class="dropdown-toggle no-arrow {{ Request::is('/') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.presensi.showmapel')}}" class="dropdown-toggle no-arrow {{ Request::is('admin/presensi') ? 'active' : '' }}">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Presensi</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-file-211"></span><span class="mtext">Data-Data</span>
                    </a>
                    <ul class="submenu">
                        <li><a class="{{ Request::is('dosen*') ? 'active' : '' }}" href="{{route('admin.asdos.showall')}}">Asisten Dosen</a></li>
                        <li><a class="{{ Request::is('dosen*') ? 'active' : '' }}" href="{{route('admin.dosen.showall')}}">Dosen</a></li>
                        <li><a class="{{ Request::is('kelas*') ? 'active' : '' }}" href="{{route('admin.kelas.showall')}}">Kelas</a></li>
                        <li><a class="{{ Request::is('mahasiswa*') ? 'active' : '' }}" href="{{route('admin.mahasiswa.showall')}}">Mahasiswa</a></li>
                        <li><a class="{{ Request::is('mapel*') ? 'active' : '' }}" href="{{route('admin.mapel.showall')}}">Mapel</a></li>
                        <li><a class="{{ Request::is('keteranganPresensi*') ? 'active' : '' }}" href="{{route('admin.absensi.showall')}}">Keterangan Absensi</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>