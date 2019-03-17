<?php                   // Memulai session
include 'navbar.php';                     // Panggil koneksi ke database
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<h3> Keranjang</h3>
			<div class="table-responsive cart_info">
			
	<form method="post" id="form1" action="keranjang_update.php">
		<?php
		// Panggil data faktur
		include 'faktur.php';
		// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
		$cek_invoice = 	mysqli_query($conn,"SELECT *
										FROM detail_order
										LEFT JOIN tb_order ON tb_order.id_order = detail_order.id_order
										LEFT JOIN tb_barang ON tb_barang.id_barang = detail_order.id_barang
										WHERE tb_order.id_order = '$faktur'
										AND tb_order.id_customer = '$sesen_id_customer'
										AND tb_order.status = 0");
		if(mysqli_num_rows($cek_invoice) == 0)
		{echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
		else
		{
			echo "
			<table class='table table-condensed'>
					<thead>
						<tr class='cart_menu'>
							<td> No </td>
							<td class='image'>Item</td>
							<td class='description'></td>
							<td class='price'>Harga</td>
							<td class='price'>Jumlah</td>
							<td > Subtotal</td>
							<td class='total' align='center'></td>
							
						</tr>
					</thead>
			";
			$i = 1;

			while($data_keranjang = mysqli_fetch_array($cek_invoice))
			{
				
				$subtotal 		= number_format($data_keranjang['subtotal'], 0, ',', '.');
				$harga 		= number_format($data_keranjang['harga'], 0, ',', '.');

				echo "
				<tbody>
						<tr>
							<td> $i</td>
							
							<td class='cart_product'>
								<a href='barang_detail.php?id_barang=$data_keranjang[id_barang]'><img src='gambar/$data_keranjang[gambar]' width='70' alt=''></a>
							</td>
							<td class='cart_description'>
								<h4><a href=''>$data_keranjang[nama_barang]</a></h4>
								<p>Ukuran : $data_keranjang[ukuran]</p>
								<p>Untuk Menambah Jumlah Barang <a href='barang_detail.php?id_barang=$data_keranjang[id_barang]'>Klik Disini</a></p>
							</td>
							<td class='cart_price'>
								<p>$harga</p>
							</td>
							<td>
							<p>$data_keranjang[jumlah]</p>
							
							
							</td>
							<td class='cart_total'>
								<p class='cart_total_price'>$subtotal,-</p>
							</td>
							<td data-title='Aksi' align='center'>
								
								<a href='keranjang_hapus.php?id_detail_order=$data_keranjang[id_detail_order]'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Hapus' OnClick=\"return confirm('Apakah Anda yakin?');\">
											<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
											</button>
								</a>
							</td>
							
						</tr>

						
					</tbody>
				";
			$i++;
		}


		$no = $i-1;
		echo "<input type='hidden' name='n' value='$no' />";
		echo "</table>
		</div>


			</form>
					</div>
				</div>
			</section>";

		echo " <section id='cart_items'>
		<div class='container'>
			
			<div class='table-responsive cart_info'>";
			$cek = 	mysqli_query($conn,"SELECT sum(subtotal) as grandtotal
										FROM detail_order
										LEFT JOIN tb_order ON tb_order.id_order = detail_order.id_order
										LEFT JOIN tb_barang ON tb_barang.id_barang = detail_order.id_barang
										WHERE tb_order.id_order = '$faktur'
										AND tb_order.id_customer = '$sesen_id_customer'
										AND tb_order.status = 0");
			$data = mysqli_fetch_array($cek);
			$grand_total 		= number_format($data['grandtotal'], 0, ',', '.');
		echo "<form action='checkout.php' method='post' >
		<table class='table table-condensed'>
			<thead>
				<tr class='cart_menu'>
					<td></td>
					<td align='center' width='300'>Total</td>
					<td  align='center'> </td>
					
					<td  width='350'></td>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td></td>
					<td width='100' align='center'>
						
						
							
					<p class='cart_total_price'>$grand_total</p>	
						
					</td>
					<td align='center'>
						
					</td>
					<td align='center' >
								
								<button name='checkout' type='submit' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Checkout' OnClick=\"return confirm('Anda Yakin Untuk CheckOut?');\">
								Checkout
									</button>
									<a href='index.php'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Lanjut Belanja' OnClick=\'return confirm('Apakah Anda yakin?');\'>
								Lanjut Belanja
									</button></a>
					</td>
				</tr>

				
			</tbody>
		
";

			
	}
	?>
	
			</table>
		</form>
	</div>
	</div>
</section>

	
		 
	

 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database



?>

