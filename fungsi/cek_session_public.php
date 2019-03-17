<?php
if(isset($_SESSION['username']))
{
  $sesen_id_customer        = $_SESSION['id_customer'];
  $sesen_username   = $_SESSION['username'];
  $sesen_nama_lengkap       = $_SESSION['nama_lengkap'];
  $sesen_alamat  = $_SESSION['alamat'];
  $sesen_email      = $_SESSION['email'];
  $sesen_telepon   = $_SESSION['telepon'];
}
?>
