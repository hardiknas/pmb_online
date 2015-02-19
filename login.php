<?php
if (isset($_SESSION[atimNISN])){
	echo "<meta http-equiv=refresh content=\"0;akun\">";
	exit();
}
?>
<!-- FORM -->
<form method="POST" action="cek_login.php" class="well form-horizontal">
	<h2 class="smaller">Login</h2>
	<hr>
	<div class="control-group">
		<label class="control-label" for="nisn">NISN</label>
		<div class="controls">
			<input class="input-medium" type="text" id="nisn" name="nisn" maxlength="10" required>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="pass">Password</label>
		<div class="controls">
			<input class="input-medium" type="password" id="pass" name="pass" maxlength="6" minlength="6" required>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-info" type="submit" name="login">
			<i class="icon-share icon-white bigger-110"></i> Login
		</button>
	</div>
</form>
<!-- FORM -->