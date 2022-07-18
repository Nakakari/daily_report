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
                <ul class="navbar-nav">
                    @if (Auth::user()->peran == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="examples/dashboard.html">
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
                            <a class="nav-link {{ request()->is('kunjungan_report') ? 'active' : '' }}"
                                href="/kunjungan_report">
                                <i class="ni ni-pin-3 text-primary"></i>
                                <span class="nav-link-text">Kunjungan Report</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="examples/profile.html">
                                <i class="ni ni-planet text-orange"></i>
                                <span class="nav-link-text">Mesin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="examples/tables.html">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Report</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="examples/tables.html">
                                <i class="ni ni-bullet-list-67 text-default"></i>
                                <span class="nav-link-text">Report</span>
                            </a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</nav>
