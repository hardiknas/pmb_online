<?php
require_once "../cek_sesi.php";
include "../../../config/koneksi.php";
include "../../../config/fungsiku.php";
date_default_timezone_set("Asia/Makassar");
$act=$_GET[act];
$tgls = date('Y-m-d');

if ($act=='tambah'){
  	$qp = mysql_query("INSERT INTO pendaftar (psNISN,psNoPeserta,psNama,psJK,
                                             psTglDaftar,psNamaSekolah,psEmail,psPass,
                                             psSt_Bio,psSt_Verifikasi,psSt_Seleksi,psSt_Akses)
                                      VALUES('$_POST[nisn]','$_POST[no_peserta]','$_POST[nama]','$_POST[jk]',
                                             '$_POST[tgld]','$_POST[namasekolah]','$_POST[email]','$_POST[pass]',
                                             '0','0','0','1')");

    $qmm = mysql_query("INSERT INTO n_mm (psNISN,mmStatus) VALUES ('$_POST[nisn]','0')");
    $qba = mysql_query("INSERT INTO n_indo (psNISN,indoStatus) VALUES ('$_POST[nisn]','0')");
    $qbi = mysql_query("INSERT INTO n_bing (psNISN,bingStatus) VALUES ('$_POST[nisn]','0')");
    $qpa = mysql_query("INSERT INTO n_ipa (psNISN,ipaStatus) VALUES ('$_POST[nisn]','0')");
    $qps = mysql_query("INSERT INTO n_ips (psNISN,ipsStatus) VALUES ('$_POST[nisn]','0')");

    if ($qp && $qmm && $qba && $qbi && $qpa && $qps){
      echo "<script>window.alert('Data Tersimpan');
            window.location=('../../media.php?page=pendaftar')</script>";   
    }else{
      echo "<script>window.alert('Data Gagal Tersimpan');
            self.history.back();</script>";
    }
  	
}elseif ($act=='hapus'){

    mysql_query("DELETE FROM pendaftar WHERE psNISN='$_GET[id]'");
    mysql_query("DELETE FROM n_mm WHERE psNISN='$_GET[id]'");
    mysql_query("DELETE FROM n_indo WHERE psNISN='$_GET[id]'");
    mysql_query("DELETE FROM n_bing WHERE psNISN='$_GET[id]'");
    mysql_query("DELETE FROM n_ipa WHERE psNISN='$_GET[id]'");
    mysql_query("DELETE FROM n_ips WHERE psNISN='$_GET[id]'");
    echo "<script>window.location=('../../media.php?page=pendaftar')</script>";  

}elseif ($act=='verifikasi'){

  notAllow($_GET[id]);
  mysql_query("UPDATE pendaftar SET psSt_Verifikasi='1' WHERE psNISN='$_GET[id]'");
  echo "<script>window.location=('../../media.php?page=pendaftar')</script>";

}elseif ($act=='l'){

  notAllow($_GET[id]);
  mysql_query("UPDATE pendaftar SET psSt_Seleksi='1' WHERE psNISN='$_GET[id]'");
  echo "<script>window.location=('../../media.php?page=pendaftar')</script>";

}elseif ($act=='nverifikasi'){

  notAllow($_GET[id]);
  mysql_query("UPDATE pendaftar SET psSt_Verifikasi='0' WHERE psNISN='$_GET[id]'");
  echo "<script>window.location=('../../media.php?page=pendaftar')</script>";

}elseif ($act=='tl'){
  
  notAllow($_GET[id]);
  mysql_query("UPDATE pendaftar SET psSt_Seleksi='0' WHERE psNISN='$_GET[id]'");
  echo "<script>window.location=('../../media.php?page=pendaftar')</script>";
  
}

function notAllow($idx){
  $psBio = getStatusBio($_GET[id]);
  $psNilai = getStatusNilai($_GET[id]);

  if (($psBio!="1")&&($psNilai!="1")){
    echo "<script>alert('Biodata dan Nilai Harus dilenkgapi untuk melakukan verifikasi dan ujian..!');
                  window.location=('../../media.php?page=pendaftar')
          </script>";  
    exit();
  }
}
?>
