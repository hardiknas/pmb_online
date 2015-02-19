<?php
$e = mysql_fetch_array(mysql_query("SELECT * FROM pendaftar WHERE psNISN='$_SESSION[atimNISN]'"));
if ($e[psNISN]==""){
	echo "<script>window.location=('register')</script>";  
 	exit();
}
if(($_GET[act]=="save")&&(isset($_POST[simpan]))){

	$arrPesan = array(
      '1' => "<div class='alert alert-success'>
        			<strong>Biodata anda telah tersimpan..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
      		  </div>",
      '2' => "<div class='alert alert-danger'>
        			<strong>Biodata anda gagal tersimpan..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Mohon untuk melakukan inputan kembali dengan memastikan data yang diinput secara benar.
      		  </div>"
	);

	$qbio = mysql_query("UPDATE pendaftar SET
								psNama='$_POST[nama]',
								psT4Lahir='$_POST[t4l]',
								psTglahir='$_POST[tgll]',
								psJK='$_POST[jk]',
								psAlamat='$_POST[alamat]',
								psTelp='$_POST[telp]',
								psEmail='$_POST[email]',
								psAgama='$_POST[agama]',
								psGDarah='$_POST[goldarah]',
								psPendidikan='$_POST[pendidikan]',
								psJurusan='$_POST[jurusan]',
								psTahunLulus='$_POST[tahunlulus]',
								psNamaSekolah='$_POST[namasekolah]',
								psAlamatSekolah='$_POST[alamatsekolah]',
								psTelpSekolah='$_POST[telpsekolah]',
								psNamaOT='$_POST[namaot]',
								psPekerjaanOT='$_POST[pekerjaanot]',
								psAlamatOT='$_POST[alamatot]',
								psTelpOT='$_POST[telpot]',
								psPil1='$_POST[pil1]',
								psPil2='$_POST[pil2]',
								psKeinginanMasuk='$_POST[keinginan]',
								psJalurPenerimaan='$_POST[jalur]',
								psUkuranJas='$_POST[ukuranjas]',
								psInfoATIM='$_POST[info]',
								psSt_Bio='1'
								WHERE psNISN='$_SESSION[atimNISN]'");

   if ($qbio){
     echo "$arrPesan[1]";   
   }else{
     echo "$arrPesan[2]";
   }
}
?>

<?php
	$arrPesan1 = array(
      '1' => "<div class='alert alert-success'>
        			<strong>Biodata anda telah lengkap..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
      		  </div>",
      '0' => "<div class='alert alert-warning'>
        			<strong>Biodata anda belum lengkap..!!</strong> 
        			<button class='close' data-dismiss='alert'>&times;</button>
        			Mohon untuk melengkapi biodata untuk verifikasi..
      		  </div>"
    );
	$al = $e[psSt_Bio];
	$psBio = $arrPesan1[$al];
	echo "$psBio";
?>
<!-- FORM -->
<form method="POST" action="savebiodata" class="well form-horizontal">
	<h2 class="smaller">Biodata</h2>
	<hr><h4>A. Data Calon Mahasiswa</h4><hr>

	<div class="control-group">
		<label class="control-label" for="nisn">NISN - No.Peserta</label>
		<div class="controls">
			<input class="input-small" type="text" id="nisn" name="nisn" value="<?php echo $e[psNISN];?>" placeholder="NISN" maxlength="10" readonly required>
			- <input class="input-small" type="text" id="no_peserta" name="no_peserta" value="<?php echo $e[psNoPeserta];?>" readonly required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nama">Nama</label>
		<div class="controls">
			<input class="input span4" type="text" id="nama" name="nama" value="<?php echo $e[psNama];?>" placeholder="Nama" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="t4l">Tempat Lahir</label>
		<div class="controls">
			<input class="input span3" type="text" id="t4l" name="t4l" value="<?php echo $e[psT4Lahir];?>" placeholder="Tempat Lahir" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tgll">Tanggal Lahir</label>
		<div class="controls">
			<input class="input-small date-picker" id="tgll" name="tgll" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" value="<?php echo $e[psTglahir];?>" required />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="jk">Jenis Kelamin</label>
		<div class="controls">
			<select class="input-medium" name="jk" id="jk">
				<?php
					if ($e[psJK]=="L"){
						echo "<option value='L' selected>Laki-Laki</option>
								<option value='P'>Perempuan</option>";
					}else{
						echo "<option value='P' selected>Perempuan</option>
								<option value='L'>Laki-Laki</option>";
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="alamat">Alamat</label>
		<div class="controls">
			<input class="input span5" type="text" id="alamat" name="alamat" value="<?php echo $e[psAlamat];?>" placeholder="Alamat" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="telp">No. Telp/HP</label>
		<div class="controls">
			<input class="input span2" type="text" id="telp" name="telp" value="<?php echo $e[psTelp];?>" placeholder="No. Telp/HP" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="email">Email</label>
		<div class="controls">
			<input class="input span3" type="email" id="email" name="email" value="<?php echo $e[psEmail];?>" placeholder="Email" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="agama">Agama</label>
		<div class="controls">
			<select class="input-medium" name="agama" id="agama">
				<?php
					$arAgama = array(
						'Islam' => "Islam",
						'Protestan' => "Protestan",
						'Katolik' => "Katolik",
						'Budha' => "Budha",
						'Hindu' => "Hindu"
					);
					foreach ($arAgama as $db => $isi) {
						if ($e[psAgama]==$db){
							echo "<option value='$db' selected>$isi</option>";
						}else{
							echo "<option value='$db'>$isi</option>";
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="goldarah">Golongan Darah</label>
		<div class="controls">
			<select class="input-mini" name="goldarah" id="goldarah">
				<?php
					$arGD = array(
						'A' => "A",
						'B' => "B",
						'O' => "O",
						'AB' => "AB"
					);
					foreach ($arGD as $db => $isi) {
						if ($e[psGDarah]==$db){
							echo "<option value='$db' selected>$isi</option>";
						}else{
							echo "<option value='$db'>$isi</option>";
						}
					}
				?>
			</select>
		</div>
	</div>

	<hr><h4>B. Data Pendidikan dan Asal Sekolah</h4><hr>

	<div class="control-group">
		<label class="control-label" for="pendidikan">Pendidikan</label>
		<div class="controls">
			<input class="input span2" type="text" id="pendidikan" name="pendidikan" value="<?php echo $e[psPendidikan];?>" placeholder="Ex : SMA / MA / SMK" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="jurusan">Jurusan</label>
		<div class="controls">
			<input class="input span4" type="text" id="jurusan" name="jurusan" value="<?php echo $e[psJurusan];?>" placeholder="Ex : IPA / IPS / BAHASA" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="tahunlulus">Tahun Lulus</label>
		<div class="controls">
			<select class="input-mini" name="tahunlulus" id="tahunlulus">
				<?php
					$ds = date("Y");
					for ($thn=1990;$thn<=2050;$thn++){
						if ($e[psTahunLulus]==$thn){
							echo "<option value='$thn' selected>$thn</option>";
						}if ($ds==$thn){
							echo "<option value='$thn' selected>$thn</option>";
						}else{
							echo "<option value='$thn'>$thn</option>";
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="namasekolah">Nama Sekolah</label>
		<div class="controls">
			<input class="input span4" type="text" id="namasekolah" name="namasekolah" value="<?php echo $e[psNamaSekolah];?>" placeholder="Nama Sekolah" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="alamatsekolah">Alamat Sekolah</label>
		<div class="controls">
			<input class="input span5" type="text" id="alamatsekolah" name="alamatsekolah" value="<?php echo $e[psAlamatSekolah];?>" placeholder="Alamat Sekolah" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="telpsekolah">No. Telp Sekolah</label>
		<div class="controls">
			<input class="input span2" type="text" id="telpsekolah" name="telpsekolah" value="<?php echo $e[psTelpSekolah];?>" placeholder="No. Telp Sekolah" required>
		</div>
	</div>

	<hr><h4>C. Data Orang Tua</h4><hr>

	<div class="control-group">
		<label class="control-label" for="namaot">Nama Orang Tua</label>
		<div class="controls">
			<input class="input span4" type="text" id="namaot" name="namaot" value="<?php echo $e[psNamaOT];?>" placeholder="Nama Orang Tua/Wali" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pekerjaanot">Pekerjaan Orang Tua</label>
		<div class="controls">
			<input class="input span3" type="text" id="pekerjaanot" name="pekerjaanot" value="<?php echo $e[psPekerjaanOT];?>" placeholder="Pekerjaan Orang Tua/Wali" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="alamatot">Alamat Orang Tua</label>
		<div class="controls">
			<input class="input span5" type="text" id="alamatot" name="alamatot" value="<?php echo $e[psAlamatOT];?>" placeholder="Alamat Orang Tua/Wali" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="telpot">No. Telp Orang Tua</label>
		<div class="controls">
			<input class="input span2" type="text" id="telpot" name="telpot" value="<?php echo $e[psTelpOT];?>" placeholder="Telp Orang Tua" required>
		</div>
	</div>
	
	<hr><h4>D. PILIHAN JURUSAN/PROGRAM STUDI YANG DIINGINKAN</h4><hr>

	<div class="control-group">
		<label class="control-label" for="pil1">Pilihan 1</label>
		<div class="controls">
			<select class="span3" name="pil1" id="pil1">
				<?php
					$qp = mysql_query("SELECT * FROM ms_prodi");
					while($pr=mysql_fetch_array($qp)){
						if ($e[psPil1]==$pr[prId]){
							echo "<option value='$pr[prId]' selected>$pr[prNama]</option>";
						}else{
							echo "<option value='$pr[prId]'>$pr[prNama]</option>";
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pil2">Pilihan 2</label>
		<div class="controls">
			<select class="span3" name="pil2" id="pil2">
				<?php
					$qp = mysql_query("SELECT * FROM ms_prodi");
					while($pr=mysql_fetch_array($qp)){
						if ($e[psPil2]==$pr[prId]){
							echo "<option value='$pr[prId]' selected>$pr[prNama]</option>";
						}else{
							echo "<option value='$pr[prId]'>$pr[prNama]</option>";
						}
					}
				?>
			</select>
		</div>
	</div>

	<hr><h4>D. LAIN-LAIN</h4><hr>

	<div class="control-group">
		<label class="control-label" for="keinginan">Keinginan Mengikuti Pendidikan di ATIM</label>
		<div class="controls">
			<select class="span2" name="keinginan" id="keinginan">
				<?php
					$arIngin = array(
						'A' => "Sangat Minat Sekali",
						'B' => "Sangat Minat",
						'C' => "Minat",
						'D' => "Kurang Minat"
					);
					foreach ($arIngin as $db => $isi) {
						if ($e[psKeinginanMasuk]==$db){
							echo "<option value='$db' selected>$isi</option>";
						}else{
							echo "<option value='$db'>$isi</option>";
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="jalur">Jalur Penerimaan</label>
		<div class="controls">
			<select class="span2" name="jalur" id="jalur">
				<?php
					$arJalur = array(
						'A' => "Tes",
						'B' => "Bebas Tes/Rekomendasi"
					);
					foreach ($arJalur as $db => $isi) {
						if ($e[psJalurPenerimaan]==$db){
							echo "<option value='$db' selected>$isi</option>";
						}else{
							echo "<option value='$db'>$isi</option>";
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ukuranjas">Ukuran Jas</label>
		<div class="controls">
			<select class="input-mini" name="ukuranjas" id="ukuranjas">
				<?php
					$arJas = array(
						'XL' => "XL",
						'L' => "L",
						'M' => "M",
						'S' => "S"
					);
					foreach ($arJas as $db => $isi) {
						if ($e[psUkuranJas]==$db){
							echo "<option value='$db' selected>$isi</option>";
						}else{
							echo "<option value='$db'>$isi</option>";
						}
					}
				?>
			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="info">Info ATIM diperoleh dari</label>
		<div class="controls">
			<input class="input span5" type="text" id="info" name="info" value="<?php echo $e[psInfoATIM];?>" placeholder="Informasi ATIM diperoleh dari" required>
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