<?php
//session_start();
// Pengaturan Database
$server = "localhost";
$user = "root";
$password = "";
$database = "atimmks";

// Connect Ke Mysql
$connect = mysql_connect($server,$user,$password) or die ("Koneksi Mysql Gagal");
mysql_select_db($database,$connect) or die ("Pilih Database Gagal");
?>
