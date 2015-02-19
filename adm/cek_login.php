<?php
include "../config/koneksi.php";
include "../config/fungsiku.php";

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
$utipe = 1;
$uname = anti_injection($_POST['username']);
$upass = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($uname) OR !ctype_alnum($upass)){
  header('location:index.php');
}else{
	$login=mysql_query("SELECT * FROM user WHERE uUname='$uname' AND uPass='$upass'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		session_start();
		include "timeout.php";
		$uid=$r[uUname];
		$unama=$r[uNama];
		$uname=$r[uUname];
		$ulevel=$r[uLevel];

		$t = getPeriodeAktif();
		$taAktif = $t[taId];
		$thnAktif = $t[taTahun];

		$_SESSION[pmbId] = $uid;
		$_SESSION[pmbNama] = $unama;
		$_SESSION[pmbName] = $uname;
		$_SESSION[pmbLevel]= $ulevel;
		$_SESSION[pmbPeriode]= $taAktif;
		$_SESSION[pmbTahun]= $thnAktif;

		// session timeout
 
		$_SESSION[pmbOk] = 1;
		timer();
		header('location:media.php?pages=home');
	}else{
		echo "<script>alert('Username atau Password Salah..!'); parent.location = 'index.php';</script>";  
	}
}
?>
