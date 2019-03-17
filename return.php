<?php
include 'navbar.php';
include 'faktur_return.php';
include 'fungsi/cek_login_public.php';

?>


    <!-- Awal Konten Utama -->
    
		<div class="container">
			<div class="row">
				
				<div class="col-sm-4 ">
					<div class="login-form"><!--login form-->
						<h2> Input Barang Return</h2>
						<form action="return.php" method="post" enctype="multipart/form-data">
							<input type="text" name="no_invoice" placeholder="Nomor Invoice (Sesuaikan Dengan Invoice)" required />
							<input type="text" name="nama_barang" placeholder="Nama Barang (Sesuaikan Dengan Invoice)" required/>
							<input type="text" name="jumlah" placeholder="Jumlah Barang" required/>
							<input type="text" name="keterangan" placeholder="Keterangan" required/>
							
							
							
							<button type="submit" name="tambahkan" class="btn btn-default"> Tambahkan</button>
						</form>

					</div><!--/login form-->
				</div>
				<section id="cart_items">
				<div class="col-sm-8 ">
					
						<h4> Data return Barang</h4>
						<div class="table-responsive cart_info">
			
						<form method="post" id="form1" action="keranjang_update.php">
							
					<?php	$cek_invoice = 	mysqli_query($conn,"SELECT *
										FROM detail_return
										LEFT JOIN tb_return ON tb_return.id_return = detail_return.id_return
										LEFT JOIN tb_barang ON tb_barang.id_barang = detail_return.id_barang
										
										WHERE 
										tb_return.id_customer = '$sesen_id_customer'
										AND tb_return.status = 0");
		if(mysqli_num_rows($cek_invoice) == 0)
		{echo "<center><h4>Data Return anda masih kosong</h4></center>";}
		else
		{
			echo "
			<table class='table table-condensed'>
					<thead>
						<tr class='cart_menu'>
							<td> No Invoice</td>
							<td> Nama Barang</td>
							<td>Jumlah</td>
							<td> Keterangan</td>
							<td></td>
							
						</tr>
					</thead>
			";
			$i = 1;

			while($data_keranjang = mysqli_fetch_array($cek_invoice))
			{
				
				

				echo "
				<tbody>
						<tr>
							<td class='cart_price'>
								<p>$data_keranjang[id_order]</p>
							</td>
							<td>
							<p>$data_keranjang[nama_barang]</p>
							</td>
							<td class='cart_total'>
								<p class='cart_total_price'>$data_keranjang[jumlah]</p>
							</td>
							<td class='cart_description'>
								
								<p>$data_keranjang[keterangan_return]</p>
								
							</td>
							
							
							
							<td data-title='Aksi' align='center'>
								
								<a href='return_hapus.php?id_detail_return=$data_keranjang[id_detail_return]'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align' title='Hapus' OnClick=\"return confirm('Apakah Anda yakin?');\">
											<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
											</button>
								</a>
							</td>
							
						</tr>
						<tr>
							
							
							<td data-title='Aksi' align='center' colspan='2'>
								
								<a href='return_konfirmasi.php'>
									<button name='hapus' type='button' class='btn btn-fefault cart cart_wishlist' aria-label='Left Align'  OnClick=\"return confirm('Apakah Anda yakin?');\">
											Konfirmasi
											</button>
								</a>
							</td>
							<td colspan='2'></td>
							
						</tr>

						
					</tbody>
				";
			$i++;
		}


		$no = $i-1;
		echo "<input type='hidden' name='n' value='$no' />";
		echo "</table>
		"; 
	}?>
						</form>
						</div>
					</div>
					</section>


					</div>
		</div>
<?php 
if(isset($_POST['tambahkan']))
{
  $no_invoice       = $_POST['no_invoice'];
  $nama_barang       = $_POST['nama_barang'];
  $jumlah = $_POST['jumlah'];
  $keterangan = $_POST['keterangan'];
  

    $sql  = "SELECT * FROM tb_barang WHERE nama_barang = '$nama_barang' ";
    
  $cek_stok  = mysqli_query($conn,$sql);
  if(mysqli_num_rows($cek_stok) == 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert(' Nama Barang Tidak Ditemukan');history.go(-1)</script>";
  }

  else {

	$cari_barang  = "SELECT * FROM tb_barang WHERE nama_barang = '$nama_barang' ";
    $hasil_barang = mysqli_query($conn, $cari_barang);
    $data_barang  = mysqli_fetch_array($hasil_barang);
    
    $id_barang  = $data_barang['id_barang'];
    
    $cari_transaksi   = "SELECT * FROM detail_return WHERE id_customer = '$sesen_id_customer' 
                          AND id_barang = '$id_barang' AND id_return = '$faktur' ";
      $hasil_transaksi  = mysqli_query($conn,$cari_transaksi);
      $data_transaksi   = mysqli_fetch_array($hasil_transaksi);

      if(mysqli_num_rows($hasil_transaksi) == 0)
      {

            $query1 = "INSERT INTO detail_return (id_return,
                                                    id_customer,
													id_order,
                                                    id_barang,
                                                    
                                                    jumlah,
													keterangan_return)
                                            VALUES ('$faktur',
                                                    '$sesen_id_customer',
                                                    '$no_invoice',
                                                    '$id_barang',
													'$jumlah',
													'$keterangan')";
			

              if(mysqli_query($conn, $query1)){
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Barang Berhasil Ditambahkan Ke Data Return!');\n";
                echo "window.location='return.php'";
                echo "</script>";
               } else
              {
                echo "Error updating record: " . mysqli_error($conn);
              }
            
     
      }else{
              $jmllama          = $data_transaksi['jumlah'];
              $jmltambah        = $jmllama + $jumlah;

              $query = "UPDATE detail_return SET jumlah        = '$jmltambah',
                                                  keterangan_return        = '$keterangan'  
                                                    
                                              WHERE id_return  = '$faktur' AND id_barang= '$id_barang' AND id_customer='$sesen_id_customer'";
    
	  
				if(mysqli_query($conn, $query)){
					echo "<script language=\"JavaScript\">\n";
					echo "alert('Barang Berhasil Ditambahkan Ke Data Return!');\n";
					echo "window.location='return.php'";
					echo "</script>";
				} else
				{
					echo "Error updating record: " . mysqli_error($conn);
				}
			}     
        
  }

}
?>			
 

    

      <?php include 'footer.php'; ?>
      