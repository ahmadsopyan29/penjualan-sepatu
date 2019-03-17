
<?php include 'navbar.php'?>
<?php 
     

     // Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
     $faktur= mysqli_real_escape_string($conn,$_GET['id_order']);
     
     
?>
<section id="cart_items">
		<div class="container">
<h4>NO. INVOICE: #<?php echo $faktur ?></h4>

<p align="right">
  <a href='invoice_detail.php?id_order=<?php echo $faktur; ?>'>
    <button type='button' class='btn btn-primary'>
       Download Invoice
    </button>
  </a>
</p>

<div id="no-more-tables">
  <?php
  $faktur= mysqli_real_escape_string($conn,$_GET['id_order']);                    // Panggil data faktur
  // Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
  $cek_invoice =  mysqli_query($conn,"SELECT *
                  FROM detail_order
                  LEFT JOIN tb_order ON tb_order.id_order = detail_order.id_order
                  INNER JOIN tb_barang ON tb_barang.id_barang = detail_order.id_barang
                  INNER JOIN tb_customer ON tb_customer.id_customer = detail_order.id_customer
                  
                  WHERE tb_order.id_order = '$faktur'
                  AND tb_order.id_customer = '$sesen_id_customer'
                  AND tb_order.status = 1 ");
  if(mysqli_num_rows($cek_invoice) == 0)
  {echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
  else
  {
    echo "
    <table class='col-md-12 table-bordered table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <td align='center'>No.</td>
          <td align='center'>Nama Barang</td>
          <td align='center'>Harga</td>
          <td align='center'>Tanggal</td>
          <td align='center'>Ukuran</td>
          <td align='center'>Jumlah</td>
          <td align='center'>Sub Total</td>
        </tr>
      </thead>";

    $no = 1;
    while($data_keranjang = mysqli_fetch_array($cek_invoice))
    {
      $harga = number_format($data_keranjang['harga'], 0, ',', '.');
      $subtotal     = number_format($data_keranjang['subtotal'], 0, ',', '.');
      
      echo "
      <tbody>
        <tr>
          <td data-title='No.' align='center'>".$no."</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[nama_barang]</td>
          <td data-title='Harga Diskon' align='center'>$harga,-</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[tanggal]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[ukuran]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[jumlah]</td>
          <td data-title='Sub Total' align='center'>$subtotal,-</td>
        </tr>";
      $no++;
    }
  }
  ?>
</table>
</div>

<hr/>
          <?php 
          $query1        = "SELECT *,sum(subtotal) AS grandtotal FROM detail_order
          JOIN tb_barang ON tb_barang.id_barang = detail_order.id_barang
          JOIN tb_order ON tb_order.id_order = detail_order.id_order
          WHERE detail_order.id_order = '$faktur'
          AND detail_order.id_customer = '$sesen_id_customer'
          AND tb_order.status = 1 ";
          $hasil1        = mysqli_query($conn,$query1);
          $data1         = mysqli_fetch_assoc($hasil1);
          $grand_total     = number_format($data1['grandtotal'], 0, ',', '.');
          $status_order = $data1['status_order'];
          
          ?>

<hr/>
<br>
<br>
<br>
<p>Total : <strong>Rp <?php echo $grand_total  ?></strong><br/>
Status Order :  <strong><?php echo $status_order ?></strong></p>
<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman berikut: <a href="<?php echo $base_url.'konfirmasi.php' ?>">klik disini</a></p>
<hr/>
<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
<p> BCA : 564 983766</p>
<p> BRI : 678 553655</p>
<hr/>
<p>Setelah proses verifikasi pembayaran Anda selesai, maka kami memproses transaksi anda
<br>Batas Pembayaran Anda Adalah 1 Hari Setelah Anda Checkout</p>


</div>
</section>
<?php include 'footer.php'; ?>
