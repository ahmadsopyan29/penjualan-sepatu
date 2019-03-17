<?php session_start(); ob_start();
include '../config.php';                     // Panggil koneksi ke database
$dari = $_GET['dari'];
				$sampai = $_GET['sampai'];

?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Invoice #<?php echo $id_order; ?></title>
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
		      </font><br><br>
					<font style="font-size: 10px; text-align: left">
		        Laporan Penjualan <br/>
		      </font>
					<font style="font-size: 10px; text-align: left">
		        Periode <?php echo $dari; ?> Sampai <?php echo $sampai; ?>
		      </font>
					
		    </td>
		  </tr>
		</table>

		<hr/>


		<table class="tabel2" align="right">
		  <thead>
		    <tr>
		      <td style="text-align: center; background: #ddd"><b>No.</b></td>
		      <td style="text-align: center; background: #ddd"><b>NO INVOICE</b></td>
		      <td style="text-align: center; background: #ddd"><b>TANGGAL</b></td>
		      <td style="text-align: center; background: #ddd"><b>BARANG</b></td>
		      <td style="text-align: center; background: #ddd"><b>CUSTOMER</b></td>
		      <td style="text-align: center; background: #ddd"><b>STATUS</b></td>
					<td style="text-align: center; background: #ddd"><b>UKURAN</b></td>
					<td style="text-align: center; background: #ddd"><b>JUMLAH</b></td>
		      <td style="text-align: center; background: #ddd"><b>SUBTOTAL</b></td>
		    </tr>
		  </thead>
		  <tbody>
			<?php 
			if (isset($_GET['dari']) && isset($_GET['sampai'])) {
				$dari = $_GET['dari'];
				$sampai = $_GET['sampai'];
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
$hasil_invoice = 	mysqli_query($conn,"SELECT * FROM tb_order a 
JOIN detail_order b ON a.id_order = b.id_order
JOIN tb_barang c ON b.id_barang = c.id_barang
JOIN tb_customer d ON b.id_customer = d.id_customer

WHERE a.tanggal BETWEEN '$dari' AND '$sampai'
AND a.status_order = 'selesai'
									 ");
if(mysqli_num_rows($hasil_invoice) == 0)
{die ("<script>alert('Invoice yang Anda cari tidak ditemukan');location.replace('$base_url')</script>");}
else{
        $i   = 1;
        while ($data_invoice = mysqli_fetch_array($hasil_invoice))
        {
        	$subtotal 		= number_format($data_invoice['subtotal'], 0, ',', '.');
        ?>
          <tr>
            <td style='text-align: center; width:20px'><?php echo $i ?></td>
            <td style='text-align: center; width:60px'><?php echo $data_invoice['id_order'] ?></td>
            <td style='text-align: center; width:60px'><?php echo $data_invoice['tanggal'] ?></td>
						<td style='text-align: center; width:50px'><?php echo $data_invoice['nama_barang'] ?></td>
						<td style='text-align: center; width:60px'><?php echo $data_invoice['username'] ?></td>
						<td style='text-align: center; width:50px'><?php echo $data_invoice['status_order'] ?></td>
						<td style='text-align: center; width:50px'><?php echo $data_invoice['ukuran'] ?></td>
						<td style='text-align: center; width:40px'><?php echo $data_invoice['jumlah'] ?></td>
						<td style='text-align: center; width:80px'><?php echo $subtotal ?></td>
          </tr>
        <?php $i++; } 
				$query        = mysqli_query($conn,"SELECT sum(subtotal) AS grandtotal FROM tb_order a 
                          JOIN detail_order b ON a.id_order = b.id_order
                          
                          WHERE a.tanggal BETWEEN '$dari' AND '$sampai'
                          AND a.status_order = 'selesai' ");
          
          $data1 = mysqli_fetch_array($query);
          $subtotal     = $data1['grandtotal'];
					$grand_total  = number_format($subtotal, 0, ',', '.').',-';
					
				?>
				<tr>
            <td style='text-align: center; width:20px' colspan='8'> TOTAL</td>
						<td style='text-align: center; width:80px'><?php echo $grand_total ?></td>
          </tr>

		  </tbody>
		</table>
				<?php }} ?>
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
