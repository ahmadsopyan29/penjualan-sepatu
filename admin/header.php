<header class="main-header">
  <a href="home.php" class="logo">
    <span class="logo-mini"><b>TS</b></span>
    <span class="logo-lg"><b>Threeman Store</b></span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php include "../fungsi/time.php"; ?>
          </a>
        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../gambar/admin.png" width="160px" height="160px" class="user-image" alt="User Image"/>
            <span class="hidden-xs">
              <?php
              if ($sesen_level == "admin"){echo "Halo, $sesen_nama_lengkap ";}
              if ($sesen_level == "pemilik_toko"){echo "Halo, $sesen_nama_lengkap ";}
              ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="../gambar/admin.png" class="img-circle" alt="User Image" />
              <p>
              <?php if ($sesen_level == "admin" OR "pemilik_toko"){echo "$sesen_nama_lengkap";} ?></p>
              (<?php if($sesen_level == 'admin'){echo "Admin";} if($sesen_level == 'pemilik_toko'){echo "Pemilik Toko";}?>)
            </li>
            <li class="user-body">
              <div class="col-xs-6 text-center">
                <a href='ubah_pass.php?id_user=<?php echo $sesen_id_user ?>' class='btn btn-default btn-flat'>Ubah Password</a>
              </div>
              <div class="col-xs-6 text-center">
                <a href='logout.php' class='btn btn-default btn-flat'>Logout</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<!-- Kolom Sebelah Kiri -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image"><img src="../gambar/admin.png" class="img-circle" alt="User Image"/></div>
      <div class="pull-left info">
        <p><?php if ($sesen_level == "admin" OR "pemilik_toko"){echo "$sesen_nama_lengkap";} ?></p>
        <p>(<?php if($sesen_level == 'admin'){echo "Admin";}if($sesen_level == 'superadmin'){echo "Super Admin";}?>)</p>
      </div>
    </div>

    <?php include "leftbar.php" ?>

  </section>
</aside>
