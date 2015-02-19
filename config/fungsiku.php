<?php
include "koneksi.php";
date_default_timezone_set('Asia/Makassar');

function getNoPeserta(){
	$tgls = date("Ymd");
	$now = date("Y-m-d");

	$q = mysql_fetch_array(mysql_query("SELECT MAX(psNoPeserta) as x FROM pendaftar WHERE psTglDaftar='$now'"));
	$d = $q[x];
	$not = substr($d, 8,3);

	if ($not==""){
		$y = "001";
	}else{
		$i = $not;
		$i++;
		if (strlen($i)==1){
			$y="00".$i;
		}elseif (strlen($i)==2) {
			$y="0".$i;
		}else{
			$y=$i;
		}
	}

	$nomor = $tgls.$y;
	return $nomor; 
}

function getStatusBio($id){
	$qq = mysql_fetch_array(mysql_query("SELECT a.psSt_Bio FROM pendaftar a
	   											WHERE a.psNISN='$id'
	   											"));
	$st = $qq[psSt_Bio];
   return $st;
}

function getStatusNilai($id){
	$qx = mysql_fetch_array(mysql_query("SELECT a.psNISN, 
						   								 c.bingStatus,
						   								 d.indoStatus,
						   								 e.ipaStatus,
						   								 f.ipsStatus,
						   								 g.mmStatus 
						   						FROM pendaftar a
						   						LEFT JOIN n_bing c ON a.psNISN=c.psNISN
						   						LEFT JOIN n_indo d ON a.psNISN=d.psNISN
						   						LEFT JOIN n_ipa e ON a.psNISN=e.psNISN
						   						LEFT JOIN n_ips f ON a.psNISN=f.psNISN
						   						LEFT JOIN n_mm g ON a.psNISN=g.psNISN
						   						WHERE a.psNISN='$id'
						   					  "));

	if (($qx[bingStatus]=="1") && ($qx[indoStatus]=="1") && ($qx[ipaStatus]=="1") && ($qx[ipsStatus]=="1") && ($qx[mmStatus]=="1")) {
   	$st = "1";
   }else{
   	$st = "0";
   }
   return $st;
}

function getPeriodeAktif(){

	$pAktif = mysql_fetch_array(mysql_query("SELECT taId,taTahun FROM periode WHERE taAktif='1'"));
	return $pAktif;

}

function getJumlah($tabel,$term){
	
	$jRec = mysql_num_rows(mysql_query("SELECT * FROM $tabel $term"));
	return $jRec;

}
?>