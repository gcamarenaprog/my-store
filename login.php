<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Login file
   * File description:    This file show the login screen.
   * Module:              Login
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files and libraries
  require_once (__DIR__ . '/install/config.php');
 
?>

<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <title>Acceso | Administración</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>

  <!-- Font Awesome Styles -->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/fontawesome-free/css/all.min.css'>

  <!-- AdminLTE Template Styles -->
  <link rel='stylesheet' href='public_html/resources/admin/dist/css/adminlte.min.css'>

  <!-- Custom styles -->
  <link rel='stylesheet' href='public_html/resources/admin/dist/css/custom.css'>

</head>

<body class='hold-transition login-page store-login-background'>

<!-- Login box -->
<div class='login-box'>

  <!-- Name of system /-->
  <div class='login-logo text-white'>
    <p><?php echo SYSTEM_FIRST_NAME; ?><b> <?php echo SYSTEM_SECOND_NAME; ?></b></p>
  </div>
  
  <?php if (!isset($_SESSION['user_username'])) : // If you are not logged in ?>

    <!-- Card if you are not logged in / Start -->
    <div class='card'>

      <!-- Log in form card /-->
      <div class='card-body login-card-body'>

        <!-- Title /-->
        <h4 class='text-center'>Administración</h4>
        <p class='login-box-msg'>Inicia sesión para ingresar</p>

        <!-- Form /-->
        <form action='php/sessions/session-new.php' method='post' id='formLogin' name='formLogin'>

          <!-- Error messages /-->
          <?php if (isset($_GET['error'])) :; ?>
            
            <?php
            $error = $_GET['error'];
            $return_value = match ($error) {
              'your-are-not-logged-in' => 'No ha iniciado sesión.',
              'empty-fields' => 'No puede haber campos vacíos.',
              'invalid-user-and-password' => 'Nombre o contraseña inválidos.',
              default => 'Error al iniciar sesión',
            };
            ?>

            <!-- If exist any error, print the error message -->
            <p class='text-danger text-center'><b>Error: </b><?php echo $return_value; ?></p>
          
          <?php endif; ?>

          <!-- Success message /-->
          <?php if (isset($_GET['success'])) :; ?>

            <!-- If you log out successfully, print the success message. /-->
            <p class='text-blue text-center'>Has cerrado sesión correctamente.</p>
          
          <?php endif; ?>

          <!-- Username /-->
          <div class='form-group'>
            <div class='input-group mb-3'>
              <label for='inputUsername'></label>
              <input type='text'
                     class='form-control'
                     id='inputUsername'
                     name='inputUsername'
                     placeholder='Usuario'
                     title='Usuario'>
              <div class='input-group-append'>
                <div class='input-group-text'>
                  <span class='fas fa-user'></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Password /-->
          <div class='form-group'>
            <div class='input-group mb-3'>
              <label for='inputPassword'></label>
              <input type='password'
                     class='form-control'
                     id='inputPassword'
                     name='inputPassword'
                     placeholder='Contraseña'
                     title='Contraseña'>
              <div class='input-group-append'>
                <div class='input-group-text'>
                  <span class='fas fa-lock'></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Log in button /-->
          <div class='row justify-content-end'>
            <div class='col-sm-4 col-xs-12'>
              <button type='submit'
                      class='btn btn-dark btn-block'
                      id='buttonLogin'
                      name='buttonLogin'
                      title='Ingresar'>
                Ingresar
              </button>
            </div>
          </div>

        </form>

      </div>

      <!-- Link go to store /-->
      <div class='card-footer bg-dark'>
        <h6 class='text-center store-text-white'><a class="text-white" href='store'>Ir a la tienda</a></h6>
      </div>

    </div>
    <!-- Card if you are not logged in / End -->
    
  <?php else : // If you are logged ?>

    <!-- Card if you are logged in / Start -->
    <div class='card'>
      <div class='card-body login-card-body'>

        <!-- Title /-->
        <p class='login-box-msg'>Ya has iniciado sesión.</p>

        <!-- Return to admin button /-->
        <button type='button'
                class='btn btn-block btn-dark btn'
                title='Ir a la administración.'
                onclick='location.href="admin";'>
          Ir a la administración
        </button>

        <!-- Go to store button /-->
        <button type='button'
                class='btn btn-block btn-dark btn'
                title='Ir a la tienda.'
                onclick='location.href="store";'>
          Ir a la tienda
        </button>

        <!-- Close session button /-->
        <button type='button'
                class='btn btn-block btn-dark btn'
                title='Cerrar sesión.'
                onclick='location.href="php/sessions/session-destroy.php";'>
          Cerrar sesión
        </button>

      </div>
    </div>
    <!-- Card if you are logged in / End -->
  
  <?php endif; ?>

</div>

<!-- jQuery JavaScript Code /-->
<script src='public_html/resources/admin/plugins/jquery/jquery.min.js'></script>

<!-- jquery-validation JavaScript Codes /-->
<script src='public_html/resources/admin/plugins/jquery-validation/jquery.validate.min.js'></script>
<script src='public_html/resources/admin/plugins/jquery-validation/additional-methods.min.js'></script>

<!-- Bootstrap 4 JavaScript Code /-->
<script src='public_html/resources/admin/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>

<!-- AdminLTE Template JavaScript Code /-->
<script src='public_html/resources/js/adminlte.min.js'></script>

<!-- Custom functions JavaScript Code /-->
<script src='public_html/js/js-functions.js'></script>

<!-- Custom login JavaScript Code /-->
<script src='public_html/js/js-login.js'></script>

</body>
</html>
