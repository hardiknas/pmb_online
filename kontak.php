<?php
if(($_GET[act]=="kirim")&&(isset($_POST[kirim]))){

	$arrPesan = array(
		'0' => "<div class='alert alert-warning'>
					<button class='close' data-dismiss='alert'>&times;</button>
        			<strong>Maaf..!!</strong> Kode keamanan yang anda input tidak sesuai.
      		  </div>",
      '1' => "<div class='alert alert-success'>
        			<strong>Pesan anda telah terkirim..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
      		  </div>",
      '2' => "<div class='alert alert-danger'>
        			<strong>Maaf Pesan anda Gagal dikirim..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Mohon untuk melakukan inputan kembali dengan memastikan data yang diinput secara benar.
      		  </div>"
	);


	if($_POST['captcha']==$_SESSION['captcha_session']){

		$tgls = date("Y-m-d");

		$qp = mysql_query("INSERT INTO pesan (pNama,pEmail,pSubjek,pPesan,pTgl)
	                                      VALUES('$_POST[nama]','$_POST[email]','$_POST[subjek]','$_POST[pesan]','$tgls')");

	   if ($qp){
	     echo "$arrPesan[1]";   
	   }else{
	     echo "$arrPesan[2]";
	   }
	}else{
      echo "$arrPesan[0]";
   }
}
?>

<!-- FORM -->
<form method="POST" action="kirimpesan" class="well form-horizontal">
	<h2 class="smaller">Hubungi Kami</h2>
	<hr>
	<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
		<div class="controls">
			<input class="input-large" type="text" id="nama" name="nama" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input class="input-xlarge" type="email" id="email" name="email" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="subjek">Subjek</label>
		<div class="controls">
			<input class="input-xlarge" type="text" id="subjek" name="subjek" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pesan">Pesan</label>
		<div class="controls">
			<textarea name="pesan" style="margin:0px;width:70%;height:60px;"><?php echo $e[pPesan];?></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="cap">Masukkan Kode Berikut</label>
		<div class="controls">
			<img src='captcha.php'><br><br>
			<input name="captcha" type="text" id="captcha" size="8" class="input-small" required>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-info" type="submit" name="kirim">
			<i class="icon-check icon-white bigger-110"></i> Kirim
		</button>
		<button class="btn" type="reset">
			<i class="icon-refresh bigger-110"></i> Batal
		</button>
	</div>
</form>
<!-- FORM -->