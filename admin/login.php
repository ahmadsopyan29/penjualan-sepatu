<?php session_start();
include "../config.php";

if(isset($_POST['submit']))
{
  $errors 	= array();
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  if (empty($username) && empty($password))
  {
    echo "<script language='javascript'>alert('Isikan USERNAME dan PASSWORD'); location.replace('index.php')</script>";
  }
  elseif (empty($username))
  {
    echo "<script language='javascript'>alert('Isikan USERNAME'); location.replace('index.php')</script>";
  }
  elseif (empty($password))
  {
    echo "<script language='javascript'>alert('Isikan PASSWORD'); location.replace('index.php')</script>";
  }

  $sql    = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' ";
  $result = mysqli_query($conn, $sql);
  $data   = mysqli_fetch_array($result);
  if (mysqli_num_rows($result) > 0)
  {
   
      if(empty($errors))
      {
        // Menyimpan session login
        $_SESSION['id_user']    = $data['id_user'];   
           
        $_SESSION['username']	  = $data['username'];
          $_SESSION['nama_lengkap']       = $data['nama_lengkap'];
	        $_SESSION['alamat']  = $data['alamat'];
	        $_SESSION['email']       = $data['email'];
          $_SESSION['telepon']   = $data['telepon'];
          $_SESSION['level']   = $data['level'];   
        

        if($data['level'] == 'admin')
        {
          echo "<script language='javascript'>alert('Anda berhasil Login sebagai Admin'); location.replace('home.php')</script>";
        }
        elseif($data['level'] == 'pemilik_toko')
        {
          echo "<script language='javascript'>alert('Anda berhasil Login sebagai SuperAdmin'); location.replace('home.php')</script>";
        }
      }
    
      else
      {
        echo "<script>alert('PASSWORD SALAH!');history.go(-1)</script>";
      }
  }
    else
    {
      echo "<script>alert('USERNAME yang Anda masukkan tidak terdaftar!');history.go(-1)</script>";
    }
}
  else
  {
    echo "<script>alert('Pencet dulu tombolnya!');history.go(-1)</script>";
  }
?>
