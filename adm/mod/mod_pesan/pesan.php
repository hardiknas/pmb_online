<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="balas"){
	$e = mysql_fetch_array(mysql_query("SELECT * FROM pesan WHERE pId='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Balas Pesan</h2></div>
<div class="widget-body">
<div class="widget-main">
	
	<!-- FORM -->
	<?php
	if ($d[pBalas]==0){
	?>
		<form method="POST" action="mod/mod_pesan/aksi_pesan.php?act=balas" enctype="multipart/form-data" class="form-horizontal">	
	<?php
	}else{
	?>
		<form>
	<?php
	}
	?>
		<div class="control-group">
			<label class="control-label" for="nama">Nama Pengirim</label>
			<div class="controls">
				<input type="hidden" id="id" name="id" value="<?php echo $e[pId];?>">
				<input class="input-large" type="text" id="nama" name="nama" value="<?php echo $e[pNama];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input class="input-xlarge" type="email" id="email" name="email" value="<?php echo $e[pEmail];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tgl">Tanggal</label>
			<div class="controls">
				<input class="input-large" type="text" id="tgl" name="tgl" value="<?php echo tgl_indo($e[pTgl]);?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="subjek">Subjek</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="subjek" name="subjek" value="<?php echo 'Re : '.$e[pSubjek];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pesan">Isi Pesan</label>
			<div class="controls">
				<textarea name="pesan" style="margin:0px;width:50%;height:50px;" readonly><?php echo $e[pPesan];?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="jawab">Balas</label>
			<div class="controls">
				<textarea name="jawab" style="margin:0px;width:50%;height:100px;"><?php echo $e[pJawab];?></textarea>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="kirim">
				<i class="icon-envelope bigger-110"></i>Kirim
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
	?>
	<div class="table-header">
	    DATA PESAN MASUK
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th width="100px">Dari</th>
	    <th width="100px">Tanggal</th>
	    <th>Subjek</th>
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
	    $qry = mysql_query("SELECT * FROM pesan ORDER BY pBalas DESC");
		while ($d = mysql_fetch_array($qry)){
			if ($d[pBalas]==0){
				echo "<tr class='info'>";
			}else{
				echo "<tr>";
			}
	      $no++;
	      $tgl = tgl_indo($d[pTgl]);
	      echo "
	      <td class='center'>$no</td>
	      <td><strong>$d[pNama]</strong><br>($d[pEmail])</td>
	      <td>$tgl</td>
	      <td>$d[pSubjek]</td>";
	      if ($_SESSION[pmbLevel]=="1"){
	      echo "
	      <td>
	      	<div class='hidden-phone visible-desktop btn-group'>
            	<a href='?page=pesan&act=balas&id=$d[pId]' class='btn btn-mini btn-info'><i class='icon-envelope bigger-120'></i></a>
            	<a href='mod/mod_pesan/aksi_pesan.php?act=hapus&id=$d[pId]' onclick='return qh();' class='btn btn-mini btn-danger'><i class='icon-trash bigger-120'></i></a>
            </div>
            <div class='hidden-desktop visible-phone'>
                  <div class='inline position-relative'>
                    <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
                    <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                        <li>
                        	<a href='?page=pesan&act=balas&id=$d[pId]' class='tooltip-success' data-rel='tooltip' data-original-title='Balas'>
                           	<span class='blue'><i class='icon-envelope bigger-120'></i></span>
                           	</a>
                        </li>
                        <li>
                        	<a href='mod/mod_pesan/aksi_pesan.php?act=hapus&id=$d[pId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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