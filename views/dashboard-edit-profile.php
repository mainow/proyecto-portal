<div class="content-wrapper pt-4">
	<section class="content">
		<div class="container-sm">
			<h1>Editar Perfil</h1>
			<?php
			Form::create("", "POST", $params["formValidator"], [
				new Field("text", "first-name", "Primer Nombre", fAIcon:"fas fa-user"),
				new Field("text", "last-name", "Segundo Nombre", fAIcon:"far fa-user"),
				new Field("text", "email", "Email", Validation::$EMAIL, "fas fa-envelope"),
				new Field("number", "phone-number", "Numero de telefono", Validation::$PHONENUMBER, "fas fa-phone"),
				new Field("text", "address", "Direccion", fAIcon:"fas fa-map-marker-alt"),
				new Field("text", "city", "Ciudad", fAIcon:"fas fa-map-marked-alt"),
				new Field("password", "password", "Contraseña", Validation::$PWD, "fas fa-key"),
			], "Guardar", $params["fieldValues"] ?? []); ?>
      </div>
    </section>
</div>