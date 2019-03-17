<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database

$id_kategori 	 = 	mysqli_real_escape_string($conn,$_GET['id_kategori']);
$sql = "SELECT * FROM tb_kategori WHERE id_kategori = '$id_kategori'";
$result = mysqli_query($conn, $sql);
$data1 = mysqli_fetch_array($result);

$nama_kategori = $data1['nama_kategori'];

?>

  <section>
		<div class="container">
			<div class="row">
      <div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"> Kategori <?php echo $nama_kategori; ?></h2>
				
								
<?php
$id_kategori 	 = 	mysqli_real_escape_string($conn,$_GET['id_kategori']);
// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_kategori = '$id_kategori' ORDER BY id_barang DESC ");
$numrows  = mysqli_num_rows($data);
?>

<?php
// Jika data ketemu, maka akan ditampilkan dengan While
if($numrows > 0)
{
  while($row = mysqli_fetch_assoc($data))
  {
    
?>

            <div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="gambar/<?php echo $row['gambar']; ?>" alt="" />
											<h2><?php echo number_format($row['harga'], 0, ',', '.'); ?></h2>
											<p><?php echo $row['nama_barang']; ?></p>
                      <p><?php echo $row['keterangan']; ?></p>
											<a href="barang_detail.php?id_barang=<?php echo $row['id_barang']; ?>" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan</a>
                      

										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo number_format($row['harga'], 0, ',', '.'); ?></h2>
												<p><?php echo $row['nama_barang']; ?></p>
                        <p><?php echo $row['keterangan']; ?></p>
												<a href="barang_detail.php?id_barang=<?php echo $row['id_barang']; ?>" style="margin-bottom:23px" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan</a>
                      
											</div>
										</div>
								</div>
								
							</div>
						</div>
  
  <?php
  // Mengakhiri pengulangan while
  }
}
  else
  {
    echo "<script>alert(' Maaf, Barang Dalam Kategori Yang Anda Pilih Sedang Kosong !');history.go(-1)</script>";
  }
?>
  				
				

						
						
					</div><!--Latest_Brend_items-->



					
					
					
					
					
				</div>
			</div>
		</div>
	</section>


 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

