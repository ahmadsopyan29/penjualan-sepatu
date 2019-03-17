<?php session_start(); ob_start();
include 'config.php';                     // Panggil koneksi ke database

include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/cek_login_public.php'; 		// Panggil fungsi cek login public

include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia

$faktur 	 = 	mysqli_real_escape_string($conn,$_GET['id_order']);
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
$hasil_invoice = 	mysqli_query($conn,"SELECT *
FROM detail_order
LEFT JOIN tb_order ON tb_order.id_order = detail_order.id_order
INNER JOIN tb_barang ON tb_barang.id_barang = detail_order.id_barang
INNER JOIN tb_customer ON tb_customer.id_customer = detail_order.id_customer

WHERE tb_order.id_order = '$faktur'
AND tb_order.id_customer = '$sesen_id_customer'
AND tb_order.status = 1 ");
if(mysqli_num_rows($hasil_invoice) == 0)
{die ("<script>alert('Invoice yang Anda cari tidak ditemukan');location.replace('$base_url')</script>");}
?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Invoice #<?php echo $faktur; ?></title>
    <style type="text/css">
		.tabel2 {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		}
		.tabel2 tr.odd td {
		    background-color: #f9f9f9;
		}
		.tabel2 th, .tabel2 td {
	    padding: 4px 5px;
	    line-height: 20px;
	    text-align: left;
	    vertical-align: top;
	    border: 1px solid #dddddd;
		}
		</style>
  </head>
  <body>
		<table>
		  <tr>
		    <td>
		      <font style="font-size: 15px; text-align: left"><br/><b> Threeman Store</b></font><br/>
		      <font style="font-size: 10px; text-align: left">
		        <br/>Kp. Cukang Galih RT/RW : 04/05 Gg. H. Durahman, Curug - Tangerang<br/>Telp/Fax : +6221 5989 3897 | No HP : 081 252 147 626
		      </font>
					
		    </td>
		  </tr>
		</table>

		<hr/>

		<h3 align="center">NO. INVOICE: #<?php echo $faktur; ?></h3>

		<table class="tabel2" align="right">
		  <thead>
		    <tr>
		      <td style="text-align: center; background: #ddd"><b>No.</b></td>
		      <td style="text-align: center; background: #ddd"><b>NAMA BARANG</b></td>
		      <td style="text-align: center; background: #ddd"><b>HARGA</b></td>
		      <td style="text-align: center; background: #ddd"><b>TANGGAL</b></td>
		      <td style="text-align: center; background: #ddd"><b>UKURAN</b></td>
		      <td style="text-align: center; background: #ddd"><b>JUMLAH</b></td>
		      <td style="text-align: center; background: #ddd"><b>SUBTOTAL</b></td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
        $i   = 1;
        while ($data_invoice = mysqli_fetch_array($hasil_invoice))
        {
        	$harga = number_format($data_invoice['harga'], 0, ',', '.');
        	$subtotal 		= number_format($data_invoice['subtotal'], 0, ',', '.')
        ?>
          <tr>
            <td style='text-align: center; width:20px'><?php echo $i ?></td>
            <td style='text-align: left; width:80px'><?php echo $data_invoice['nama_barang'] ?></td>
            <td style='text-align: center; width:60px'><?php echo $harga.',-' ?></td>
            <td style='text-align: center; width:70px'><?php echo $data_invoice['tanggal'] ?></td>
            <td style='text-align: center; width:155px'><?php echo $data_invoice['ukuran'] ?></td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['jumlah'] ?></td>
            <td style='text-align: right; width:70px'><?php echo $subtotal.',-' ?></td>
          </tr>
        <?php $i++; } ?>
		  </tbody>
		</table>

		<hr/>
          <?php 
          $query1        = "SELECT sum(subtotal) AS grandtotal,status_order FROM detail_order
          JOIN tb_barang ON tb_barang.id_barang = detail_order.id_barang
          JOIN tb_order ON tb_order.id_order = detail_order.id_order
          WHERE detail_order.id_order = '$faktur'
          AND detail_order.id_customer = '$sesen_id_customer'
          AND tb_order.status = 1 ";
          $hasil1        = mysqli_query($conn,$query1);
          $data1         = mysqli_fetch_assoc($hasil1);
          $subtotal     = $data1['grandtotal'];
          $grand_total  = $subtotal;
          
          ?>

		<p>Total : <strong>Rp <?php echo number_format($grand_total, 0, ',', '.').',-'; ?></strong><br/>Status Order :  <strong><?php echo $data1['status_order']; ?></strong></p>
		
		
		<hr/>
		<p align="center"><b>Terima Kasih telah Berbelanja DI Toko Kami Threeman Store<br/> Kepuasan Anda Adalah Kebahagiaan Bagi Kami</b></p>
		<hr/>
	</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
// ob_get_clean = salah 1 fungsi dalam PHP
$content = ob_get_clean();
// Memanggil class HTML2PDF dari direktori html2pdf pada project kita
include 'html2pdf/html2pdf.class.php';
try
{
  // Mengatur invoice dalam format HTML2PDF
  // Keterangan: L = Landscape/ P = Portrait, A4 = ukuran kertas, en = bahasa, false = kode HTML2PDF, UTF-8 = metode pengkodean karakter
  $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 5, 10, 0));
  // Mengatur invoice dalam posisi full page
  $html2pdf->pdf->SetDisplayMode('fullpage');
  // Menuliskan bagian content menjadi format HTML
  $html2pdf->writeHTML($content);
  // Mencetak nama file invoice
  $html2pdf->Output('invoice.pdf');
}
// Kodingan HTML2PDF
catch(HTML2PDF_exception $e)
{
  echo $e;
  exit;
}
?>
