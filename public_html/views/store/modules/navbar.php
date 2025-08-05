<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template navbar module.
   * Module:              Template Store
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  $newObject = new ProductCategoriesController();
  
  $categories = $newObject->getAllParentCategoriesWithSubcategories ();
  
  $last = end ($categories);
?>

<!-- Navbar / Start -->
<div class="container-fluid bg-dark mb-30">
  <div class="row px-xl-5">

    <!-- Categories menu / Start -->
    <div class="col-lg-3 d-none d-lg-block">

      <!-- Main button of categories menu /-->
      <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
         href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
        <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorías</h6>
        <i class="fa fa-angle-down text-dark"></i>
      </a>

      <!-- Elements of menu / Start -->
      <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
           id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">

        <div class="navbar-nav w-100">
          
          <?php foreach ($categories as $category): ?>
            
            <?php
            # Check if the category has child categories
            $totalChildCategories = $newObject->countChildCategoriesOfCategory ($category['product_category_id']);
            ?>
            
            <?php if ($totalChildCategories): // Print categories with child categories ?>
              <div class="nav-item dropdown dropright">

                <!-- Category name -->
                <a href="shop?category=<?php echo $category['product_category_id']; ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  <?php echo $category['product_category_name']; ?>
                  <i class="fa fa-angle-right float-right mt-1"></i>
                </a>

                <!-- Sub-category name / Start -->
                <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                  <?php
                    if (!empty($category['subcategory'])) {
                      echo $newObject->printSubcategories ($category['subcategory'], $pixels = 0);
                    }
                  ?>
                </div>
                <!-- Sub-category name / End -->

              </div>
            
            <?php else: // Print categories without child categories ?>

              <!-- Category name -->
              <a href="shop?category=<?php echo $category['product_category_id']; ?>" class="nav-item nav-link">
                <?php echo $category['product_category_name']; ?>
              </a>
            
            <?php endif; ?>
          
          <?php endforeach; ?>


        </div>
        
      </nav>
      <!-- Elements of menu / End -->

    </div>
    <!-- Categories menu / End -->

    <!-- Main menu and counters / Start -->
    <div class="col-lg-9">
      <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
        <a href="" class="text-decoration-none d-block d-lg-none">
          <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
          <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          <div class="navbar-nav mr-auto py-0">
            <a href="store" class="nav-item nav-link active">Inicio</a>
            <a href="shop?category=0" class="nav-item nav-link">Tienda</a>
            <div class="nav-item dropdown">
              <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                <a href="checkout.html" class="dropdown-item">Checkout</a>
              </div>
            </div>
            <a href="contact" class="nav-item nav-link">Contacto</a>
          </div>
          <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
            <a href="" class="btn px-0">
              <i class="fas fa-heart text-primary"></i>
              <span class="badge text-secondary border border-secondary rounded-circle"
                    style="padding-bottom: 2px;">0</span>
            </a>
            <a href="" class="btn px-0 ml-3">
              <i class="fas fa-shopping-cart text-primary"></i>
              <span class="badge text-secondary border border-secondary rounded-circle"
                    style="padding-bottom: 2px;">0</span>
            </a>
          </div>
        </div>
      </nav>
    </div>
    <!-- Main menu and counters / End -->

  </div>
</div>
<!-- Navbar / End -->

<!-- jQuery -->
<script src='public_html/resources/admin/plugins/jquery/jquery.min.js'></script>

<script>
  $('.dropdown-toggle').click(function () {
    window.location = $(this).attr('href');
  });
</script>