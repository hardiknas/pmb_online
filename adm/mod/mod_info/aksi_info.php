<?php
require_once "../cek_sesi.php";
include "../../../config/koneksi.php";
date_default_timezone_set("Asia/Makassar");
$act=$_GET[act];
$tgls = date('Y-m-d');

if ($act=='tambah'){
  	$q= mysql_query("INSERT INTO info (iTgl,iJudul,iIsi)VALUES('$tgls','$_POST[judul]','$_POST[isi]')");
    if ($q){
      echo "<script>window.alert('Data Tersimpan');
          window.location=('../../media.php?page=info')</script>";   
    }else{
      echo "<script>window.alert('Data Gagal Tersimpan');
          self.history.back();</script>";
    }
  	
}elseif ($act=='edit'){
   
   $q= mysql_query("UPDATE info SET iJudul='$_POST[judul]',
                                    iIsi='$_POST[isi]'
                                WHERE iId='$_POST[id]'");

    if ($q){
      echo "<script>window.alert('Data Tersimpan');
          window.location=('../../media.php?page=info')</script>";   
    }else{
      echo "<script>window.alert('Data Gagal Tersimpan');
          self.history.back();</script>";
    }

}elseif ($act=='hapus'){
    $q = mysql_query("DELETE FROM info WHERE iId='$_GET[id]'");
    echo "<script>window.location=('../../media.php?page=info')</script>";   
}
?>
