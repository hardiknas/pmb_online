<?php
  header("Cache-Control: no-cache, must-revalidates");
  header("Expires: Mon, 26 Jul 1997 00:00:00 GMT");
  
  require_once ("config/koneksi.php");  
  
  $id = $_GET["id"]; // Ambil variabel URL
  $sql = "SELECT * FROM pendaftar WHERE psNISN='$id'";
  $hasil = mysql_query($sql);
  if (!$hasil){
   print("Query tak dapat diproses");                
  }else{
     $baris = mysql_fetch_row($hasil);
     $data_ada = TRUE;
     if (empty($baris)){
        $data_ada = FALSE;
     }      
     if ($data_ada){
		 		echo "<span class='label label-large label-warning'>NISN sudah terdaftar..!!</span>";
     }else{
		    echo "<span class='label label-large label-success'>OK</span>";
	   }
  }   
?>
