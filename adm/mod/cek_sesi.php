<?php
session_start();
if(!isset($_SESSION['pmbId'])){
   	echo "<script>parent.location = '../../index.php';</script>";
   	exit;
}elseif ($_SESSION[pmbLevel]!="1"){
	echo "<script>parent.location = '../../media.php';</script>";
	exit;
}
?>