<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show the home screen.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */
   
  # Required files
  require_once ('php/controllers/ProductController.php');
  require_once ('php/controllers/UserController.php');
  require_once ('php/controllers/CommentController.php');
  
  # Get total products
  $productObject = new ProductController();
  $totalProducts = $productObject->getTotalProducts ();
  
  # Get total users
  $userObject = new UserController();
  $totalUsers = $userObject->getTotalUsers () - 1;
  
  # Get total comments
  $commentObject = new CommentController();
  $totalComments = $commentObject->getTotalComments ();
  
  # Get total categories
  $categoriesObject = new ProductCategoriesController();
  $totalCategories = $categoriesObject->getTotalProductCategories ();
  
?>

<!-- Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <!-- Title -->
      <div class="col-sm-6">
        <h1>
          Bienvenido <b> <?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_last_name']; ?></b>
        </h1>
      </div>

      <!-- Icon page -->
      <div class="col-sm-6 store-icon-page">
        <ol class="breadcrumb float-sm-right">
          <i class="fa fa-home"></i>
        </ol>
      </div>

    </div>
  </div>
</section>

<!-- Content -->
<section class="content">
  <div class="container-fluid">

    <!-- Counters and fast access -->
    <div class="card ">

      <!-- Card body -->
      <div class="card-body">

        <!-- Counters -->
        <div class="row">

          <!-- Title -->
          <div class="col-12">
            <h5 class="store-card-title mb-2">Contadores</b></h5>
          </div>

          <!-- Products count -->
          <div class="col-lg-3 col-md-6">
            <div class="small-box bg-olive">
              <div class="inner">
                <h3><?php echo $totalProducts; ?></h3>
                <h4>Productos</h4>
              </div>
              <div class="icon">
                <i class="fa fa-truck-ramp-box ininsys-icon-counters"></i>
              </div>
              <a href="product-list" id="moreInfoProducts" class="small-box-footer"
                 title="Ver detalles">Ver detalles
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Categories count -->
          <div class="col-lg-3 col-md-6">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3><?php echo $totalCategories; ?></h3>
                <h4>Categorías</h4>
              </div>
              <div class="icon">
                <i class="fa fa-truck-ramp-box ininsys-icon-counters"></i>
              </div>
              <a href="product-categories" id="moreInfoProducts" class="small-box-footer"
                 title="Ver detalles">Ver detalles
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Users count -->
          <div class="col-lg-3 col-md-6">
            <div class="small-box bg-gradient-info">
              <div class="inner">
                <h3><?php echo $totalUsers; ?></h3>
                <h4>Usuarios</h4>
              </div>
              <div class="icon">
                <i class="fa fa-truck-ramp-box ininsys-icon-counters"></i>
              </div>
              <a href="#" id="moreInfoProducts" class="small-box-footer"
                 title="Ver detalles">Ver detalles
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!-- Comments count -->
          <div class="col-lg-3 col-md-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $totalComments; ?></h3>
                <h4>Comentarios</h4>
              </div>
              <div class="icon">
                <i class="fa fa-truck-ramp-box ininsys-icon-counters"></i>
              </div>
              <a href="#" id="moreInfoProducts" class="small-box-footer"
                 title="Ver detalles">Ver detalles
                <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

        </div>

        <hr>

      </div>

    </div>

  </div>
</section>


<!-- jQuery -->
<script src="public_html/resources/admin/plugins/jquery/jquery.min.js"></script>

<!-- Sweet Alert -->
<script src="public_html/resources/admin/plugins/sweetalert2/sweetalert2.11.7.31.js"></script>

<!-- Custom JS Code -->
<script src="public_html/js/js-functions.js"></script>

<script>
</script>