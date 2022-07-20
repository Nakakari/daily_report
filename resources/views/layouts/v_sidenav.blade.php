<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('template') }}/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->

                @if (Auth::user()->peran == 1)
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}" href="/admin/home">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('master_data') ? 'active' : '' }}"
                                href="/master_data">
                                <i class="ni ni-single-02 text-yellow"></i>
                                <span class="nav-link-text">Master Data User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('master_customer') ? 'active' : '' }}"
                                href="/master_customer">
                                <i class="ni ni-badge text-success"></i>
                                <span class="nav-link-text">Master Data Customer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('master_mesin') ? 'active' : '' }}"
                                href="/master_mesin">
                                <i class="ni ni-planet text-orange"></i>
                                <span class="nav-link-text">Master Data Mesin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('kunjungan_report') ? 'active' : '' }}"
                                href="/kunjungan_report">
                                <i class="ni ni-pin-3 text-primary"></i>
                                <span class="nav-link-text">Kunjungan Report</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="examples/tables.html">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Report</span>
                            </a>
                        </li>
                    </ul>
                @elseif (Auth::user()->peran == 2)
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('teknisi/home') ? 'active' : '' }}"
                                href="/teknisi/home">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('report') ? 'active' : '' }}" href="/report">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Report</span>
                            </a>
                        </li>
                    </ul>
                @elseif (Auth::user()->peran == 3)
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('assspv') ? 'active' : '' }}" href="/assspv">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('daftar_report') ? 'active' : '' }}"
                                href="/daftar_report">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Daftar Report</span>
                            </a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pimpinan/home') ? 'active' : '' }}"
                                href="admin/home">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                @endif


            </div>
        </div>
    </div>
</nav>
