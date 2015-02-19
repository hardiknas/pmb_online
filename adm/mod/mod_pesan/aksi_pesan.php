<?php
require_once "../cek_sesi.php";
include "../../../config/koneksi.php";
date_default_timezone_set("Asia/Makassar");
$act=$_GET[act];
$tgls = date('Y-m-d');

if ($act=='balas'){
   
  $send = mail($_POST[email],$_POST[subjek],$_POST[jawab],"From: pmb_atimks@gmail.com");

  if ($send) {
    $q= mysql_query("UPDATE pesan SET pJawab='$_POST[jawab]', pBalas='1' WHERE pId='$_POST[id]'");
  }
  if ($q){
    echo "<script>window.alert('Email telah dikirim ke $_POST[email]');
        window.location=('../../media.php?page=pesan')</script>";   
  }else{
    echo "<script>window.alert('Email gagal dikirim ke $_POST[email]');
        self.history.back();</script>";
  }

}elseif ($act=='hapus'){
    $q = mysql_query("DELETE FROM pesan WHERE pId='$_GET[id]'");
    echo "<script>window.location=('../../media.php?page=pesan')</script>";   
}
?>
