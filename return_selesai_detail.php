
<?php include 'navbar.php';

$faktur= mysqli_real_escape_string($conn,$_GET['id_return']);
?>

<section id="cart_items">
		<div class="container">
<h4>NO. INVOICE RETURN: #<?php echo $faktur ?></h4>

<p align="right">
  <a href='invoice_return_detail.php?id_return=<?php echo $faktur; ?>'>
    <button type='button' class='btn btn-primary'>
      Download Detail
    </button>
  </a>
</p>

<div id="no-more-tables">
  <?php
  $faktur= mysqli_real_escape_string($conn,$_GET['id_return']);                     // Panggil data faktur
  // Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
  $cek_invoice =  mysqli_query($conn,"SELECT *
                  FROM detail_return
                  LEFT JOIN tb_return ON tb_return.id_return = detail_return.id_return
                  INNER JOIN tb_barang ON tb_barang.id_barang = detail_return.id_barang
                  INNER JOIN tb_customer ON tb_customer.id_customer = detail_return.id_customer
                  
                  WHERE tb_return.id_return = '$faktur'
                  AND tb_return.id_customer = '$sesen_id_customer'
                  AND tb_return.status = 1 ");
  if(mysqli_num_rows($cek_invoice) == 0)
  {echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
  else
  {
    echo "
    <table class='col-md-12 table-bordered table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <td align='center'>No.</td>
          <td align='center'>ID Return</td>
          <td align='center'>Nama Barang</td>
          
          <td align='center'>Tanggal</td>
          
          <td align='center'>Jumlah</td>
          
        </tr>
      </thead>";

    $no = 1;
    while($data_keranjang = mysqli_fetch_array($cek_invoice))
    {
      

      echo "
      <tbody>
        <tr>
          <td data-title='No.' align='center'>".$no."</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[id_return]</td>
          <td data-title='Harga Diskon' align='center'>$data_keranjang[nama_barang]</td>
          
          <td data-title='Harga Diskon' align='center'>$data_keranjang[tanggal]</td>
          
          <td data-title='Harga Diskon' align='center'>$data_keranjang[jumlah]</td>
          
        </tr>";
      $no++;
    }
  }
  ?>
</table>
</div>

<hr/>
       

<br><br><br>
<p>Catatan : </p>
<p> - Biaya Pengiriman Barang Return Bukan Tanggung Jawab Kami<br/> - Pengembalian Biaya Pembelian Ketika Barang Di Return Adalah 100% <br/>
- Proses Pencairan Biaya Pembelian Adalah 2 Hari Kerja Saat Barang Kami Terima</p>
<hr/>

<p align="center"><b>Terima kasih telah Berbelanja Di Toko Kami Threeman Store<br/> Kepuasan Anda Adalah Kebahagiaan Bagi Kami</b></p>
</div>
</section>
<?php include 'footer.php'; ?>
