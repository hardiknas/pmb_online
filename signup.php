<?php
if (isset($_SESSION[atimNISN])){
	echo "<meta http-equiv=refresh content=\"0;url=akun\">";
	exit();
}
if(($_GET[act]=="save")&&(isset($_POST[daftar]))){

	$arrPesan = array(
		'0' => "<div class='alert alert-warning'>
					<button class='close' data-dismiss='alert'>&times;</button>
        			<strong>Maaf..!!</strong> Kode keamanan yang anda input tidak sesuai.
      		  </div>",
      '1' => "<div class='alert alert-success'>
        			<strong>Selamat anda telah terdaftar..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Gunakan NISN dan Password untuk melakukan login dan melengkapi biodata anda.
        			<br>
        			<a href='?pages=login'>Login</a>
      		  </div>",
      '2' => "<div class='alert alert-danger'>
        			<strong>Maaf Registrasi Gagal..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Mohon untuk melakukan registrasi kembali dengan memastikan data yang diinput secara benar.
      		  </div>"
	);


	if($_POST['captcha']==$_SESSION['captcha_session']){

		$nopeserta = getNoPeserta();
		$tgls = date("Y-m-d");

		$qp = mysql_query("INSERT INTO pendaftar (psNISN,psNoPeserta,psNama,psJK,
	                                             psTglDaftar,psNamaSekolah,psEmail,psPass,
	                                             psSt_Bio,psSt_Verifikasi,psSt_Seleksi,psSt_Akses)
	                                      VALUES('$_POST[nisn]','$nopeserta','$_POST[nama]','$_POST[jk]',
	                                             '$tgls','$_POST[namasekolah]','$_POST[email]','$_POST[pass]',
	                                             '0','0','0','1')");

	   $qmm = mysql_query("INSERT INTO n_mm (psNISN,mmStatus) VALUES ('$_POST[nisn]','0')");
	   $qba = mysql_query("INSERT INTO n_indo (psNISN,indoStatus) VALUES ('$_POST[nisn]','0')");
	   $qbi = mysql_query("INSERT INTO n_bing (psNISN,bingStatus) VALUES ('$_POST[nisn]','0')");
	   $qpa = mysql_query("INSERT INTO n_ipa (psNISN,ipaStatus) VALUES ('$_POST[nisn]','0')");
	   $qps = mysql_query("INSERT INTO n_ips (psNISN,ipsStatus) VALUES ('$_POST[nisn]','0')");

	   if ($qp && $qmm && $qba && $qbi && $qpa && $qps){
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
<form method="POST" action="saveregister" class="well form-horizontal">
	<h2 class="smaller">Registrasi</h2>
	<hr>
	<div class="control-group">
		<label class="control-label" for="nisn">NISN</label>
		<div class="controls">
			<input class="input-medium" type="text" id="nisn" name="nisn" onblur="cariNISN(this.value)" maxlength="10" required>
			<span class="help-inline" id="nisnhelp"></span>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
		<div class="controls">
			<input class="input-xlarge" type="text" id="nama" name="nama" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Jenis Kelamin</label>
		<div class="controls">
			<label class="radio">
				<input name="jk" type="radio" value="L" selected>
				<span class="lbl"> Laki-Laki</span>
			</label>
			<label class="radio">
				<input name="jk" type="radio" value="P">
				<span class="lbl"> Perempuan</span>
			</label>
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
	<div class="control-group">
		<label class="control-label" for="cap">Masukkan Kode Berikut</label>
		<div class="controls">
			<img src='captcha.php'><br><br>
			<input name="captcha" type="text" id="captcha" size="8" class="input-small" required>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-info" type="submit" name="daftar">
			<i class="icon-check icon-white bigger-110"></i> Daftar
		</button>
		<button class="btn" type="reset">
			<i class="icon-refresh bigger-110"></i> Batal
		</button>
	</div>
</form>
<!-- FORM -->

<script type="text/javascript" src="config/ajax.js"></script>
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