<?php
include 'record/record_user.php';

// Super Admin Menu
if ($sesen_level == "admin")
{
  echo "
  
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-olive'>
      <div class='inner'><h3> $user </h3><p>User</p></div>
      <div class='icon'><i class='fa fa-user'></i></div>
      <a href='user_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>";
}
elseif ($sesen_level == "pemilik_toko")
{
  echo " ";
  
}
?>