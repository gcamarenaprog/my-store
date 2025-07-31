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
  
  # Get total products
  $productObject = new ProductController();
  $totalProducts = $productObject->getTotalProducts ();
?>

<!-- Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <!-- Title -->
      <div class="col-sm-6">
        <h1>
          Bienvenido <b> <?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname']; ?></b>
        </h1>
      </div>

      <!-- Icon page -->
      <div class="col-sm-6 ininsys-icon-page">
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
            <h5 class="ininsys-card-title mb-2">Contadores</b></h5>
          </div>


          <!-- Products count -->
          <div class="col-lg-12 col-md-12">
            <div class="small-box bg-olive">
              <div class="inner">
                <h3><?php echo $totalProducts; ?></h3>
                <h4>Productos</h4>
              </div>
              <div class="icon">
                <i class="fa fa-truck-ramp-box ininsys-icon-counters"></i>
              </div>
              <a href="productViewAll" id="moreInfoProducts" class="small-box-footer"
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
<script src="public_html/resources/plugins/jquery/jquery.min.js"></script>

<!-- Sweet Alert -->
<script src="public_html/resources/plugins/sweetalert2/sweetalert2.11.7.31.js"></script>

<!-- Custom JS Code -->
<script src="public_html/js/js-functions.js"></script>

<script>
</script>