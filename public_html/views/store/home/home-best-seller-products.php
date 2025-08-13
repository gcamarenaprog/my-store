<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template best seller products module.
   * Module:              Template Store
   * -------------------------------------------------------------------------------------------------------------------
   *
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/Functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  
  # Declaration and initialization of variables
  $functionObject = new Functions();
  $categoriesObject = new ProductCategoriesController();
  $productObject = new ProductController();
  
  $counterOfCards = 0;
  
  # Get recent products
  $bestScoredProductsList = $productObject->getsBestScoredProducts ();

?>

<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
  <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Productos más vendidos</span>
  </h2>
  <div class="row px-xl-5">
    
    <?php if ($bestScoredProductsList): // There are products.?>
    
    <?php foreach ($bestScoredProductsList as $product): ?>
      
      <?php
      # Only print 12 cards
      if ($counterOfCards >= 12) {
        break;
      }
      ?>
      <div class="col-lg-2 col-md-4 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">

          <!-- Product image / Start -->
          <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="<?php echo $product['product_image']; ?>" alt="">
            <div class="product-action">
              <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
              <a class="btn btn-outline-dark btn-square" href="#"><i class="far fa-heart"></i></a>
              <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-sync-alt"></i></a>
              <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-search"></i></a>
            </div>
          </div>
          <!-- Product image / End -->

          <!-- Product data / Start -->
          <div class="text-center py-4">

            <!-- Name -->
            <a class="h6 text-decoration-none text-truncate" href=""><?php echo $product['product_name']; ?></a>

            <!-- Prices -->
            <div class="d-flex align-items-center justify-content-center mt-2">
              <h5>$<?php echo number_format ($product['product_price'], 2, '.', ','); ?></h5>
              <h6 class="text-muted ml-2">
                <del>$<?php echo number_format ($product['product_price'] + $product['product_price'] * 0.05, 2, '.', ','); ?></del>
              </h6>
            </div>

            <!-- Views -->
            <small class="pt-1">(<?php echo $product['product_views']; ?>) Visitas</small>

            <!-- Likes -->
            <div class="d-flex align-items-center justify-content-center mb-1">
              <?php $functionObject->printStarsWithScore ($product['product_likes']); ?>
              <small>(<?php echo $product['product_likes']; ?>)</small>
            </div>

          </div>
          <!-- Product data / End -->

        </div>
      </div>
      
      <?php $counterOfCards++; ?>
    <?php endforeach; ?>
    
    <?php else: // No products. ?>
      <div class="col-lg-12 h-auto  mb-3">
        <div class=" bg-light p-30">
          <h3 class="text-center">No hay resultados</h3>
        </div>
      </div>
    <?php endif; ?>

  </div>
</div>
<!-- Products End -->