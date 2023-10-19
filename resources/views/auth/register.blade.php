<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminLTE 3 | Registration Page (v2)</title>

	@include('_template.includes.head')
	<link rel="stylesheet" href="{{ asset('template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>

<body class="hold-transition register-page">
	<div class="register-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="{{ asset('template') }}/index2.html" class="h1"><b>Admin</b>LTE</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Register a new membership</p>

				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="input-group mb-3">
						<x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required
							autofocus placeholder="Full name" />
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
							required placeholder="Email" />
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<x-input id="password" class="form-control" type="password" name="password" required
							autocomplete="new-password" placeholder="Password" />
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<x-input id="password_confirmation" class="form-control" type="password"
							name="password_confirmation" required placeholder="Retype password" />
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="agreeTerms" name="terms" value="agree">
								<label for="agreeTerms">
									I agree to the <a href="#">terms</a>
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<hr>
				<a href="{{ route('login') }}" class="text-center">Já tenho um cadastro!</a>

				<x-auth-validation-errors class="mb-4" :errors="$errors" />


			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->

	@include('_template.includes.scripts')
</body>

</html>