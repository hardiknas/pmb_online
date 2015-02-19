<?php
session_start();
if($_SESSION[atimLog]==""){
	echo "<script>parent.location ='home';</script>";
	exit;
}
include "config/koneksi.php";
include "config/fungsi_print.php";
include "config/fungsi_indotgl.php";  

if (isset($_SESSION[atimNISN])){
	date_default_timezone_set("Asia/Makassar");
	?>

	<script type="text/javascript">
	window.print() 
	</script>

	<style type="text/css">
	#print {
		margin:auto;
		border:1px solid #2A9FAA;
		text-align:center;
		font-family:"Courier New", Courier, monospace;
		width:900px;
		font-size:14px;
	}
	#print .title {
		margin:20px;
		text-align:right;
		font-family:"Courier New", Courier, monospace;
		font-size:12px;
	}
	#print span {
		text-align:center;
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;	
		font-size:18px;
	}
	#print table {
		border-collapse:collapse;
		width:95%;
		margin:20px;
	}
	#print .table1 {
		border-collapse:collapse;
		width:100%;
		text-align:center;
	}
	#print .table2 {
		margin:20px;
		border-collapse:collapse;;
		width:95%;
	}
	#print table hr {
		border:1px dashed #A0A0A4;	
	}
	#print .ttd1 {
		margin-right:500px;
	}
	#print .ttd2 {
		float:right;
	}
	#print table th {
		background:#A0A0A4;
		color:#000;
		font-family:Verdana, Geneva, sans-serif;
		font-size:12px;
		font:normal;
		text-transform:uppercase;
		height:30px;
	}

	#print .grand {
		width:700px;
		padding:10px;
		text-align:left;	
	}
	#print .grand table {
		margin-left:-90px;	
	}
	#logo{
		width:111px;
		height:90px;
		padding-top:10px;	
		margin-left:10px;
	}

	h2,h3{
		margin: 0px 0px 0px 0px;
	}
	</style>

	<title>Pendaftaran Mahasiswa Baru ATIM</title>
	<?php
	$tanggal = tgl_indo(date("Y-m-d"));
	$jam     = date("H:i:s");
	$hari_ini = $seminggu[$hari];
	?>
	<div id="print">
		<table class='table1'>
			<tr align='left'>
				<td><img src='images/lki.png'></td>
				<td valign='middle' colspan='2'>
					<h4>PUSAT PENDIDIKAN DAN PELATIHAN INDUSTRI</h4>
					<h2>AKADEMI TEKNIK INDUSTRI MAKASSAR</h2>
					<p style="font-size:12px;">
						<?php echo $atimAlamat;?><br>
						<?php echo $atimTelp." | ".$atimFax;?><br>
						<?php echo $atimWeb;?>
					</p>
				</td>
			</tr>
			<table>		
				<hr><strong>&nbsp;</strong><hr>
				<br>
				<?php
				echo "<div class='title'>$hari_ini, $tanggal<br> Jam: $jam</div>";
				echo "<h3><u>DATA NILAI CALON MAHASISWA</u></h3>";

				$res = mysql_query("SELECT a.psNISN,a.psNama,
															 b.*,
															 c.*,
															 d.*,
															 e.*,
															 f.* 
															FROM pendaftar a 
															LEFT JOIN n_bing b ON a.psNISN=b.psNISN
															LEFT JOIN n_indo c ON a.psNISN=c.psNISN
															LEFT JOIN n_ipa d ON a.psNISN=d.psNISN
															LEFT JOIN n_ips e ON a.psNISN=e.psNISN
															LEFT JOIN n_mm f ON a.psNISN=f.psNISN
													WHERE a.psNISN='$_SESSION[atimNISN]'");
				$r=mysql_fetch_array($res);
				?>
				<table border='0' class='table'>
					<tr><td colspan='2'><strong>NISN : <?php echo $r[psNISN];?></strong></td></tr>
					<tr><td colspan='2'><strong>NAMA : <?php echo $r[psNama];?></strong></td></tr>
					<tr><td colspan='2'><strong> <u>DATA NILAI</u> </strong></td></tr>
					<tr>
						<td>
							<table border='1' class='table' width="90%">
								<tr>
									<th width='30px' rowspan='2'>No</th>
									<th width='300px' rowspan='2'>Mata Pelajaran</th>
									<th colspan='5'>Semester</th>
									<th width='200px' rowspan='2'>Nilai Rata-Rata</th>
								</tr>
								<tr>
									<th>1</th>
									<th>2</th>
									<th>3</th>
									<th>4</th>
									<th>5</th>
								</tr>
								<tr align='center'>
									<td>1</td>
									<td align='left'>Bahasa Indonesia</td>
									<td><?php echo $r[indo1];?></td>
									<td><?php echo $r[indo2];?></td>
									<td><?php echo $r[indo3];?></td>
									<td><?php echo $r[indo4];?></td>
									<td><?php echo $r[indo5];?></td>
									<td><?php echo $r[indoRata];?></td>
								</tr>
								<tr align='center'>
									<td>2</td>
									<td align='left'>Bahasa Inggris</td>
									<td><?php echo $r[bing1];?></td>
									<td><?php echo $r[bing2];?></td>
									<td><?php echo $r[bing3];?></td>
									<td><?php echo $r[bing4];?></td>
									<td><?php echo $r[bing5];?></td>
									<td><?php echo $r[bingRata];?></td>
								</tr>
								<tr align='center'>
									<td>3</td>
									<td align='left'>Matematika</td>
									<td><?php echo $r[mm1];?></td>
									<td><?php echo $r[mm2];?></td>
									<td><?php echo $r[mm3];?></td>
									<td><?php echo $r[mm4];?></td>
									<td><?php echo $r[mm5];?></td>
									<td><?php echo $r[mmRata];?></td>
								</tr>
								<tr align='center'>
									<td>4</td>
									<td align='left'>IPA (Ilmu Pengetahuan Alam)</td>
									<td><?php echo $r[ipa1];?></td>
									<td><?php echo $r[ipa2];?></td>
									<td><?php echo $r[ipa3];?></td>
									<td><?php echo $r[ipa4];?></td>
									<td><?php echo $r[ipa5];?></td>
									<td><?php echo $r[ipaRata];?></td>
								</tr>
								<tr align='center'>
									<td>5</td>
									<td align='left'>IPS (Ilmu Pengetahuan Sosial)</td>
									<td><?php echo $r[ips1];?></td>
									<td><?php echo $r[ips2];?></td>
									<td><?php echo $r[ips3];?></td>
									<td><?php echo $r[ips4];?></td>
									<td><?php echo $r[ips5];?></td>
									<td><?php echo $r[ipsRata];?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<br>
				<table border="0">
					<tr>
						<td width="100px" style="padding:2px 2px 2px 2px;" align="center">
							<div>
								Petugas<br>
								<br><br><br><br>

								<strong><?php echo $atimPetugas;?></strong>
							</div>
						</td>
						<td width="250px" style="padding:2px 2px 2px 2px;" align="center">
							<div>
								Pendaftar<br>
								<br><br><br><br>

								<strong><?php echo $r[psNama];?><br></strong><small>(tanda tangan dan nama ternag)</small>
							</div>
						</td>
					</tr>
				</table>
			</table>
		</table>
	</div>
<?php
}else{
	exit;
}
?>