<?php
	echo "
	<h1 class='page-header'>SELAMAT DATANG</h1>
	<hr>
	<p>Hai <b>$_SESSION[pmbNama]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
	di sebelah kiri untuk mengelola konten website anda. </p>
	<p>&nbsp;</p<p>&nbsp;</p>
	<p>Login : $hari_ini, ".tgl_indo(date('Y m d'))." | ".date('H:i:s')." WITA</p>";
?>
<hr>
<?php
	include 'mod/mod_pesan/pesan.php';
?>