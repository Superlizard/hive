<div class="navbar navbar-inverse navbar-fixed-bottom">
	<div class="navbar-inner">
		<ul class="navbar-icons">
			<li class="active"><a href="#" data-href="content" data-title="Fjärrstyrning"><span class="glyphicon glyphicon-dashboard"></span><br>Fjärrstyr</a></li>
			<li><a href="#" data-href="favorites" data-title="Favoriter"><span class="glyphicon glyphicon-heart"></span><br>Favoriter</a></li>
			<li><a href="#" data-href="settings" data-title="Inställningar"><span class="glyphicon glyphicon-cog"></span><br>Inställningar</a></li>
		</ul>
	</div>
</div>


<script>

	var base = "{{ URL::to('hive') }}"; 
	var prev = 'content'; 
	$(".navbar-icons a").on('click', function() {
		var next = $(this).data('href'); 
		var title = $(this).data('title'); 
		
		if(prev == next) {
			return; 
		}

		$("a[data-href=" + next + "]").parent().addClass('active'); 
		$("a[data-href=" + prev + "]").parent().removeClass('active'); 
		$("#nav-header").html(title); 

		initContent(base + "/" + next); 
		prev = next; 
	}); 
</script>