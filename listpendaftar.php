<table id="Tb14" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th width="80px">NISN</th>
	    <th class="hidden-phone" width="80px">No Peserta</th>
	    <th class="hidden-480" width="100px">Tanggal Daftar</th>
	    <th>Nama</th>
	    <th class="hidden-480">Asal Sekolah</th>
	    <th>Verifikasi</th>
	    </tr>
	</thead>
	<tbody>
		<?php
			if (empty($_SESSION[atimTahun])){
	 			$qPrefix = "WHERE YEAR(psTglDaftar)=YEAR(NOW())";
	 		}else{
	 			$qPrefix = "WHERE YEAR(psTglDaftar)='$_SESSION[atimTahun]'";
	 		}

			$res = mysql_query ("SELECT * FROM pendaftar $qPrefix ORDER BY psTglDaftar DESC");
	 		while($items=mysql_fetch_array($res)){
	 			$no++;
				$arrVeri = array(
	      		'0' => "<span class='label label-warning'>Belum</span>",
	      		'1' => "<span class='label label-success'>Sudah</span>"
	      	);
	   		$psVerivikasi = $items[psSt_Verifikasi];
	   		$stV = $arrVeri[$psVerivikasi];
	   		$tgl = tgl_indo($items[psTglDaftar]);
				echo "<tr>
							<td>$no</td>
							<td>$items[psNISN]</td>
							<td class='hidden-phone'>$items[psNoPeserta]</td>
							<td class='hidden-480'>$tgl</td>
							<td>$items[psNama]</td>
							<td class='hidden-480'>$items[psNamaSekolah]</td>
							<td>$stV</td>
					 </tr>";
	 		} 
			?>
		</tbody>
</table>