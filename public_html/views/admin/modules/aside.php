<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template aside module.
   * Module:              Template
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  $url = explode ('/', URL);
  $nameOfTheView = $url[0];
  $userName = $_SESSION['user_name'];
  $userLastName = $_SESSION['user_lastname'];
  $userFullName = $userName . ' ' . $userLastName;
?>

<!-- Aside / Start -->
<aside class='main-sidebar sidebar-dark-primary elevation-4'>

  <!-- Image logo /-->
  <a href='#' class='brand-link'>
    <img src='public_html/resources/admin/dist/img/AdminLTELogo.png' alt='Administración'
         class='brand-image img-circle elevation-3' style='opacity: 0.8'>
    <span class='brand-text font-weight-light'><?php echo SYSTEM_FULL_NAME ?> ADMIN</span>
  </a>

  <!-- Sidebar / Start -->
  <div class='sidebar'>
    
    <!-- User data / Start -->
    <div class='user-panel mt-3 pb-3 mb-3 d-flex'>
      <div class='image'>
        <img src='<?php Functions::showUserImage (); ?>' class='img-circle elevation-2' alt='User Image'>
      </div>
      <div class='info'>
        <a href=#' class='d-block'><?php echo $userFullName; ?></a>
      </div>
    </div>
    <!-- User data / End -->

    <!-- Menu / Start -->
    <nav class='mt-2'>
      <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>

        <!-- Home item /-->
        <li class='nav-item '>
          <a href='admin' class='nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'admin'); ?> '>
            <i class='nav-icon fas fa-home'></i>
            <p title='Inicio'>
              Inicio
            </p>
          </a>
        </li>

        <!-- Inventory submenu /-->
        <li class='nav-item <?php Functions::menuActive ('menuOpened', $nameOfTheView, 'product'); ?>'>

          <!-- Inventory /-->
          <a href='' class='nav-link <?php Functions::menuActive ('menuOpenedActive', $nameOfTheView, 'product'); ?>'>
            <i class='nav-icon fas fa-truck-ramp-box'></i>
            <p title='Inventario'>
              Inventario
              <i class='right fas fa-angle-left'></i>
            </p>
          </a>

          <ul class='nav nav-treeview'>

            <!-- Product list /-->
            <li class='nav-item'>
              <a href='product-list'
                 class='nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'product-list') ?>'>
                <i class='far fa-circle nav-icon'></i>
                <p title='Todos los productos'>Todos los productos</p>
              </a>
            </li>

            <!-- Product add /-->
            <li class='nav-item'>
              <a href='product-add'
                 class='nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'product-add') ?>'>
                <i class='far fa-circle nav-icon'></i>
                <p title='Nuevo producto'>Nuevo producto</p>
              </a>
            </li>

            <!-- Product categories /-->
            <li class='nav-item'>
              <a href='product-categories'
                 class='nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'product-categories') ?>'>
                <i class='far fa-circle nav-icon'></i>
                <p title='Categorías'>Categorías</p>
              </a>
            </li>

          </ul>

        </li>

        <!-- Store item /-->
        <li class='nav-item'>
          <a href='store' class='nav-link'>
            <i class='nav-icon fas fa-table'></i>
            <p title='Tienda'>Tienda</p>
          </a>
        </li>

      </ul>

    </nav>
    <!-- Menu / End -->
    
  </div>
  <!-- Sidebar / End -->
  
</aside>
<!-- Aside / End -->