<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah User</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" action="mod/mod_user/aksi_user.php?act=tambah" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" id="username" name="username" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp</label>
			<div class="controls">
				<input class="input-medium" type="text" id="telp" name="telp" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input class="input-xxlarge" type="email" id="email" name="email" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="level">Level</label>
			<div class="controls">
				<select name="level">
					<option value="2">Read</option>
					<option value="1">Read & Write</option>
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE uUname='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit User</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" action="mod/mod_user/aksi_user.php?act=edit" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" id="username" name="username" value="<?php echo $e[uUname];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[uNama];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp</label>
			<div class="controls">
				<input class="input-medium" type="text" id="telp" name="telp" value="<?php echo $e[uTelp];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input class="input-xxlarge" type="email" id="email" name="email" value="<?php echo $e[uEmail];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password">
				<span class="help-inline"> * Biarkan kosong jika password tak diubah</span>
			</div>
		</div>
		<div class="control-group">
      	<label class="control-label" for="level">Level</label>
      	<div class="controls">
        		<select name="level">
          	<?php
          	if ($e[uLevel]==2){
            	echo "<option value='2' selected>Read</option>
               	   <option value='1'>Read & Write</option>";
          	}else{
	            echo "<option value='2'>Read</option>
   	               <option value='1' selected>Read & Write</option>";
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
	<a href="?page=user&act=tambah" class="btn btn-primary">
					<i class="icon-download-alt bigger-100"></i>Tambah User
				</a><br><br>
	<?php
	}
	?>
	<div class="table-header">
	    DATA USER
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center">No</th>
	    <th>Nama</th>
	    <th class="hidden-480">Telp</th>
	    <th class="hidden-480">Email</th>
	    <th class="hidden-phone">Username</th>
	    <th class="hidden-phone">Akses</th>
	    <?php
	    if ($_SESSION[pmbLevel]=="1"){
	    ?>
	    <th>Aksi</th>
	    <?php
		}
		?>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM user");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $lvl = $d[uLevel];
	      $tp = array(
	      	'1'=>'Read & Write',
	      	'2'=>'Read');
	      $no++;
	      echo "
	      <td class='center'>$no</td>
	      <td>$d[uNama]</td>
	      <td class='hidden-480'>$d[uTelp]</td>
	      <td class='hidden-480'>$d[uEmail]</td>
	      <td class='hidden-phone'>$d[uUname]</td>
	      <td class='hidden-phone'>$tp[$lvl]</td>";
	      if ($_SESSION[pmbLevel]==1){
	      echo "	      
	      <td>
	      	<div class='hidden-phone visible-desktop btn-group'>
            	<a href='?page=user&act=edit&id=$d[uUname]' class='btn btn-mini btn-info'><i class='icon-edit bigger-120'></i></a>
            	<a href='mod/mod_user/aksi_user.php?act=hapus&id=$d[uUname]' onclick='return qh();' class='btn btn-mini btn-danger'><i class='icon-trash bigger-120'></i></a>
            </div>
            <div class='hidden-desktop visible-phone'>
                  <div class='inline position-relative'>
                    <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
                    <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                        <li>
                        	<a href='?page=user&act=edit&id=$d[uUname]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                           	<span class='blue'><i class='icon-edit bigger-120'></i></span>
                           	</a>
                        </li>
                        <li>
                        	<a href='mod/mod_user/aksi_user.php?act=hapus&id=$d[uUname]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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