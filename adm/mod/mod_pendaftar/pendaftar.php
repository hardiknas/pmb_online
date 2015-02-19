<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
	$no_peserta = getNoPeserta();
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah Pendaftar</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" action="mod/mod_pendaftar/aksi_pendaftar.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="nisn">NISN</label>
			<div class="controls">
				<input class="input-medium" type="text" id="nisn" name="nisn" onblur="cariNISN(this.value)" maxlength="10" required>
				<span class="help-inline" id="nisnhelp"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="no_peserta">No Peserta</label>
			<div class="controls">
				<input class="input-medium" type="text" id="no_peserta" name="no_peserta" value="<?php echo $no_peserta;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="nama" name="nama" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Jenis Kelamin</label>
			<div class="controls">
				<label>
					<input name="jk" type="radio" class="ace" value="L" selected>
					<span class="lbl"> Laki-Laki</span>
				</label>
				<label>
					<input name="jk" type="radio" class="ace" value="P">
					<span class="lbl"> Perempuan</span>
				</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tgld">Tanggal Daftar</label>
			<div class="controls">
				<input class="span2 date-picker" id="tgld" name="tgld" type="text" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d');?>" required />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="namasekolah">Nama Sekolah</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="namasekolah" name="namasekolah" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input class="input-xlarge" type="email" id="email" name="email" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pass">Password</label>
			<div class="controls">
				<input class="input-medium" type="password" id="pass" name="pass" onblur="validPass(this.value)" maxlength="6" minlength="6" required>
				<span class="help-inline" id="passhelp"></span>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="simpan">
				<i class="icon-save bigger-110"></i>Simpan
			</button>
			<button class="btn" onclick="self.history.back();">
				<i class="icon-undo bigger-110"></i>Batal
			</button>
		</div>
	</form>
	<!-- FORM -->
