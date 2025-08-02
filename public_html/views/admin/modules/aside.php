<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template aside module.
   * Module:              Template
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  $url = explode ('/', URL);
  $nameOfTheView = $url[0];
  $userName = $_SESSION['user_name'];
  $userLastName = $_SESSION['user_lastname'];
  $userFullName = $userName . ' ' . $userLastName;
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="public_html/resources/admin/dist/img/AdminLTELogo.png" alt="Administración"
         class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text  font-weight-light">Administración</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php Functions::showUserImage (); ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $userFullName; ?></a>
      </div>
    </div>
    <!-- /.Sidebar user panel -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Home item /-->
        <li class="nav-item ">
          <a href="home" class="nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'home'); ?> ">
            <i class="nav-icon fas fa-home"></i>
            <p title="Inicio">
              Inicio
            </p>
          </a>
        </li>

        <!-- Inventory submenu /-->
        <li class="nav-item <?php Functions::menuActive ('menuOpened', $nameOfTheView, 'product'); ?>">

          <!-- Inventory /-->
          <a href="" class="nav-link <?php Functions::menuActive ('menuOpenedActive', $nameOfTheView, 'product'); ?>">
            <i class="nav-icon fas fa-truck-ramp-box"></i>
            <p title="Inventario">
              Inventario
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            <!-- Product View All /-->
            <li class="nav-item">
              <a href="product-list"
                 class="nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'product-list') ?>">
                <i class="far fa-circle nav-icon"></i>
                <p title="Todos los productos">Todos los productos</p>
              </a>
            </li>

            <!-- Product Add New /-->
            <li class="nav-item">
              <a href="product-add"
                 class="nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'product-add') ?>">
                <i class="far fa-circle nav-icon"></i>
                <p title="Nuevo producto">Nuevo producto</p>
              </a>
            </li>

            <!-- Product Categories /-->
            <li class="nav-item">
              <a href="product-categories"
                 class="nav-link <?php Functions::menuActive ('menuActiveItem', $nameOfTheView, 'product-categories') ?>">
                <i class="far fa-circle nav-icon"></i>
                <p title="Categorías">Categorías</p>
              </a>
            </li>

          </ul>

        </li>

        <!-- Catalog item /-->
        <li class="nav-item">
          <a href="store" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p title="Tienda">Tienda</p>
          </a>
        </li>

      </ul>


    </nav>
    <!-- /.sidebar-menu -->
    
  </div>
  <!-- /.sidebar -->
</aside>