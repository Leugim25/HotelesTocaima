@extends('layouts.main', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('')])

@section('content')
<div class="container" style="height: auto;">
	<div class="row align-items-center">
		<div class="col-md-9 ml-auto mr-auto mb-3 text-center">
			<h3>{{ __('') }} </h3>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-5">
			<form class="form" method="POST" action="{{ route('login') }}">
				@csrf
				<div class="card card-login card-hidden mb-3">
					<div class="card-header card-header-primary text-center">
						<h4 class="card-title"><strong>{{ __('Accede con') }}</strong></h4>
						<div class="social-line">
							<a href="#" class="btn btn-just-icon btn-link btn-white">
								<i class="fa fa-facebook-square"></i>
							</a>
							<a href="#" class="btn btn-just-icon btn-link btn-white">
								<i class="fa fa-twitter"></i>
							</a>
							<a href="#" class="btn btn-just-icon btn-link btn-white">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
					<div class="card-body">
						<p class="card-description text-center">{{ __('Puedes acceder tambien a') }} <strong>Hoteles Tocaima</strong> {{ __(' con tu ') }}<strong>Correo</strong> {{ __(' y ') }} <strong>Contraseña</strong></p>
						<div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="material-icons">email</i>
									</span>
								</div>
								<input type="email" name="email" class="form-control" placeholder="{{ __('Correo electronico') }}" value="{{ old('email', 'miguel@correo.com') }}" required autocomplete="email">
							</div>
							@if ($errors->has('email'))
							<div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
								<strong>{{ $errors->first('email') }}</strong>
							</div>
							@endif
						</div>
						<div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="material-icons">lock_outline</i>
									</span>
								</div>
								<input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Contraseña') }}" value="{{ !$errors->has('password') ? "123456789" : "" }}" required autocomplete="current-password">
							</div>
							@if ($errors->has('password'))
							<div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
								<strong>{{ $errors->first('password') }}</strong>
							</div>
							@endif
						</div>
						<div class="form-check mr-auto ml-3 mt-3">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordarme') }}
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<div class="card-footer justify-content-center">
						<button type="submit" class="btn btn-primary">{{ __('iniciar sesión') }}</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-6">
					@if (Route::has('password.request'))
					<a href="{{ route('password.request') }}" class="text-light">
						<small>{{ __('¿Olvidaste tu contraseña?') }}</small>
					</a>
					@endif
				</div>
				<div class="col-6 text-right">
					<a href="{{ route('register') }}" class="text-light">
						<small>{{ __('Crear una nueva cuenta') }}</small>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
