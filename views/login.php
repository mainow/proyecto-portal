<div class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
		<a href="home"><b>Pagina</b>Login</a>
		</div>
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Inicia sesion para comenzar</p>
				<?php
				echo new FormWidget("", "POST", $params["formValidator"], [
					new InputWidget("text", "id", "Ingrese su cedula", Validation::$USERNAME),
					new InputWidget("password", "password", "Ingrese su contraseña", Validation::$PWD)],
					new ButtonWidget("submit-login", "Iniciar Sesion", cssClasses:"btn-block")
				);
				?>
			</div>
		</div>
	</div>
</div>