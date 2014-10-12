<article class="entry">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="entry-body center">
					<img src="{{ asset('assets/img/hive-logo.png') }}" class="animated fadeInDown">

					{{ Session::get('error') ? dd(Session::get('error')) : '' }}

					@if (isset($message) && $message)
					<div class="alert-area">
						<div class="alert alert-danger alert-block">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<h4>Fel!</h4>
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
						{{ Form::open(array('id' => 'hive-login')) }}
						<div class="form-group">
								{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) }}
						</div>
						<div class="form-group">
								{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Lösenord')) }}
						</div>

						{{ Form::submit('Jag vill in!', array('class' => 'btn btn-warning btn-block')); }}
						{{ Form::close() }}
					@else 
						<a href="{{ URL::to('hive/logout') }}" class="btn btn-danger">Logout</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</article>