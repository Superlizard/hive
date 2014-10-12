@extends('site.default')


{{------- title -------}}
@section('title')
	CASSIUS &bull; Quantum UI
@stop
{{------- #/title -------}}


{{------- header -------}}
@section('nav')

@stop
{{------- #/header -------}}

{{------- content -------}}
@section('content')
	<article class="entry entry-light">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="entry-body center">
						<img src="{{ asset('assets/img/quantum-logo.png') }}" class="animated fadeInDown">

						@if ($message = Session::get('error'))
						<div class="alert-area">
							<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<h4>Error</h4>
								@if(is_array($message))
								@foreach ($message as $m)
								{{ $m }}
								@endforeach
								@else
								{{ $message }}
								@endif
							</div>
						</div>
						@endif

						@if(!Sentry::check())
							{{ Form::open(array('url' => 'quantum/login')) }}
							<div class="form-group">
									{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
							</div>
							<div class="form-group">
									{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
							</div>
							<div class="checkbox">
								<label>
									{{ Form::checkbox('remember_me', 'false') }} Remember until next time?
								</label>
							</div>
							{{ Form::submit('Log me in, Scotty!', array('class' => 'btn btn-danger btn-block')); }}
							{{ Form::close() }}
						@else 
							<a href="{{ URL::to('quantum/logout') }}" class="btn btn-danger">Logout</a>
						@endif
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