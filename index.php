<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database



?>

  <section id="slider">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><img src="assets/images/home/logo2.jpg" width="190"alt="" /></h1>
									<h2> Sepatu Berkualitas</h2>
									<p> Kami Menyediakan Sepatu Berkualitas Untuk Kebutuhan Anda</p>
									<a href="grooming.php"><button type="button" class="btn btn-default get"> Pesan Sekarang</button></a>
								</div>
								<div class="col-sm-6">
									<img src="<?php echo $base_url ?>assets/images/home/slider2.png" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><img src="assets/images/home/logo2.jpg" width="190"alt="" /></h1>
									<h2> Harga Terjangkau</h2>
									<p> Harga Yang Kami Tawarkan Sangat Terjangkau</p>
									<a href="penitipan_hewan.php"><button type="button" class="btn btn-default get"> Pesan Sekarang</button></a>
								</div>
								<div class="col-sm-6">
								<img src="<?php echo $base_url ?>assets/images/home/slider1.png" class="girl img-responsive" alt="" />
									
								</div>
							</div>
							
							
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
  <section>
  <br><br>
		<div class="container">
			<div class="row">
				
				
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
					<center><a href="index.php"><img src="gambar/logo_kucing.png" width="250"alt="" /></a></center>
					<br><br>
          <div class="productinfo text-center">
		  
		  <h2> Toko Sapatu Threeman</h2></div>
            <div class="productinfo text-center"><p>   Toko Sepatu Threeman adalah toko sepatu yang menjual berbagai model dan tipe sepatu kulit,

<br>Seperti : Sepatu Saffety, Sepatu Vantofel, Sepatu Model PDH, PDL dan Sepatu SLop Saffety<br>

Toko Sepatu Threeman Berdiri pada tahun 2011, memiliki brand sendiri yaitu threeman<br>

Di Bawah Kepemimpinan Bapak Agung Sugiharto</p></div>
            
		</div>
	</section>
	<br><br><br><br>
	<section>
		<div class="container">
			<div class="row">
				

					
					<h2 class="title text-center"> Produk Terbaru Kami</h2>
					<br><br>

						
							<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM tb_barang ORDER BY id_barang DESC LIMIT 8");
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
    echo "<script>alert('Data tidak ditemukan');location.replace('$base_url')</script>";
  }
?>


						
												
					</div><!--Latest_Brend_items-->



					
					
					
					
				</div>
			</div>
		</div>
	</section>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	


 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

