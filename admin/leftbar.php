<ul class="sidebar-menu">
  <li class="header">MENU UTAMA</li>
  <li class="treeview">
    <a href='home.php'>
      <i class='fa fa-dashboard'></i> <span>Dashboard</span>
    </a>
  </li>
  
    <?php
    if ($sesen_level == "admin")
    {
      echo "
      <li class='treeview'>
        <a href='#'><i class='fa fa-list'></i><span> Data Master </span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='data_barang.php'><i class='fa fa-circle-o'></i> Data Barang </a></li>
          <li><a href='data_user.php'><i class='fa fa-circle-o'></i> Data User </a></li>
          <li><a href='data_customer.php'><i class='fa fa-circle-o'></i> Data Customer </a></li>
          <li><a href='data_kategori.php'><i class='fa fa-circle-o'></i> Data Kategori </a></li>
          <li><a href='data_stok.php'><i class='fa fa-circle-o'></i> Data Stok </a></li>
        </ul>
      </li>
      
      <li class='treeview'>
        <a href='pesan_barang.php'>
          <i class='fa fa-shopping-cart'></i> <span> Order</span>
        </a>
      </li>
      <li class='treeview'>
        <a href='pesan_return.php'>
          <i class='fa fa-mail-reply'></i> <span> Return</span>
        </a>
      </li>
      <li class='treeview'>
        <a href='data_konfirmasi.php'>
          <i class='fa fa-paper-plane'></i> <span> Konfirmasi</span>
        </a>
      </li>
      
      ";
    }
    ?>
  
      <li class='treeview'>
        <a href='#'><i class='fa fa-pie-chart'></i><span> Laporan </span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='laporan_penjualan.php'><i class='fa fa-circle-o'></i> Laporan Penjualan</a></li>
          <li><a href='laporan_return.php'><i class='fa fa-circle-o'></i> Laporan Return </a></li>
          <li><a href='laporan_stok.php'><i class='fa fa-circle-o'></i> Laporan Stok</a></li>
        </ul>
      </li>
  <li>
    <a href='logout.php'>
      <i class="fa fa-sign-out"></i> <span>Logout</span>
    </a>
  </li>
</ul>