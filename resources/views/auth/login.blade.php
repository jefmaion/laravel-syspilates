<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminLTE 3 | Log in (v2)</title>

	@include('_template.includes.head')
	<link rel="stylesheet" href="{{ asset('template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>

<body class="hold-transition login-page ">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="{{ asset('template') }}/index2.html" class="h1">Sys<b>Pilates</b></a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Faça login para iniciar</p>

				<form method="POST" action="{{ route('login') }}">
					@csrf
					<div class="input-group mb-3">
						<x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
							placeholder="Email" required autofocus />
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<x-input id="password" class="form-control" type="password" name="password" required
							autocomplete="current-password" placeholder="Password" />

						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember_me">
								<label for="remember_me" name="remember">
									{{ __('Lembrar-me') }}
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>


						</div>
						<!-- /.col -->
					</div>
				</form>

				<x-auth-validation-errors class="mb-4" :errors="$errors" />



				<p class="mb-1">

					@if (Route::has('password.request'))
					<a href="{{ route('password.request') }}">
						{{ __('Esqueceu sua senha?') }}
					</a>
					@endif


				</p>
				<p class="mb-0">
					<a href="{{ route('register') }}" class="text-center">Cadastrar um novo usuário</a>
				</p>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->
	@include('_template.includes.scripts')
</body>

</html>