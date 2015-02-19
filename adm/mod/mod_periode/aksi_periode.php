<?php
require_once "../cek_sesi.php";
include "../../../config/koneksi.php";
include "../../../config/fungsiku.php";
date_default_timezone_set("Asia/Makassar");
$act=$_GET[act];
$tgls = date('Y-m-d');

if ($act=='tambah'){
  	$q= mysql_query("INSERT INTO periode (taPeriode,taTahun,taAktif)VALUES('$_POST[periode]','$_POST[tahun]','0')");
    if ($q){
      echo "<script>window.alert('Data Tersimpan');
          window.location=('../../media.php?page=periode')</script>";   
    }else{
      echo "<script>window.alert('Data Gagal Tersimpan');
          self.history.back();</script>";
    }
  	
}elseif ($act=='edit'){
   
   $q= mysql_query("UPDATE periode SET taPeriode='$_POST[periode]',
                                       taTahun='$_POST[tahun]'
                                  WHERE taId='$_POST[id]'");

    if ($q){
      echo "<script>window.alert('Data Tersimpan');
          window.location=('../../media.php?page=periode')</script>";   
    }else{
      echo "<script>window.alert('Data Gagal Tersimpan');
          self.history.back();</script>";
    }

}elseif ($act=='hapus'){
    $pAktif = getPeriodeAktif();
    if ($pAktif[taId]==$_GET[id]){
      echo "<script>window.alert('Periode Aktif Tidak dapat dihapus...!!!');window.location=('../../media.php?page=periode')</script>";     
      exit();
    }else{
      $q = mysql_query("DELETE FROM periode WHERE taId='$_GET[id]' AND taAktif='0'");
      echo "<script>window.location=('../../media.php?page=periode')</script>";   
    }
}elseif ($act=='aktif'){
    $q1 = mysql_query("UPDATE periode SET taAktif='0'");
    $q2 = mysql_query("UPDATE periode SET taAktif='1' WHERE taId='$_GET[id]'");
    echo "<script>window.location=('../../media.php?page=periode')</script>";   
}
?>
