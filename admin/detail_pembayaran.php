<?php session_start(); ob_start();
include '../config.php';                     // Panggil koneksi ke database

include '../fungsi/base_url.php';            // Panggil fungsi base_url
include '../fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include '../fungsi/cek_login_public.php'; 		// Panggil fungsi cek login public

include '../fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia

$id_pembayaran 	 = 	mysqli_real_escape_string($conn,$_GET['id_pembayaran']);
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
$hasil_invoice = 	mysqli_query($conn,"SELECT *
FROM tb_pembayaran


WHERE id_pembayaran = '$id_pembayaran'

");
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
		      <font style="font-size: 15px; text-align: left">
		        <br/>Bukti Pembayaran
		      </font>
		    </td>
		  </tr>
		</table>

          <?php 
          $query1        = "SELECT * FROM tb_pembayaran a JOIN tb_customer b ON a.id_customer = b.id_customer
          
          WHERE id_pembayaran = '$id_pembayaran'
          
          ";
          $hasil1        = mysqli_query($conn,$query1);
          $data1         = mysqli_fetch_assoc($hasil1);
          
          
          ?>

		
		<p><strong><img src='../gambar/<?php echo $data1['foto']; ?>' width='500'/></strong>
		<br> <strong>Nomor Invoice : <?php echo $data1['id_order']; ?></strong>
		<br> <strong>Nomor Rekening Pengirim  : <?php echo $data1['no_rek']; ?></strong>
		<br> <strong>Nama Rekening : <?php echo $data1['nama_rek']; ?></strong>
		<br> <strong>Bank : <?php echo $data1['nama_bank']; ?></strong>
		<br> <strong>Jumlah Transfer : <?php echo $data1['jumlah_bayar']; ?></strong>
		<br> <strong>Nama Customer : <?php echo $data1['nama_lengkap']; ?></strong></p>
		<hr/>
		
	</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
// ob_get_clean = salah 1 fungsi dalam PHP
$content = ob_get_clean();
// Memanggil class HTML2PDF dari direktori html2pdf pada project kita
include '../html2pdf/html2pdf.class.php';
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
