<?php
include("config/koneksi.php");

function anti_injection($data){
	$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $filter;
}

$nisn =anti_injection($_POST[nisn]);
$pass = anti_injection($_POST[pass]);

$result = mysql_query("SELECT a.* FROM pendaftar a WHERE a.psNISN='$nisn'");
$x=mysql_fetch_array($result);

$uNISN = trim($x[psNISN]);
$uNama = trim($x[psNama]);
$uPass = trim($x[psPass]);
$uAkses = trim($x[psSt_Akses]);

if (mysql_num_rows($result)>0){
	if (($uPass==$pass) && ($uAkses=="1")){	
		session_start();
		include "timeout.php";

		$_SESSION[atimNISN] = $uNISN;
		$_SESSION[atimNama] = $uNama;
		$_SESSION[atimLog]= 1;
		
		timer();
		echo "<script languange=JavaScript> alert(\"Selamat Datang $uNama ..!!\"); </script>";
		echo "<meta http-equiv=refresh content=\"0;url=akun\">";
	}else{
		echo "<script languange=JavaScript> alert(\"Maaf, Login gagal atau anda sedang diblokir oleh Administrtor ..!!\"); </script>";
		echo "<meta http-equiv=refresh content=\"0;url=login\">";
	}
}else{
	echo "<script languange=JavaScript> alert(\"Maaf.. Username anda tidak terdaftar..!!\"); </script>";
	echo "<meta http-equiv=refresh content=\"0;url=register\">";				
}
?>