<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template navbar module.
   * Module:              Template
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */

?>

<!-- Navbar / Start -->
<nav class='main-header navbar navbar-expand navbar-white navbar-light'>

  <!-- Left navbar elements / Start -->
  <ul class='navbar-nav'>

    <!-- Push menu button -->
    <li class='nav-item'>
      <a class='nav-link' data-widget='pushmenu' href='#' role='button'><i class='fas fa-bars'></i></a>
    </li>

    <!-- Store link -->
    <li class='nav-item d-none d-sm-inline-block'>
      <a href='store' class='nav-link' title='Ir a la tienda'>Tienda</a>
    </li>

  </ul>
  <!-- Left navbar elements / End -->

  <!-- Right navbar elements / Start -->
  <ul class='navbar-nav ml-auto'>

    <!-- User details button -->
    <li class='nav-item dropdown'>

      <!-- User image /-->
      <a class='nav-link' data-toggle='dropdown' href='#' aria-expanded='true' style='padding: 0px;'>
        <img src='<?php Functions::showUserImage (); ?>'
             class='img-circle elevation-2'
             alt='User Image'
             style='width: 33px;'
             title='Menú de usuario'>
      </a>

      <div class='dropdown-menu dropdown-menu dropdown-menu-right' style='left: inherit; right: 0px;'>

        <!-- Full name user /-->
        <a href='user-profile'
           class='dropdown-item'
           style='text-align: center; font-size: 16px;'
           title='Nombre de usuario'>
          <?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname'] ?><br>
          <b><?php
              echo $_SESSION['user_role']; ?></b>
        </a>

        <div class='dropdown-divider'></div>

        <!-- Profile option /-->
        <a href='user-profile'
           class='dropdown-item dropdown-item-text'
           style='padding-top: 0px;padding-bottom: 0px; text-align: left;'
           title='Perfil'>
          <i class='fas fa-id-card mr-2'></i>Perfil</a>

        <div class='dropdown-divider'></div>

        <!-- Log out option /-->
        <a href='#' class='dropdown-item dropdown-item-text'
           onclick='location.href="php/sessions/session-destroy.php";'
           style='padding-top: 0px; padding-bottom: 0px; text-align: left;'
           title='Cerrar sesión'>
          <i class="fas fa-sign-out mr-2"></i>Cerrar sesión</a>

      </div>

    </li>

    <!-- Expand button -->
    <li class='nav-item'>
      <a class='nav-link' data-widget='fullscreen' title='Maximizar' href='#' role='button'>
        <i class='fas fa-expand-arrows-alt'></i>
      </a>
    </li>

  </ul>
  <!-- Right navbar elements / End -->

</nav>
<!-- Navbar / End -->