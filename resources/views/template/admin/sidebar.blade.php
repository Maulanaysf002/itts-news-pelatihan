@section('sidebar')
  <ul class="navbar-nav bg-gradient-brand-success-dark bg-gradient-success sidebar sidebar-dark accordion"
    id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand bg-white d-flex align-items-center justify-content-center"
      href="{{ url('/' . explode('/', Request::path())[0]) }}">
      <div class="sidebar-brand-icon">
        <img src="{{ asset('img/logo/ITTS-logo.png') }}">
      </div>
      <div class="sidebar-brand-text text-success mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @yield('sidebar-menu')

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
@endsection
