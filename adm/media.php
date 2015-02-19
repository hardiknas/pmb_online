<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");

include "../config/fungsi_indotgl.php";
include "../config/koneksi.php";
include "../config/fungsiku.php";
if (!$_SESSION[pmbId]){
echo "<meta http-equiv=refresh content=\"0;url=index.php\">";
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title>Administrator PMB - Akademik Teknik Industri Makassar</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/chosen.css" />
		<link rel="stylesheet" href="assets/css/datepicker.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="../../../../fonts.googleapis.com/css5c0a.css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->

		<!--ace settings handler-->

		<script src="assets/js/ace-extra.min.js"></script>
	</head>

	<body>
		<div class="navbar" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-inner">
				<div class="container-fluid">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a href="#">
								<img src="../images/logo.png">
							</a>
						</li>
					</ul><!--/.ace-nav-->
					
					<a href="#" class="brand">
						<small>
							Administrator PMB - Akademik Teknik Industri Makassar
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						<?php
						if(!empty($_SESSION[pmbId])){
						?>
							<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../images/user.png" alt="<?php echo $_SESSION[pmbNama];?>">
								<span class="user-info">
									<small>Selamat Datang,</small><?php echo $_SESSION[pmbNama];?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
								<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
								</ul>
							</li>
						<?php
						}
						?>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->

		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<ul class="nav nav-list">

					<li class="active"><a href="?page=home"><i class="icon-home"></i><span class="menu-text">Beranda</span></a></li>
					<div class="sidebar-collapse" id=""></div>

					<li><a href="#" class="dropdown-toggle"><i class="icon-group"></i><span class="menu-text">Data Pendaftar</span><b class="arrow icon-angle-down"></b></a>
						<ul class="submenu" style="display: none;">
							<?php
								if (empty($_SESSION[pmbTahun])){
							 		$qPrefix = "WHERE YEAR(psTglDaftar)=YEAR(NOW())";
							 	}else{
							 		$qPrefix = "WHERE YEAR(psTglDaftar)='$_SESSION[pmbTahun]'";
							 	}
								$jAll = getJumlah("pendaftar","$qPrefix AND 1");
								$jVeri = getJumlah("pendaftar","$qPrefix AND psSt_Verifikasi='1'");
								$jBVeri = getJumlah("pendaftar","$qPrefix AND psSt_Verifikasi='0'");
								$jLulus = getJumlah("pendaftar","$qPrefix AND psSt_Seleksi='1'");
								$jNLulus = getJumlah("pendaftar","$qPrefix AND psSt_Seleksi='0'");
							?>
							<li><a href="?page=pendaftar"><i class="icon-double-angle-right"></i>Semua Pendaftar<span class="badge badge-inverse"><?php echo $jAll;?></span></a></li>
							<li><a href="?page=akun"><i class="icon-double-angle-right"></i>Akun Pendaftar<span class="badge badge-yellow"><?php echo $jAll;?></span></a></li>
							<li><a href="?page=pveri"><i class="icon-double-angle-right"></i>Terverifikasi<span class="badge badge-primary"><?php echo $jVeri;?></span></a></li>
							<li><a href="?page=pnveri"><i class="icon-double-angle-right"></i>Belum Verifikasi<span class="badge badge-warning"><?php echo $jBVeri;?></span></a></li>
							<li><a href="?page=plulus"><i class="icon-double-angle-right"></i>Lulus Seleksi<span class="badge badge-success"><?php echo $jLulus;?></span></a></li>
							<li><a href="?page=pnlulus"><i class="icon-double-angle-right"></i>Tidak Lulus Seleksi<span class="badge badge-important"><?php echo $jNLulus;?></span></a></li>
						</ul>
					</li>

					<li><a href="?page=info" class="dropdown-toggle"><i class="icon-bullhorn"></i><span class="menu-text">Info Pengumuman</span></a></li>
					<li><a href="?page=pesan" class="dropdown-toggle"><i class="icon-envelope"></i><span class="menu-text">Pesan</span></a></li>
					<li><a href="?page=periode" class="dropdown-toggle"><i class="icon-calendar"></i><span class="menu-text">Manajemen Periode</span></a></li>
					<div class="sidebar-collapse" id=""></div>

					<?php
					if ($_SESSION[pmbLevel]==1){
					?>
					<li><a href="?page=user" class="dropdown-toggle"><i class="icon-cogs"></i><span class="menu-text">User Administrator</span></a></li>
					<?php
					}
					?>
					

				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>
				<br><br><br>
				
				<ul class="nav-list">
				<li><a href="#"><span class="menu-text"><center><?php echo date("Y");?> &copy; ATIM</center></span></a></li>
			</ul>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="page-content">
					<?php
					if ($_GET[page]=='home'){
						include 'home.php';
					}elseif($_GET[page]=='user'){
						include 'mod/mod_user/user.php';
					}elseif($_GET[page]=='info'){
						include 'mod/mod_info/info.php';
					}elseif($_GET[page]=='pesan'){
						include 'mod/mod_pesan/pesan.php';
					}elseif($_GET[page]=='periode'){
						include 'mod/mod_periode/periode.php';
					}

					elseif($_GET[page]=='pendaftar'){
						include 'mod/mod_pendaftar/pendaftar.php';
					}elseif($_GET[page]=='pveri'){
						include 'mod/mod_pendaftar/pendaftar.php';
					}elseif($_GET[page]=='pnveri'){
						include 'mod/mod_pendaftar/pendaftar.php';
					}elseif($_GET[page]=='plulus'){
						include 'mod/mod_pendaftar/pendaftar.php';
					}elseif($_GET[page]=='pnlulus'){
						include 'mod/mod_pendaftar/pendaftar.php';
					}

					elseif($_GET[page]=='bio'){
						include 'mod/mod_pendaftar/bio.php';
					}elseif($_GET[page]=='nilai'){
						include 'mod/mod_pendaftar/nilai.php';
					}elseif($_GET[page]=='akun'){
						include 'mod/mod_pendaftar/akun.php';
					}

					else{
						include 'home.php';
					}
					
					?>
				</div><!--/.page-content-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>

		<!--basic styles-->
      	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
      	<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
      	<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
      	<!--[if IE 7]>
      	<link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
      	<![endif]-->
      	<!--page specific plugin styles-->
      	<!--fonts-->
      	<link rel="stylesheet" href="http://fonts.googleapis.com/css5c0a.css?family=Open+Sans:500,300" />
      	<!--ace styles-->
      	<link rel="stylesheet" href="assets/css/ace.min.css" />
      	<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
      	<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
      	<!--[if lte IE 8]>
      	<link rel="stylesheet" href="assets/css/ace-ie.min.css" />
      	<![endif]-->
      	<!--inline styles related to this page-->
      	<!--ace settings handler-->
      	<script src="assets/js/ace-extra.min.js"></script>

      	<script src="assets/js/chosen.jquery.min.js"></script>
			<script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>

      	<script type="text/javascript">
      		$(".chosen-select").chosen(); 
      		$('[data-rel=tooltip]').tooltip({container:'body'});
      		$('.date-picker').datepicker().next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
      	</script>
			<!--page specific plugin scripts-->
      	<script src="assets/js/jquery.dataTables.min.js"></script>
      	<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
      	<script type="text/javascript">
		   jQuery(function($) {
		      var oTable1 = $('#myTable').dataTable();
		   
		      $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		      function tooltip_placement(context, source) {
		         var $source = $(source);
		         var $parent = $source.closest('table')
		         var off1 = $parent.offset();
		         var w1 = $parent.width();
		   
		         var off2 = $source.offset();
		         var w2 = $source.width();
		   
		         if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
		         return 'left';
		      }

		   })
			</script>

		<!--ace scripts-->

		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
				});
			
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaings",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			
			  var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
			
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').slimScroll({
					height: '300px'
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
				
			
			})
		</script>
		<script type="text/javascript">
		function qh() {
			if (confirm("Yakin Hapus Data ?")){
				return true;
			}else{
				return false;
			}
		}
		</script>
	</body>
</html>