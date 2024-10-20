
<body id="page-top">
 <!-- Page Wrapper -->
 <div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-home"></i>
        <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="identifikasi.php">
          <i class="fas fa-fw fa-stethoscope"></i>
          <span>Identifikasi</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="penyakit.php">
          <i class="fas fa-fw fa-plus-circle"></i>
          <span>Penyakit</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="history.php">
          <i class="fas fa-fw fa-history"></i>
          <span>History</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="tentang.php">
          <i class="fas fa-info-circle"></i>
          <span>Tentang</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->





    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">



        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
      
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php
              $username=$_SESSION['username'];
              $det=mysqli_query($conn,"select * from tb_akun where username='$username'");
              while($d=mysqli_fetch_array($det)){
                ?>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $d['nama_lengkap'] ?></span>
                <?php 
              }
              ?>
              <span class="fa fa-user"><span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
              aria-labelledby="userDropdown">
              <a class="dropdown-item" href="profil.php">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Akun
              </a>


              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>

      </nav>
      <!-- End of Topbar -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Anda akan keluar dari hak akses anda !!!</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>