<?php
session_start();

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");

include "config/fungsi_indotgl.php";
include "config/koneksi.php";
include "config/fungsiku.php";

$t = getPeriodeAktif();
$taAktif = $t[taId];
$thnAktif = $t[taTahun];
$_SESSION[atimPeriode]= $taAktif;
$_SESSION[atimTahun]= $thnAktif;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pendaftaran Mahasiswa Baru ATIM</title>
	<link href="stylesheets/application.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="stylesheets/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="stylesheets/bootstrap-responsive.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="stylesheets/blanca.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic" type="text/css"/>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold" type="text/css"/>
	<link href="asset/DT_bootstrap.css" rel="stylesheet" media="screen" />
</head>
<body>
	<div id="nav" class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a href="index.php" class="brand">Pendaftaran Mahasiswa Baru ATIM</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="active"><a href="home">Beranda</a></li>
						<li><a href="info">Info</a></li>
						<li><a href="pendaftar">Pendaftar</a></li>
						<li><a href="contact">Kontak Kami</a></li>
					</ul>
					<?php
					if ($_SESSION[atimNISN]==""){
					?>
						<ul class="nav pull-right">
							<li><a href="register">Daftar</a></li>
							<li><a href="login">Login</a></li>
						</ul>
					<?php
					}else{
					?>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									Login : <span class="label label-success"><?php echo $_SESSION[atimNama];?> </span>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="biodata">Biodata</a></li>
									<li><a href="nilai">Nilai</a></li>
									<li><a href="logout">Logout</a></li>
								</ul>
							</li>
						</ul>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	</div>
	<div class="stripe landing-message">
		<div class="container">
			<img width="100%" src="images/header.png" />
		</div>
	</div>
		<div class="stripe">
			<div class="container">
				<!-- content -->
				<hr>
				<div class="row">
					<div class="span8">
					<?php
					$page = $_GET[pages];
					switch ($page) {
					default:
						if ($_SESSION[atimNISN]==""){
						?>
							<div class="hero-unit">
								<h1>Pendaftaran Mahasiswa Baru ATIM 2014</h1>
								<br>
								<p>Segera daftarkan putra-putri anda di Akademi Teknik Industri Makassar (ATIM)</p>
								<p>
								<a href="register" class="btn btn-primary btn-large">Daftar</a>
								</p>
							</div>
						<?php
						}else{
							include "akun.php";
						}
						break;
					case 'daftar':
						include 'signup.php';break;
					case 'login':
						include 'login.php';break;
					case 'kontak':
						include 'kontak.php';break;
					case 'info':
						include 'info.php';break;
					case 'bio':
						include 'bio.php';break;
					case 'nilai':
						include 'nilai.php';break;
					case 'pendaftar':
						include 'listpendaftar.php';break;
					}
					?>
					</div>
					<div class="span4">
						<div class="well">
						<h2>Statistik Pendaftar</h2>
						<hr>
						<h3>
						<?php 
							
							if (empty($_SESSION[atimTahun])){
					 			$qPrefix = "WHERE YEAR(psTglDaftar)=YEAR(NOW())";
					 		}else{
					 			$qPrefix = "WHERE YEAR(psTglDaftar)='$_SESSION[atimTahun]'";
					 		}

							$jAll = getJumlah("pendaftar","$qPrefix AND 1");
							$jToday = getJumlah("pendaftar","$qPrefix AND DAY(psTglDaftar)=DAY(NOW())");
							$jVeri = getJumlah("pendaftar","$qPrefix AND psSt_Verifikasi='1'");
							$jL = getJumlah("pendaftar","$qPrefix AND psJK='L'");
							$jP = getJumlah("pendaftar","$qPrefix AND psJK='P'");

							echo "Pendaftar Keseluruhan : $jAll Orang<br>";
							echo "Pendaftar Hari Ini : $jToday Orang<br>";
							echo "Pendaftar Terverifikasi : $jVeri Orang<br>";
							echo "Pendaftar Laki-Laki : $jL Orang<br>";
							echo "Pendaftar Perempuan : $jP Orang<br>";
						?>
						</h3>
						</div>
					</div>
				</div>
				<!--content-->
				<br>
			</div>
		</div>
	</div>
	<footer>
		<div id="footer" class="stripe-color">
			<div class="container">
				<center>
					Akademi Teknik Industri Makassar <br>
					Jl. Sunu No. 220 | Telp. 0411-449609 | Fax : 0411-449867 <br>
					Makassar - Sulawesi Selatan</center>
				<div class="divider"></div>
				<div class="row last">
					<div class="span12">
						<p class="sub">&copy; ATIM <?php echo date('Y');?> </p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="javascripts/jquery.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-transition.html"></script>
	<script type="text/javascript" src="javascripts/bootstrap-alert.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-modal.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-scrollspy.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-tab.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-popover.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-button.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-carousel.js"></script>
	<script type="text/javascript" src="javascripts/bootstrap-typeahead.js"></script>

	<script src="javascripts/application.js" type="text/javascript"></script>
	<script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
	<script src="asset/DT_bootstrap.js"></script>
	<script>
		$(function(){});
	</script>

	<script type="text/javascript">
		$('[rel=tooltip]').tooltip();
   </script>

</body>
</html>
