<!DOCTYPE html>
<html lang="en">

<head>

  @include('template.admin.head')

  @yield('headmeta')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @yield('sidebar')

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div class="d-flex flex-column" id="content-wrapper">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('template.admin.topbar')

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><b>Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> ITTS. Powered by <a href="https://digiyok.com" target="_blank">DIGIYOK</a>.
              </b></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mau keluar?</h5>
          <button class="close" data-dismiss="modal" type="button" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Keluar" jika kamu mau mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Kembali</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
          <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
        </div>
      </div>
    </div>
  </div>

  @include('template.admin.plugin')

  @yield('footjs')
</body>

</html>
