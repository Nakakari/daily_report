<!DOCTYPE html>
<html>

{{-- Head --}}
@include('layouts.v_head')

<body>
    <!-- Sidenav -->
    @include('layouts.v_sidenav')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('layouts.v_topnav')
        <!-- Header -->
        <!-- Page content -->
        @include('layouts.v_content')
    </div>
    <!-- Footer -->
    @include('layouts.v_footer')
    </div>
    </div>
    <!-- Argon Scripts -->
    {{-- Script --}}
    @include('layouts.v_end')
</body>

</html>
