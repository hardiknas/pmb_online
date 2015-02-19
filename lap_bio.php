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
				echo "<h3><u>FORMULIR PENDAFTARAN</u></h3>";

				$res=mysql_query("SELECT a.*,b.prNama AS pil1, c.prNama AS pil2 FROM pendaftar a 
					LEFT JOIN ms_prodi b ON a.psPil1=b.prId
					LEFT JOIN ms_prodi c ON a.psPil2=c.prId
					WHERE a.psNISN='$_SESSION[atimNISN]'");
				$r=mysql_fetch_array($res);

				$arIngin = array(
					'A' => "Sangat Minat Sekali",
					'B' => "Sangat Minat",
					'C' => "Minat",
					'D' => "Kurang Minat"
					);
				$xxx = $r[psKeinginanMasuk];
				$kMasuk = $arIngin[$xxx];

				$arJalur = array(
					'A' => "Tes",
					'B' => "Bebas Tes/Rekomendasi"
					);
				$xxx = $r[psJalurPenerimaan];
				$jMasuk = $arJalur[$xxx];

				$arJas = array(
					'XL' => "XL",
					'L' => "L",
					'M' => "M",
					'S' => "S"
					);
				$xxx = $r[psUkuranJas];
				$uJas = $arJas[$xxx];
				?>
				<table border='1' class='table'>
					<tr><td colspan='2'><strong> A. DATA CALON MAHASISWA</strong></td></tr>
					<tr>
						<td>
							<table>
								<tr>
									<td width='200px'>1. NISN</td>
									<td>: <?php echo $r[psNISN];?></td>
								</tr>
								<tr>
									<td width='200px'>2. Nama Lengkap</td>
									<td>: <?php echo $r[psNama];?></td>
								</tr>
								<tr>
									<td width='200px'>3. Tempat, Tgl Lahir</td>
									<td>: <?php echo $r[psT4Lahir].", ".tgl_indo($r[psTglahir]);?></td>
								</tr>
								<tr>
									<td width='200px'>4. Jenis Kelamin</td>
									<td>: <?php echo $r[psJK];?></td>
								</tr>
								<tr>
									<td width='200px'>5. Agama</td>
									<td>: <?php echo $r[psAgama];?></td>
								</tr>
								<tr>
									<td width='200px'>6. Alamat</td>
									<td>: <?php echo $r[psAlamat];?></td>
								</tr>
								<tr>
									<td width='200px'>7. No.Telp/HP</td>
									<td>: <?php echo $r[psTelp];?></td>
								</tr>
								<tr>
									<td width='200px'>8. Pendidikan</td>
									<td>: <?php echo $r[psPendidikan];?></td>
								</tr>
								<tr>
									<td width='200px'>9. Jurusan</td>
									<td>: <?php echo $r[psJurusan];?></td>
								</tr>
								<tr>
									<td width='200px'>10. Tahun Kelulusan</td>
									<td>: <?php echo $r[psTahunLulus];?></td>
								</tr>
								<tr>
									<td width='200px'>11. Asal Sekolah</td>
									<td>: <?php echo $r[psNamaSekolah];?></td>
								</tr>
								<tr>
									<td width='200px'>12. Alamat Sekolah</td>
									<td>: <?php echo $r[psAlamatSekolah];?></td>
								</tr>
								<tr>
									<td width='200px'>13. Telp Sekolah</td>
									<td>: <?php echo $r[psTelpSekolah];?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td colspan='2'><strong> B. DATA ORANG TUA</strong></td></tr>
					<tr>
						<td>
							<table>
								<tr>
									<td width='200px'>1. Nama</td>
									<td>: <?php echo $r[psNamaOT];?></td>
								</tr>
								<tr>
									<td width='200px'>2. Pekerjaan</td>
									<td>: <?php echo $r[psPekerjaanOT];?></td>
								</tr>
								<tr>
									<td width='200px'>3. Alamat</td>
									<td>: <?php echo $r[psAlamatOT];?></td>
								</tr>
								<tr>
									<td width='200px'>4. Telp</td>
									<td>: <?php echo $r[psTelpOT];?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td colspan='2'><strong> C. PILIHAN JURUSAN / PROGRAM STUDI YANG DIINGINKAN</strong></td></tr>
					<tr>
						<td>
							<table>
								<tr>
									<td width='200px'>1. Pilihan 1</td>
									<td>: <?php echo $r[pil1];?></td>
								</tr>
								<tr>
									<td width='200px'>2. Pilihan 2</td>
									<td>: <?php echo $r[pil2];?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td colspan='2'><strong> D. LAIN - LAIN</strong></td></tr>
					<tr>
						<td>
							<table>
								<tr>
									<td width='500px'>1. Keinginan untuk mengikuti pendidikan di ATIM</td>
									<td>: <?php echo $kMasuk;?></td>
								</tr>
								<tr>
									<td width='500px'>2. Jalur Penerimaan</td>
									<td>: <?php echo $jMasuk;?></td>
								</tr>
								<tr>
									<td width='500px'>3. Ukuran Jas</td>
									<td>: <?php echo $uJas;?></td>
								</tr>
								<tr>
									<td width='500px'>4. Info ATIM diperoleh dari</td>
									<td>: <?php echo $r[psInfoATIM];?></td>
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