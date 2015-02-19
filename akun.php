<?php
if (empty($_SESSION[atimNISN])){
	echo "<meta http-equiv=refresh content=\"0;login\">";
	exit();
}
?>
<div id="about" class="row">
	<div class="span4">
	<center>
	<img src="images/biodata.png" width="150px" height="150px" class="thumbnail">
		<h4>Biodata</h4>
		<p class="sub">Silahkan Lengkapi Biodata Anda</p>
		<a href="biodata" class="btn-success btn btn-large">Biodata</a>
	</center>
	</div>			
	<div class="span4">
	<center>
	<img src="images/rapor.png" width="150px" height="150px" class="thumbnail">
		<h4>Nilai</h4>
		<p class="sub">Silahkan Lengkapi Nilai Rapor anda..!</p>
		<a href="nilai" class="btn-success btn btn-large">Data Nilai</a>
	</center>
	</div>
</div>
<hr>
<div id="about" class="row">
	<div class="span4">
	<center>
	<img src="images/cetak1.png" width="150px" height="150px" class="thumbnail">
		<h4>Cetak Biodata</h4>
		<p class="sub"></p>
		<a href="lapbio" target="_blank" class="btn-success btn btn-large">Cetak</a>
	</center>
	</div>			
	<div class="span4">
	<center>
	<img src="images/cetak2.png" width="150px" height="150px" class="thumbnail">
		<h4>Cetak Nilai</h4>
		<p class="sub"></p>
		<a href="lapnilai" target="_blank" class="btn-success btn btn-large">Cetak</a>
	</center>
	</div>
</div>