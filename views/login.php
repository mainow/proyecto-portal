<div class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
		<a href="home"><b>Pagina</b>Login</a>
		</div>
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Inicia sesion para comenzar</p>
				<?php
				Form::create("", "POST", $params["formValidator"], [
					new Field("text", "id", "Ingrese su cedula", Validation::$USERNAME),
					new Field("password", "password", "Ingrese su contraseña", Validation::$PWD)],
					"Ingresar"
				);
				?>
			</div>
		</div>
	</div>
</div>