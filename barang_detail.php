<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database
?>
<?php

// Memanggil data dari tabel produk diurutkan dengan id_produk secara DESC dan dibatasi sesuai $start dan $per_halaman
$id_barang= mysqli_real_escape_string($conn,$_GET['id_barang']);
$data     = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_barang='$id_barang' ");
$numrows  = mysqli_num_rows($data);
$row = mysqli_fetch_assoc($data);
?>
  
	<section>
		<div class="container">
			<div class="row">
				
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<!--Code for Zoom-->
							<div ><br><br><br>
								<img  src='gambar/<?php echo $row['gambar']; ?>' width='100%'/>
							</div>
							
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="" class="newarrival" alt="" />
								<h2><?php echo $row['nama_barang']; ?></h2>
								
								
								<h1 style="color: #FE980F"><?php echo number_format($row['harga'], 0, ',', '.'); ?></h1>
								<p><?php echo $row['keterangan']; ?></p>
								<br>
								<form method="post" action="pesan_barang.php?id_barang=<?php echo $row['id_barang']; ?>">
								
									
										
											
											<?php
											$prov = "SELECT * FROM tb_stok WHERE id_barang = '$id_barang' AND stok > 0";
											$result = mysqli_query($conn, $prov);
											if (mysqli_num_rows($result) > 0)
											{
												echo '<p style=""><strong>Tersedia  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;';
											while ($data = mysqli_fetch_array($result))
											{
												echo "<br><strong>Ukuran -> $data[ukuran] Stok ->$data[stok] &nbsp;&nbsp;</strong>";
											}
											
										
										echo '</strong>	
									</p>
									<br>
									<p style=""><strong>Ukuran &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;</strong>
										<select name="ukuran" id="jam" style="width:140px;border:1px solid #e3e3e3;border-radius:2px" required>
											<option value="">--Pilih Ukuran--</option>'; ?>
											
											<?php
											$prov = "SELECT * FROM tb_stok WHERE id_barang='$id_barang' AND stok > 0";
											$result = mysqli_query($conn, $prov);
											if (mysqli_num_rows($result) > 0)
											{
											while ($data = mysqli_fetch_array($result))
											{
												echo "<option value='$data[ukuran]'> $data[ukuran]</option>\n";
											}
											
										
										echo '</select>
									</p>
									<p style="float:"><strong> Jumlah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;</strong>
									<input type="text" name="jumlah"  id="nama_hewan" style="width:150px;border:1px solid #e3e3e3;border-radius:2px" required>
									</p>
								<div style="float:left;margin-top:20px;">
									
										<button type="submit" name="pesan_barang" class="btn btn-fefault cart cart_wishlist">
											<i class="glyphicon glyphicon-shopping-cart"></i>
											
											Pesan
										</button>';
									}
									else
									{
										echo "Stok Habis";
									}
									?>
								<?php }
								else
								{
									echo "stok Habis";
								}
								?>
									
								</div>
								</form>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					
					
				</div>
			</div>
		</div>
	</section>

 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

