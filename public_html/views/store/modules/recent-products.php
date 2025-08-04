<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template recent products module.
   * Module:              Template Store
   * -------------------------------------------------------------------------------------------------------------------
   *
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  
  $objectFunction = new Functions();
  $categoriesObject = new ProductCategoriesController();
  $productObject = new ProductController();
  
  $allRecentProducts = $productObject->getAllRecentProducts ();

?>

<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
  <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Productos recientes</span>
  </h2>
  <div class="row px-xl-5">
    
    <?php $counter = 0;
      foreach ($allRecentProducts as $product): ?>
        
        <?php
        
        # Only print 8 cards
        if ($counter >= 8) {
          break;
        }
        
        $productName = $product['product_name'];
        $productPrice = number_format ($product['product_price'], 2, '.', ',');
        $productPriceDisscount = $product['product_price'] + $product['product_price'] * 0.05;
        $productLikes = $product['product_likes'];
        $productImage = $product['product_image'];
        $productId = $product['product_id'];
        $productViews = $product['product_views'];
        
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
          <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
              <img class="img-fluid w-100" src="<?php echo $productImage; ?>" alt="">
              <div class="product-action">
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#"><i class="far fa-heart"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-sync-alt"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-search"></i></a>
              </div>
            </div>
            <div class="text-center py-4">
              <a class="h6 text-decoration-none text-truncate" href=""><?php echo $productName; ?></a>
              <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>$<?php echo $productPrice; ?></h5>
                <h6 class="text-muted ml-2">
                  <del>$<?php echo $productPriceDisscount; ?></del>
                </h6>
              </div>
              <small class="pt-1">(<?php echo $productViews; ?>) Visitas</small>
              <div class="d-flex align-items-center justify-content-center mb-1">
                <?php $objectFunction->printStarsWithScore ($productLikes); ?>
                <small>(<?php echo $productLikes; ?>)</small>
              </div>
            </div>
          </div>
        </div>
        
        <?php $counter++; endforeach; ?>

  </div>
</div>
<!-- Products End -->