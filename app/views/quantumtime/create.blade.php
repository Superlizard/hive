@extends('site.quantum')


{{------- title -------}}
@section('title')
	CASSIUS &bull; Quantum UI
@stop
{{------- #/title -------}}


{{------- header -------}}
@section('nav')
	@if(Sentry::check())
		<div class="navbar navbar-inverse navbar-sidebar">
			<div class="navbar-inner">
				<a class="navbar-sidebar-brand" href="#"><img src="{{{ asset('assets/img/q-icon.png') }}}"></a>

				<ul class="sidebar-login">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Kasian Marszalek <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a class="navbar-small" href="{{ URL::to('quantum/logout') }}">Log out</a></li>
						</ul>
					</li>	
				</ul>				

				<ul class="navbar-sidebar-nav">
					<li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-time"></span> Log new time-entry</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-time"></span> Manage entries</a></li>
				</ul>
			</div>
		</div>		
	@endif
@stop
{{------- #/header -------}}

{{------- content -------}}
@section('content')
	<article class="entry entry-dark">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="entry-body center">
						<img src="{{ asset('assets/img/quantum-logo.png') }}">
					</div>
				</div>
			</div>
		</div>
	</article>
@stop
{{------- #/content -------}}


{{------- footer -------}}
@section('footer')
	<footer>
		<div class="container">
			<small class="text-muted">Copyright &copy; 2014 <CASSIUS</small>
			<img src="{{ asset('assets/img/logo.png') }}">
		</div>
	</footer>
@stop
{{------- #/footer -------}}


{{------- scripts -------}}
@section('scripts')
@stop
{{------- #/scripts -------}}