<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<button type="button" class="navbar-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>                               

		<a class="navbar-brand" href="#" id="nav-header">Fjärrstyrning</a>  
	</div>

	<div class="navbar-inner navbar-mobile animate clearfix">
		<a href="#" class="btn btn-sm btn-default pull-left"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a href="#" class="btn btn-sm btn-default pull-right"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>


<div class="navbar navbar-inverse navbar-sidebar">
	<div class="navbar-inner navbar-inner-siderbar">
		<a class="navbar-sidebar-brand" data-toggle="dropdown" href="#"><img src="{{{ asset('assets/img/h-icon.png') }}}"></a>

		<div class="sidebar-login dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				{{ $user->first_name . ' ' . $user->last_name }} <span class="caret"></span>
			</a>
			
			<ul class="dropdown-menu" role="menu">
				<li><a class="navbar-small" id="logout-btn" data-href="{{ URL::to('hive/logout') }}">Logga out</a></li>
			</ul>
		</div>              
	</div>
</div>  

<script>
	$(".navbar-toggle").on('click', function() {
		$(".canvas").toggleClass('sidebar-active'); 
	});

	$("#logout-btn").on('click', function() {
		var url = $(this).data('href'); 

		$.ajax({
			url: url, 
			success: function(response) {
				if(response.status == 'logged-out') {
					$(".canvas").removeClass('sidebar-active'); 

					$("#navbar-area").empty(); 
					$("#content").empty(); 
					$("#bottom-navbar").empty(); 

					initNavbar(); 
					initContent(); 
					initBottom(); 					
				}
			}
		})		
	}); 
</script>