<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah Info</h2></div>
<div class="widget-body">
<div class="widget-main">

	<!-- FORM -->
	<form method="POST" action="mod/mod_info/aksi_info.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="judul" name="judul" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="isi">Isi Info</label>
			<div class="controls">
				<textarea name="isi" style="width:80%;height:150px;"></textarea>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM info WHERE iId='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit Info</h2></div>
<div class="widget-body">
<div class="widget-main">
	
	<!-- FORM -->
	<form method="POST" action="mod/mod_info/aksi_info.php?act=edit" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<input type="hidden" id="id" name="id" value="<?php echo $e[iId];?>">
				<input class="input-xxlarge" type="text" id="judul" name="judul" value="<?php echo $e[iJudul];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="isi">Isi Info</label>
			<div class="controls">
				<textarea name="isi" style="width:80%;height:150px;"><?php echo $e[iIsi];?></textarea>
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
	<a href="?page=info&act=tambah" class="btn btn-primary">
					<i class="icon-download-alt bigger-100"></i>Tambah Info
				</a><br><br>
	<?php
	}
	?>
	<div class="table-header">
	    DATA INFO PENGUMUMAN
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th width="80px">Tanggal</th>
	    <th class="hidden-480">Info</th>
	    <?php
	    if ($_SESSION[pmbLevel]=="1"){
	    ?>
	    <th width="80px">Aksi</th>
	    <?php
		}
		?>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM info");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      $tgl = tgl_indo($d[iTgl]);
	      echo "
	      <td class='center'>$no</td>
	      <td>$tgl</td>
	      <td class='hidden-480'>
	      	<strong>$d[iJudul]</strong><br>
	      	$d[iIsi]
	      </td>";
	      if ($_SESSION[pmbLevel]=="1"){
	      echo "
	      <td>
	      	<div class='hidden-phone visible-desktop btn-group'>
            	<a href='?page=info&act=edit&id=$d[iId]' class='btn btn-mini btn-info'><i class='icon-edit bigger-120'></i></a>
            	<a href='mod/mod_info/aksi_info.php?act=hapus&id=$d[iId]' onclick='return qh();' class='btn btn-mini btn-danger'><i class='icon-trash bigger-120'></i></a>
            </div>
            <div class='hidden-desktop visible-phone'>
                  <div class='inline position-relative'>
                    <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
                    <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                        <li>
                        	<a href='?page=info&act=edit&id=$d[iId]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                           	<span class='blue'><i class='icon-edit bigger-120'></i></span>
                           	</a>
                        </li>
                        <li>
                        	<a href='mod/mod_info/aksi_info.php?act=hapus&id=$d[iId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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