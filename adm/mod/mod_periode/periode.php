<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah Tahun Ajaran</h2></div>
<div class="widget-body">
<div class="widget-main">

	<!-- FORM -->
	<form method="POST" action="mod/mod_periode/aksi_periode.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="periode">Periode Tahun Ajaran</label>
			<div class="controls">
				<input class="input-medium" type="text" id="periode" name="periode" maxlength="9" placeholder="Ex : 2014/2015" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tahun">Tahun Pendaftaran</label>
			<div class="controls">
				<select class="span2" name="tahun">
					<?php
					$thns = date("Y");
					for ($thn=1990;$thn<=2050;$thn++){
						if ($thns==$thn){
							echo "<option value='$thn' selected>$thn</option>";
						}else{
							echo "<option value='$thn'>$thn</option>";
						}
					}
					?>
				</select>
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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM periode WHERE taId='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit Tahun Ajaran</h2></div>
<div class="widget-body">
<div class="widget-main">
	
	<!-- FORM -->
	<form method="POST" action="mod/mod_periode/aksi_periode.php?act=edit" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<input type="hidden" id="id" name="id" value="<?php echo $e[taId];?>">
				<input class="input-medium" type="text" id="periode" name="periode" maxlength="9" value="<?php echo $e[taPeriode];?>" placeholder="Ex : 2014/2015" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tahun">Tahun Pendaftaran</label>
			<div class="controls">
				<select class="span2" name="tahun">
					<?php
					$thns = date("Y");
					for ($thn=1990;$thn<=2050;$thn++){
						if($e[taTahun]==$thn){
							echo "<option value='$thn' selected>$thn</option>";
						}elseif ($thns==$thn){
							echo "<option value='$thn' selected>$thn</option>";
						}else{
							echo "<option value='$thn'>$thn</option>";
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="simpan">
				<i class="icon-save bigger-110"></i>Simpan
			</button>
			<button class="btn" type="reset">
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
	<a href="?page=periode&act=tambah" class="btn btn-primary">
					<i class="icon-download-alt bigger-100"></i>Tambah Periode
				</a><br><br>
	<?php
	}
	?>
	<div class="table-header">
	    MANAJEMEN PERIODE TAHUN AJARAN
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center">Periode Tahun Ajaran</th>
	    <th class="hidden-480 center">Tahun Pendaftaran</th>
	    <th class="hidden-480 center">Jumlah Pendaftar</th>
	    <th class="center">Status</th>
	    <?php
	    if ($_SESSION[pmbLevel]=="1"){
	    ?>
	    <th width="80px" class="center">Aksi</th>
	    <?php
		}
		?>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM periode ORDER BY taTahun DESC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php

	      $arSt = array(
	      	'0' => "<a href='mod/mod_periode/aksi_periode.php?act=aktif&id=$d[taId]' class='btn btn-minier btn-danger'><i class='icon-check-empty'></i></a>",
	      	'1' => "<a href='mod/mod_periode/aksi_periode.php?act=aktif&id=$d[taId]' class='btn btn-minier btn-success'><i class='icon-check'></i></a>"
	      );
	      
	      $ptA = $d[taAktif];
	      $stAktif = $arSt[$ptA];

	      $jPendaftar = getJumlah("pendaftar","WHERE YEAR(psTglDaftar)='$d[taTahun]'");

	      $no++;
	      $tgl = tgl_indo($d[iTgl]);
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'>$d[taPeriode]</td>
	      <td class='hidden-480 center'>$d[taTahun]</td>
	      <td class='hidden-480 center'>$jPendaftar</td>
	      <td class='center'>$stAktif</td>";
	      if ($_SESSION[pmbLevel]=="1"){
	      echo "
	      <td class='center'>
	      	<div class='hidden-phone visible-desktop btn-group'>
            	<a href='?page=periode&act=edit&id=$d[taId]' class='btn btn-mini btn-info'><i class='icon-edit bigger-120'></i></a>
            	<a href='mod/mod_periode/aksi_periode.php?act=hapus&id=$d[taId]' onclick='return qh();' class='btn btn-mini btn-danger'><i class='icon-trash bigger-120'></i></a>
            </div>
            <div class='hidden-desktop visible-phone'>
                  <div class='inline position-relative'>
                    <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
                    <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                        <li>
                        	<a href='?page=periode&act=edit&id=$d[taId]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                           	<span class='blue'><i class='icon-edit bigger-120'></i></span>
                           	</a>
                        </li>
                        <li>
                        	<a href='mod/mod_periode/aksi_periode.php?act=hapus&id=$d[taId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
                           	<span class='blue'><i class='icon-trash bigger-120'></i></span>
                           	</a>
                        </li>
                    </ul>
                  </div>
            </div>
	      </td>";
	  	  }
	      ?>
	     </tr>
	    <?php
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