</div>
</div>
</div>	
<?php
}else{
	if ($_SESSION[pmbLevel]=="1"){
?>
	<a href="?page=pendaftar&act=tambah" class="btn btn-primary">
					<i class="icon-download-alt bigger-100"></i>Registrasi Pendaftar
				</a><br><br>
	<?php
	}
	?>
	<div class="table-header">
	    DATA PENDAFTAR
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th width="80px">NISN</th>
	    <th class="hidden-phone" width="80px">No Peserta</th>
	    <th class="hidden-480" width="100px">Tanggal Daftar</th>
	    <th class="hidden-phone">Nama</th>
	    <th class="hidden-480">Asal Sekolah</th>
	    <th class="hidden-phone">Biodata</th>
	    <th class="hidden-phone">Nilai</th>
	    <th>Verifikasi</th>
	    <th>Seleksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	   
	   if (empty($_SESSION[pmbTahun])){
	 		$qPrefix = "WHERE YEAR(psTglDaftar)=YEAR(NOW())";
	 	}else{
	 		$qPrefix = "WHERE YEAR(psTglDaftar)='$_SESSION[pmbTahun]'";
	 	}

	   $pg = $_GET[page];

	   if ($pg=='pveri'){
	   	$qry = mysql_query("SELECT * FROM pendaftar $qPrefix AND psSt_Verifikasi='1'");
	   }elseif($pg=='plulus'){
	   	$qry = mysql_query("SELECT * FROM pendaftar $qPrefix AND psSt_Seleksi='1'");
	   }elseif($pg=='pnveri'){
	   	$qry = mysql_query("SELECT * FROM pendaftar $qPrefix AND psSt_Verifikasi='0'");
	   }elseif($pg=='pnlulus'){
	   	$qry = mysql_query("SELECT * FROM pendaftar $qPrefix AND psSt_Seleksi='0'");
	   }elseif($pg=='pendaftar'){
	   	$qry = mysql_query("SELECT * FROM pendaftar $qPrefix");
	   }


		while ($d = mysql_fetch_array($qry)){
	      
	      $no++;

	      $arrBio = array(
	      	'0' => "<a href='?page=bio&id=$d[psNISN]' class='btn btn-minier btn-danger'>Belum Lengkap</a>",
	      	'1' => "<a href='?page=bio&id=$d[psNISN]' class='btn btn-minier btn-success'>Lengkap</a>"
	      );

	      $arrNilai = array(
	      	'0' => "<a href='?page=nilai&id=$d[psNISN]' class='btn btn-minier btn-danger'>Belum Lengkap</a>",
	      	'1' => "<a href='?page=nilai&id=$d[psNISN]' class='btn btn-minier btn-success'>Lengkap</a>"
	      );

	      $arrVeri = array(
	      	'0' => "<a href='mod/mod_pendaftar/aksi_pendaftar.php?act=verifikasi&id=$d[psNISN]' class='btn btn-minier btn-danger'>Belum</a>",
	      	'1' => "<a href='mod/mod_pendaftar/aksi_pendaftar.php?act=nverifikasi&id=$d[psNISN]' class='btn btn-minier btn-success'>Sudah</a>"
	      );

	      $arrSeleksi = array(
	      	'0' => "<a href='mod/mod_pendaftar/aksi_pendaftar.php?act=l&id=$d[psNISN]' class='btn btn-minier btn-danger'>Tidak Lulus</a>",
	      	'1' => "<a href='mod/mod_pendaftar/aksi_pendaftar.php?act=tl&id=$d[psNISN]' class='btn btn-minier btn-success'>Lulus</a>"
	      );

	      $psBio = getStatusBio($d[psNISN]);
	      $psNilai = getStatusNilai($d[psNISN]);
	      $psVerivikasi = $d[psSt_Verifikasi];
	      $psSeleksi = $d[psSt_Seleksi];

	      $stBio = $arrBio[$psBio];
	      $stNilai = $arrNilai[$psNilai];

	      $stV = "<a class='btn btn-minier btn-danger'>Belum</a>";
	      $stL = "<a class='btn btn-minier btn-danger'>Tidak Lulus</a>";

	      if (($psBio=="1")&&($psNilai=="1")){
	      	$stV = $arrVeri[$psVerivikasi];
	      	$stL = $arrSeleksi[$psSeleksi];
	      }

	      $tgl = tgl_indo($d[psTglDaftar]);

	      echo "
	      <tr>
	      	<td class='center'>
	      		<div class='hidden-phone visible-desktop'>
		      		<a href='mod/mod_pendaftar/aksi_pendaftar.php?act=hapus&id=$d[psNISN]' onclick='return qh();' class='btn btn-minier btn-danger tooltip-error' data-rel='tooltip' data-original-title='Hapus'>
		      			$no
		      		</a>
		      	</div>
		      	<div class='hidden-desktop visible-phone'>
		      	<div class='inline position-relative'>
                    <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'>$no</button>
                    <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-left dropdown-caret dropdown-close'>
                        <li>
                        	<a href='?page=bio&id=$d[psNISN]' class='tooltip-info' data-rel='tooltip' data-original-title='Biodata'>
                           	<span class='blue'><i class='icon-edit bigger-120'></i></span>
                           </a>
                        </li>
                        <li>
                        	<a href='?page=nilai&id=$d[psNISN]' class='tooltip-info' data-rel='tooltip' data-original-title='Nilai'>
                           	<span class='blue'><i class='icon-bar-chart bigger-120'></i></span>
                           </a>
                        </li>
                        <li>
                        	<a href='mod/mod_pendaftar/aksi_pendaftar.php?act=hapus&id=$d[pId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Hapus'>
                           	<span class='blue'><i class='icon-trash bigger-120'></i></span>
                           </a>
                        </li>
                    </ul>
               </div>
               </div>
	      	</td>
		      <td class='center'>$d[psNISN]</td>		      
		      <td class='center hidden-phone'>$d[psNoPeserta]</td>
		      <td class='hidden-480'>$tgl</td>
		      <td class='hidden-phone'>$d[psNama]</td>
		      <td class='hidden-480'>$d[psNamaSekolah]</td>
		      <td class='hidden-phone center'>$stBio</td>
		      <td class='hidden-phone center'>$stNilai</td>
		      <td class='center'>$stV</td>
	      	<td class='center'>$stL</td>
	      </tr>";
	   }
	   ?>
	</tbody>
	</table>
	</div>
<?php
}
?>
</div>
</div>

<script type="text/javascript" src="../config/ajax.js"></script>
<script type="text/javascript">
	function cariNISN(x){
   	var url = "cekpendaftar.php?id=" + x;
   	ambilData(url, "nisnhelp");
	}
	function validPass(x){
		if (x.length!=6){
			var obj = document.getElementById("passhelp");
			obj.innerHTML = "<span class='label label-large label-warning'>Password harus 6 karakter..!!</span>";
			pass.focus();
		}else{
			obj.innerHTML = "";
		}
	}
</script>