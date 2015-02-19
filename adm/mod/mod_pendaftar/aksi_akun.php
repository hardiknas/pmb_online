<?php
require_once "../cek_sesi.php";
include "../../../config/koneksi.php";
include "../../../config/fungsiku.php";
date_default_timezone_set("Asia/Makassar");
$act=$_GET[act];

if ($act=='upass'){
  	$qp = mysql_query("UPDATE pendaftar SET psPass='$_POST[pass]' WHERE psNISN='$_POST[nisn]'");

    if ($qp){
      echo "<script>window.alert('Password Telah Diubah');
            window.location=('../../media.php?page=akun')</script>";   
    }else{
      echo "<script>window.alert('Password Gagal Diubah');
            self.history.back();</script>";
    }
  	
}elseif ($act=='blok'){

  mysql_query("UPDATE pendaftar SET psSt_Akses='0' WHERE psNISN='$_GET[id]'");
  echo "<script>window.location=('../../media.php?page=akun')</script>";

}elseif ($act=='unblok'){

  mysql_query("UPDATE pendaftar SET psSt_Akses='1' WHERE psNISN='$_GET[id]'");
  echo "<script>window.location=('../../media.php?page=akun')</script>";

}

?>
