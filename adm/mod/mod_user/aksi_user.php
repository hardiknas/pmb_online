<?php
require_once "../cek_sesi.php";
include "../../../config/koneksi.php";
$act=$_GET[act];

if ($act=='tambah'){
  	$pass = md5($_POST[password]);
  	$q = mysql_query("INSERT INTO user (uUname,uNama,uTelp,
                                        uEmail,uLevel,uPass
                                       )VALUES(
                                       '$_POST[username]','$_POST[nama]','$_POST[telp]',
                                       '$_POST[email]','$_POST[level]','$pass')
                    ");
  	
    if ($q){
      echo "<script>window.alert('Data Tersimpan');
          window.location=('../../media.php?page=user')</script>";   
    }else{
      echo "<script>window.alert('Data Gagal Tersimpan, pastikan username belum digunakan oleh user lain..!');
          self.history.back();</script>";
    }

}elseif ($act=='hapus'){
    mysql_query("DELETE FROM user WHERE uUname='$_GET[id]'");
    echo "<script>window.location=('../../media.php?page=user')</script>";

}elseif ($act=='edit'){

  if (!empty($_POST[password])){
    $pass = md5($_POST[password]);
    $q = mysql_query("UPDATE user SET uNama ='$_POST[nama]',
                                      uTelp='$_POST[telp]',
                                      uEmail='$_POST[email]',
                                      uLevel='$_POST[level]',
                                      uPass='$pass'
                                  WHERE uUname = '$_POST[username]'");
  }else{
    $q = mysql_query("UPDATE user SET uNama ='$_POST[nama]',
                                      uTelp='$_POST[telp]',
                                      uEmail='$_POST[email]',
                                      uLevel='$_POST[level]'
                                  WHERE uUname = '$_POST[username]'");
  }  
  if ($q){
    echo "<script>window.alert('Data Tersimpan');
          window.location=('../../media.php?page=user')</script>";   
  }else{
    echo "<script>window.alert('Data Gagal Tersimpan');
         self.history.back();</script>";
  }

}
?>