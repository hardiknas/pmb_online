<?php
$e = mysql_fetch_array(mysql_query("SELECT a.psNISN,a.psNama,
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
													WHERE a.psNISN='$_SESSION[atimNISN]'"));
if ($e[psNISN]==""){
	echo "<script>window.location=('register')</script>";  
 	exit();
}
if(($_GET[act]=="save")&&(isset($_POST[simpan]))){

	$arrPesan = array(
      '1' => "<div class='alert alert-success'>
        			<strong>Nilai anda telah tersimpan..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
      		  </div>",
      '2' => "<div class='alert alert-danger'>
        			<strong>Nilai anda gagal tersimpan..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Mohon untuk melakukan inputan kembali dengan memastikan data yang diinput secara benar.
      		  </div>"
	);

	$nisn = $_SESSION[atimNISN];

	$bhs = $_POST[bhs];
	$rbhs = $_POST[rbhs];

	$ingg = $_POST[ingg];
	$ringg = $_POST[ringg];

	$mm = $_POST[mm];
	$rmm = $_POST[rmm];

	$ipa = $_POST[ipa];
	$ripa = $_POST[ripa];

	$ips = $_POST[ips];
	$rips = $_POST[rips];

	$q1 = mysql_query("UPDATE n_indo SET indo1='$bhs[0]',indo2='$bhs[1]',indo3='$bhs[2]',
													 indo4='$bhs[3]',indo5='$bhs[4]',indoRata='$rbhs',indoStatus='1'
												WHERE psNISN='$nisn'");

	$q2 = mysql_query("UPDATE n_bing SET bing1='$ingg[0]',bing2='$ingg[1]',bing3='$ingg[2]',
													 bing4='$ingg[3]',bing5='$ingg[4]',bingRata='$ringg',bingStatus='1'
												WHERE psNISN='$nisn'");

	$q3 = mysql_query("UPDATE n_mm SET mm1='$mm[0]',mm2='$mm[1]',mm3='$mm[2]',
												  mm4='$mm[3]',mm5='$mm[4]',mmRata='$rmm',mmStatus='1'
												WHERE psNISN='$nisn'");

	$q4 = mysql_query("UPDATE n_ipa SET ipa1='$ipa[0]',ipa2='$ipa[1]',ipa3='$ipa[2]',
												   ipa4='$ipa[3]',ipa5='$ipa[4]',ipaRata='$ripa',ipaStatus='1'
												WHERE psNISN='$nisn'");

	$q5 = mysql_query("UPDATE n_ips SET ips1='$ips[0]',ips2='$ips[1]',ips3='$ips[2]',
												   ips4='$ips[3]',ips5='$ips[4]',ipsRata='$rmm',ipsStatus='1'
												WHERE psNISN='$nisn'");

   if ($q1 && $q2 && $q3 && $q4 && $q5){
     echo "$arrPesan[1]";   
   }else{
     echo "$arrPesan[2]";
   }
}
?>

<?php
	$arrPesan1 = array(
      '1' => "<div class='alert alert-success'>
        			<strong>Nilai anda telah lengkap..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
      		  </div>",
      '0' => "<div class='alert alert-warning'>
        			<strong>Nilai anda belum lengkap..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Mohon untuk melengkapi data nilai untuk verifikasi..
      		  </div>"
    );
	$al = getStatusNilai($_SESSION[atimNISN]);
	$psBio = $arrPesan1[$al];
	echo "$psBio";
?>
<!-- FORM -->
<form method="POST" action="savenilai" class="well form-horizontal">
	<h2 class="smaller">
		Nama : <?php echo $e[psNama];?><br>
		NISN : <?php echo $e[psNISN];?>
	</h2>

	<hr><h4>Nilai</h4><hr>
	<input type="hidden" name="nisn" value="<?php echo $e[psNISN];?>">
	<div class="control-group">
		<label class="control-label" for="bhs">Bahasa Indonesia</label>
		<div class="controls">
			<input onblur="rata(this.name,'rbhs')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 1" 
			class="input-mini" type="text" id="bhs" name="bhs[]" value="<?php echo $e[indo1];?>" required> 
			<input onblur="rata(this.name,'rbhs')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 2" 
			class="input-mini" type="text" id="bhs" name="bhs[]" value="<?php echo $e[indo2];?>" required> 
			<input onblur="rata(this.name,'rbhs')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 3" 
			class="input-mini" type="text" id="bhs" name="bhs[]" value="<?php echo $e[indo3];?>" required> 
			<input onblur="rata(this.name,'rbhs')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 4" 
			class="input-mini" type="text" id="bhs" name="bhs[]" value="<?php echo $e[indo4];?>" required> 
			<input onblur="rata(this.name,'rbhs')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 5" 
			class="input-mini" type="text" id="bhs" name="bhs[]" value="<?php echo $e[indo5];?>" required> = 
			<input onblur="rata(this.name,'rbhs')" rel="tooltip" data-placement="top" data-original-title="Nilai Rata-Rata" 
			class="input-mini" type="text" id="rbhs" name="rbhs" value="<?php echo $e[indoRata];?>" readonly required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ingg">Bahasa Inggris</label>
		<div class="controls">
			<input onblur="rata(this.name,'ringg')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 1" 
			class="input-mini" type="text" id="ingg" name="ingg[]" value="<?php echo $e[bing1];?>" required> 
			<input onblur="rata(this.name,'ringg')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 2" 
			class="input-mini" type="text" id="ingg" name="ingg[]" value="<?php echo $e[bing2];?>" required> 
			<input onblur="rata(this.name,'ringg')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 3" 
			class="input-mini" type="text" id="ingg" name="ingg[]" value="<?php echo $e[bing3];?>" required> 
			<input onblur="rata(this.name,'ringg')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 4" 
			class="input-mini" type="text" id="ingg" name="ingg[]" value="<?php echo $e[bing4];?>" required> 
			<input onblur="rata(this.name,'ringg')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 5" 
			class="input-mini" type="text" id="ingg" name="ingg[]" value="<?php echo $e[bing5];?>" required> = 
			<input onblur="rata(this.name,'ringg')" rel="tooltip" data-placement="top" data-original-title="Nilai Rata-Rata" 
			class="input-mini" type="text" id="ringg" name="ringg" value="<?php echo $e[bingRata];?>" readonly required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="mm">Matematika</label>
		<div class="controls">
			<input onblur="rata(this.name,'rmm')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 1" 
			class="input-mini" type="text" id="mm" name="mm[]" value="<?php echo $e[mm1];?>" required> 
			<input onblur="rata(this.name,'rmm')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 2" 
			class="input-mini" type="text" id="mm" name="mm[]" value="<?php echo $e[mm2];?>" required> 
			<input onblur="rata(this.name,'rmm')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 3" 
			class="input-mini" type="text" id="mm" name="mm[]" value="<?php echo $e[mm3];?>" required> 
			<input onblur="rata(this.name,'rmm')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 4" 
			class="input-mini" type="text" id="mm" name="mm[]" value="<?php echo $e[mm4];?>" required> 
			<input onblur="rata(this.name,'rmm')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 5" 
			class="input-mini" type="text" id="mm" name="mm[]" value="<?php echo $e[mm5];?>" required> = 
			<input onblur="rata(this.name,'rmm')" rel="tooltip" data-placement="top" data-original-title="Nilai Rata-Rata" 
			class="input-mini" type="text" id="rmm" name="rmm" value="<?php echo $e[mmRata];?>" readonly required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ipa">IPA</label>
		<div class="controls">
			<input onblur="rata(this.name,'ripa')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 1" 
			class="input-mini" type="text" id="ipa" name="ipa[]" value="<?php echo $e[ipa1];?>" required> 
			<input onblur="rata(this.name,'ripa')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 2" 
			class="input-mini" type="text" id="ipa" name="ipa[]" value="<?php echo $e[ipa2];?>" required> 
			<input onblur="rata(this.name,'ripa')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 3" 
			class="input-mini" type="text" id="ipa" name="ipa[]" value="<?php echo $e[ipa3];?>" required> 
			<input onblur="rata(this.name,'ripa')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 4" 
			class="input-mini" type="text" id="ipa" name="ipa[]" value="<?php echo $e[ipa4];?>" required> 
			<input onblur="rata(this.name,'ripa')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 5" 
			class="input-mini" type="text" id="ipa" name="ipa[]" value="<?php echo $e[ipa5];?>" required> = 
			<input onblur="rata(this.name,'ripa')" rel="tooltip" data-placement="top" data-original-title="Nilai Rata-Rata" 
			class="input-mini" type="text" id="ripa" name="ripa" value="<?php echo $e[ipaRata];?>" readonly required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ips">IPS</label>
		<div class="controls">
			<input onblur="rata(this.name,'rips')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 1" 
			class="input-mini" type="text" id="ips" name="ips[]" value="<?php echo $e[ips1];?>" required> 
			<input onblur="rata(this.name,'rips')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 2" 
			class="input-mini" type="text" id="ips" name="ips[]" value="<?php echo $e[ips2];?>" required> 
			<input onblur="rata(this.name,'rips')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 3" 
			class="input-mini" type="text" id="ips" name="ips[]" value="<?php echo $e[ips3];?>" required> 
			<input onblur="rata(this.name,'rips')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 4" 
			class="input-mini" type="text" id="ips" name="ips[]" value="<?php echo $e[ips4];?>" required> 
			<input onblur="rata(this.name,'rips')" rel="tooltip" data-placement="top" data-original-title="Nilai Semseter 5" 
			class="input-mini" type="text" id="ips" name="ips[]" value="<?php echo $e[ips5];?>" required> = 
			<input onblur="rata(this.name,'rips')" rel="tooltip" data-placement="top" data-original-title="Nilai Rata-Rata" 
			class="input-mini" type="text" id="rips" name="rips" value="<?php echo $e[ipsRata];?>" readonly required>
		</div>
	</div>

	<div class="form-actions">
		<button class="btn btn-info" type="submit" name="simpan">
			<i class="icon-ok icon-white bigger-110"></i> Simpan
		</button>
		<a class="btn" href="akun">
			<i class="icon-hand-left bigger-110"></i> Kembali Ke Akun
		</a>
	</div>

</form>
<!-- FORM -->

<script type="text/javascript">
	function rata(x,y){
		var arr = document.getElementsByName(x);
		var tot=0;
		for(var i=0;i<arr.length;i++){
	  		if(parseFloat(arr[i].value))
	      	tot += parseFloat(arr[i].value);
		}
		var avg = parseFloat(tot/(arr.length));
		document.getElementById(y).value = avg;
	}
</script>