<article class="entry animated fadeInRight" id="single_object">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6">
				Slå på enheter automatiskt
			</div>
			<div class="col-xs-6 right">
				<input type="checkbox" id="auto">
			</div>					
		</div>
		<div class="row">
			<div class="col-xs-6">
				Automatisk backup på enheter
			</div>
			<div class="col-xs-6 right">
				<input type="checkbox" id="backup">
			</div>	
		</div>
	</div>
</article>

<script>
	if(typeof(Storage) !== "undefined") {
		var settings = localStorage.getItem('settings'); 
		if(settings == null) {
			settings = {
				auto: false, 
				backup: false,
			} 

			localStorage.setItem('settings', JSON.stringify(settings)); 
		} else {
			settings = JSON.parse(settings);  
		}
	} else {
		console.log("*** Localstorage not supported."); 
	}

	if(settings.auto) {
		$("#auto").attr('checked', 'checked'); 
	} else {
		$("#auto").removeAttr('checked'); 
	}	

	if(settings.backup) {
		$("#backup").attr('checked', 'checked'); 
	} else {
		$("#backup").removeAttr('checked'); 
	}		

	$("#auto").on('switchChange.bootstrapSwitch', function(event, state) {
		settings.auto = state; 
		localStorage.setItem('settings', JSON.stringify(settings)); 
	}); 	

	$("#backup").on('switchChange.bootstrapSwitch', function(event, state) {
		settings.backup = state; 
		localStorage.setItem('settings', JSON.stringify(settings)); 
	}); 	

	$("input[type=checkbox]").bootstrapSwitch();
</script>