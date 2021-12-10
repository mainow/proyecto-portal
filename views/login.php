<div class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="home"><b>Pagina</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesion para comenzar</p>
      <form action="login" method="POST">
        <div class="input-group mb-3">
          <input name="username" required type="text" class="form-control" placeholder="Nombre de usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pwd" required type="password" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit-login" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.html">Olvide mi contraseña</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Registrarse</a>
      </p>
      </div>
        <?php 
            $loginStatus = isset($_GET["login-status"]) ? $_GET["login-status"] : 0;
            if ($loginStatus) {
                require "config.php";
                if ($loginStatus == "user-found") {
                    // en public_html "/" es suficiente para index
                    header("Location: dashboard");
                }
                ?>
                <p class="text-danger text-center"><?php echo $LOGIN_STATUS_MSGS[$_GET["login-status"]] ?></p>
            <?php
            }
        ?>
    <!-- /.login-card-body -->
  </div>
</div>
</div>

