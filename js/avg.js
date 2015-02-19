<script type="text/javascript" src="js/jquery02.js"></script>

<script type="text/javascript">
	var bIsFirebugReady = (!!window.console && !!window.console.log);

	jQuery(document).ready(
		function (){
			jQuery("#idPluginVersion").text(jQuery.Calculation.version);
			jQuery("input[name^=bhs]").avg({
				bind:"keyup"
				, selector: "#totalBhs"
				, onParseError: function(){
					this.css("backgroundColor", "#cc0000")
				}
				, onParseClear: function (){
					this.css("backgroundColor", "");
				}
			});

			jQuery("#idTotalTextAvg").click(
				function (){
					var avg = jQuery(".totalBhs").avg();
					jQuery("#totalTextAvg").text(avg.toString());
				}
			);
		}
	);
	
</script>
<script type="text/javascript">
	var bIsFirebugReady = (!!window.console && !!window.console.log);

	jQuery(document).ready(
		function (){
			jQuery("#idPluginVersion").text(jQuery.Calculation.version);
			jQuery("input[name^=big]").avg({
				bind:"keyup"
				, selector: "#totalbig"
				, onParseError: function(){
					this.css("backgroundColor", "#cc0000")
				}
				, onParseClear: function (){
					this.css("backgroundColor", "");
				}
			});

			
			jQuery("#idTotalTextAvg").click(
				function (){
					var avg = jQuery(".textbig").avg();
					$("#totalTextAvg").text(avg.toString());
				}
			);
		}
	);
	
</script>
<script type="text/javascript">
	var bIsFirebugReady = (!!window.console && !!window.console.log);

	jQuery(document).ready(
		function (){
			jQuery("#idPluginVersion").text(jQuery.Calculation.version);
			jQuery("input[name^=mat]").avg({
				bind:"keyup"
				, selector: "#totalmat"
				, onParseError: function(){
					this.css("backgroundColor", "#cc0000")
				}
				, onParseClear: function (){
					this.css("backgroundColor", "");
				}
			});

			
			jQuery("#idTotalTextAvg").click(
				function (){
					var avg = jQuery(".totalmat").avg();
					jQuery("#totalTextAvg").text(avg.toString());
				}
			);
		}
	);
	
</script>

<script type="text/javascript">
	var bIsFirebugReady = (!!window.console && !!window.console.log);

	jQuery(document).ready(
		function (){
			jQuery("#idPluginVersion").text(jQuery.Calculation.version);
			jQuery("input[name^=ipa]").avg({
				bind:"keyup"
				, selector: "#totalipa"
				, onParseError: function(){
					this.css("backgroundColor", "#cc0000")
				}
				, onParseClear: function (){
					this.css("backgroundColor", "");
				}
			});

			
			jQuery("#idTotalTextAvg").click(
				function (){
					var avg = jQuery(".totalipa").avg();
					jQuery("#totalTextAvg").text(avg.toString());
				}
			);
		}
	);
	
</script>

<script type="text/javascript">
	var bIsFirebugReady = (!!window.console && !!window.console.log);

	jQuery(document).ready(
		function (){
			jQuery("#idPluginVersion").text(jQuery.Calculation.version);
			jQuery("input[name^=ips]").avg({
				bind:"keyup"
				, selector: "#totalips"
				, onParseError: function(){
					this.css("backgroundColor", "#cc0000")
				}
				, onParseClear: function (){
					this.css("backgroundColor", "");
				}
			});

			
			jQuery("#idTotalTextAvg").click(
				function (){
					var avg = jQuery(".totalips").avg();
					jQuery("#totalTextAvg").text(avg.toString());
				}
			);
		}
	);
	
</script>
