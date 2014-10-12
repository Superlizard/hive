<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>
			@section('title')
			Administration
			@show
		</title>
		<meta name="token" content="{{ Session::token() }}">
		<meta name="keywords" content="@yield('keywords')" />
		<meta name="author" content="@yield('author')" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- css includes -->
		{{ HTML::style('assets/css/animate.min.css'); }}
		{{ HTML::style('assets/css/bootstrap-switch.min.css'); }}
		{{ HTML::style('assets/css/jquery.nouislider.min.css'); }}
		{{ HTML::style('assets/css/style.min.css'); }}
		@yield('styles')
		<!--
			  ___         ___         ___         ___                  ___         ___     
			 /\__\       /\  \       /\__\       /\__\                /\  \       /\__\    
			/:/  /      /::\  \     /:/ _/_     /:/ _/_     ___       \:\  \     /:/ _/_   
		   /:/  /      /:/\:\  \   /:/ /\  \   /:/ /\  \   /\__\       \:\  \   /:/ /\  \  
		  /:/  /  ___ /:/ /::\  \ /:/ /::\  \ /:/ /::\  \ /:/__/   ___  \:\  \ /:/ /::\  \ 
		 /:/__/  /\__/:/_/:/\:\__/:/_/:/\:\__/:/_/:/\:\__/::\  \  /\  \  \:\__/:/_/:/\:\__\
		 \:\  \ /:/  \:\/:/  \/__\:\/:/ /:/  \:\/:/ /:/  \/\:\  \_\:\  \ /:/  \:\/:/ /:/  /
		  \:\  /:/  / \::/__/     \::/ /:/  / \::/ /:/  / ~~\:\/\__\:\  /:/  / \::/ /:/  / 
		   \:\/:/  /   \:\  \      \/_/:/  /   \/_/:/  /     \::/  /\:\/:/  /   \/_/:/  /  
			\::/  /     \:\__\       /:/  /      /:/  /      /:/  /  \::/  /      /:/  /   
			 \/__/       \/__/       \/__/       \/__/       \/__/    \/__/       \/__/      
		-->  
	</head>
	<body>
		<div class="outer-container">
			<div class="canvas">

				<!-- nav -->
				<div id="navbar-area">    
					{{-- NAVBAR AJAX --}}
				</div>
				<!-- ./ nav -->

				<!-- content -->
				<section id="content">
					{{-- CONTENT AJAX --}}
				</section>
				<!-- ./ content -->

				<!-- nav-bottom -->
				<div id="bottom-navbar">
					{{-- BOTTOM NAVBAR AJAX --}}
				</div>
				<!-- ./ nav-bottom -->

				<!-- footer -->
				<footer>
					<div class="container">
						<small class="text-muted">Copyright &copy; 2014 Hive</small>
					</div>
				</footer>
				<!-- ./footer -->
			</div>
		</div>

		<!-- js includes -->
		{{ HTML::script('assets/js/vendor/jquery-2.1.1.min.js'); }}
		{{ HTML::script('assets/js/vendor/bootstrap.min.js'); }}
		{{ HTML::script('assets/js/vendor/jquery.touchSwipe.min.js'); }}
		{{ HTML::script('assets/js/vendor/bootstrap-switch.min.js'); }}
		{{ HTML::script('assets/js/vendor/jquery.nouislider.min.js'); }}
		{{ HTML::script('assets/js/vendor/modernizr.js'); }}
		{{ HTML::script('assets/js/app.js'); }}

		<script>
			function initNavbar() {
				$.ajax({
					url: "{{ URL::to('hive/navbar') }}", 
					success: function(response) {
						$("#navbar-area").html(response); 
					}
				}); 
			}

			function initContent(which) {
				if(which == null) {
					which = "{{ URL::to('hive/content') }}"; 
				}
				
				$.ajax({
					url: which, 
					success: function(response) {
						$("#content").html(response.view);  
						if(response.status == 'logged-out') {
							$("#hive-login").on('submit', function(e) {
								var _this = $(this); 
								e.preventDefault(); 

								$.ajax({
									url: "{{ URL::to('hive/login') }}",
									method: 'post',
									data: _this.serialize(), 
									success: function(response) {
										if(response.status == 'logged-in') {
											$("#content").html(response.content);
											$("#navbar-area").html(response.navbar);
											$("#bottom-navbar").html(response.bottom);
										} else {
											$("#content").html(response); 
										}
									}
								}); 
							}); 					
						}
					}
				}); 
			}		

			function initBottom() {
				$.ajax({
					url: "{{ URL::to('hive/bottom') }}", 
					success: function(response) {
						$("#bottom-navbar").html(response);  
					}
				}); 
			} 

			initNavbar(); 
			initContent(); 
			initBottom(); 
		</script>

		@yield('scripts')
	</body>
	<!-- ./body -->
</html>
<!-- ./html -->