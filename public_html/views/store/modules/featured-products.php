<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template featured products' module.
   * Module:              Template Store
   * -------------------------------------------------------------------------------------------------------------------
   *
   * The following criteria are used to obtain the 8 featured product listings:
   *
   * - 8 parent categories are randomly selected.
   * - The cheapest product is selected from each category.
   * - The discount is simulated, increased by 5% to the actual price.
   * - The rating is going obtained from the product_score field, which ranges from 1 to 5.   *
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  
  $objectFunction = new Functions();
  $categoriesObject = new ProductCategoriesController();
  $productObject = new ProductController();
  
  # 8 parent categories are randomly selected.
  $arrayCategoriesIds = [];
  $categoriesIds = $categoriesObject->getParentsCategoriesIds (); // All parents category IDs are obtained.
  
  foreach ($categoriesIds as $item) {
    $arrayCategoriesIds[] = $item['product_category_id'];
  }
  
  shuffle ($arrayCategoriesIds); // Shuffle array

?>

<!-- Products Start -->
<div class="container-fluid pt-5 pb-3">
  <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Productos destacados</span>
  </h2>
  <div class="row px-xl-5">
    
    <?php $counter = 0;
      foreach ($arrayCategoriesIds as $categoryId): ?>
        
        <?php
        
        # Only print 8 cards
        if ($counter >= 8) {
          break;
        }
        
        # The cheapest product is selected from each selected category.
        $productList = $productObject->getCheaperProducts ($categoryId);
        
        foreach ($productList as $product) {
        
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
          <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
              <img class="img-fluid w-100" src="<?php echo $product['product_image']; ?>" alt="">
              <div class="product-action">
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#"><i class="far fa-heart"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-sync-alt"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-search"></i></a>
              </div>
            </div>
            <div class="text-center py-4">
              <a class="h6 text-decoration-none text-truncate" href=""><?php echo $product['product_name']; ?></a>
              <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>$<?php echo number_format ($product['product_price'], 2, '.', ','); ?></h5>
                <h6 class="text-muted ml-2">
                  <del>$<?php echo $product['product_price'] + $product['product_price'] * 0.05; ?></del>
                </h6>
              </div>
              <small class="pt-1">(<?php echo $product['product_views']; ?>) Visitas</small>
              <div class="d-flex align-items-center justify-content-center mb-1">
                <?php $objectFunction->printStarsWithScore ($product['product_likes']); ?>
                <small>(<?php echo $product['product_likes']; ?>)</small>
              </div>
            </div>
          </div>
        </div>
        
        <?php $counter++; } ?>
      
      <?php endforeach; ?>

  </div>
</div>
<!-- Products End -->