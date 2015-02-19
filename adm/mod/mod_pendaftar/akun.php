<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="upass"){
	$e = mysql_fetch_array(mysql_query("SELECT psNISN FROM pendaftar WHERE psNISN='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Ubah Password</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" action="mod/mod_pendaftar/aksi_akun.php?act=upass" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="nisn">NISN</label>
			<div class="controls">
				<input class="input span2" type="text" id="nisn" name="nisn" value="<?php echo $e[psNISN];?>" placeholder="NISN" maxlength="10" readonly required>
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
?>
	<div class="table-header">
	    DATA AKUN PENDAFTAR
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th width="80px">NISN</th>
	    <th>Nama</th>
	    <th class="hidden-480" width="200px">Nama Sekolah</th>
	    <th class="hidden-480" width="100px">Tanggal Daftar</th>
	    <th class="center" width="80px">Password</th>
	    <th class="center" width="80px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	if (empty($_SESSION[pmbTahun])){
	 		$qPrefix = "WHERE YEAR(psTglDaftar)=YEAR(NOW())";
	 	}else{
	 		$qPrefix = "WHERE YEAR(psTglDaftar)='$_SESSION[pmbTahun]'";
	 	}

	   $qry = mysql_query("SELECT * FROM pendaftar $qPrefix");
		while ($d = mysql_fetch_array($qry)){

			$arrAkses = array(
	      	'0' => "<a href='mod/mod_pendaftar/aksi_akun.php?act=unblok&id=$d[psNISN]' class='btn btn-minier btn-danger'><i class='icon-lock'></i></a>",
	      	'1' => "<a href='mod/mod_pendaftar/aksi_akun.php?act=blok&id=$d[psNISN]' class='btn btn-minier btn-success'><i class='icon-unlock'></i></a>"
	      );

			$psAkses = $d[psSt_Akses];
			$stAkses = $arrAkses[$psAkses];
	      $tgl = tgl_indo($d[psTglDaftar]);
	      $no++;
	      echo "
	      <tr>
	      	<td class='center'>$no</td>
		      <td class='center'>$d[psNISN]</td>		      
		      <td>$d[psNama]</td>
		      <td class='hidden-480'>$d[psNamaSekolah]</td>
		      <td class='hidden-480'>$tgl</td>
		      <td class='center'><a href='?page=akun&act=upass&id=$d[psNISN]'>$d[psPass]</a></td>
	      	<td class='center'>$stAkses</td>
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

<script type="text/javascript">
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