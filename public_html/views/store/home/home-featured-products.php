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
   * The following criteria are used to obtain the 12 featured product listings:
   *
   * - Get parent categories are randomly selected.
   * - The cheaper product is selected from each category.
   * - The discount is simulated, increased by 5% to the actual price.
   * - The rating is going obtained from the product_score field, which ranges from 1 to 5.   *
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/Functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  
  # Variables declaration and initialization.
  $functionObject = new Functions();
  $categoriesObject = new ProductCategoriesController();
  $productObject = new ProductController();
  
  # Get parent categories.
  $arrayParentCategoriesIds = [];
  $parentCategoriesIds = $categoriesObject->getParentsCategoriesIds (); // All parents category IDs are obtained.
  
  # Create parents categories ids array
  foreach ($parentCategoriesIds as $item) {
    $arrayParentCategoriesIds[] = $item['product_category_id'];
  }
  
  # Shuffle the array of parent categories ids
  shuffle ($arrayParentCategoriesIds);

?>

<!-- Products / Start -->
<div class="container-fluid pt-5 pb-3">
  <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Productos destacados</span>
  </h2>
  <div class="row px-xl-5">
    
    <?php $counter = 0; ?>
    <?php foreach ($arrayParentCategoriesIds as $categoryId): ?>
      
      <?php
      
      # Only print 12 cards
      if ($counter >= 12) {
        break;
      } ?>
      
      <?php
      # The cheapest product is selected from each selected category.
      $productList = $productObject->getCheapestProductOfTheCategory ($categoryId); ?>
      
      <?php if ($productList): // There are products. ?>
        
        <?php foreach ($productList as $product): ?>

          <div class="col-lg-2 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
              <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="<?php echo $product['product_image']; ?>" alt="">
                <div class="product-action">
                  <a class="btn btn-outline-dark btn-square" href="#" title="Añadir al carrito"><i
                        class="fa fa-shopping-cart"></i></a>
                  <a class="btn btn-outline-dark btn-square" href="#" title="Me gusta"><i
                        class="far fa-heart"></i></a>
                </div>
              </div>
              <div class="text-center py-4">

                <!-- Name /-->
                <a class="h6 text-decoration-none text-truncate"
                   onclick="viewProductDetailsAjax(<?php echo $product['product_id']; ?>)"
                   href="#">
                  <?php echo $product['product_name']; ?>
                </a>

                <!-- Price /-->
                <div class="d-flex align-items-center justify-content-center mt-2">
                  <h5>$<?php echo number_format ($product['product_price'], 2, '.', ','); ?></h5>
                  <h6 class="text-muted ml-2">
                    <del>
                      $<?php echo number_format ($product['product_price'] + $product['product_price'] * 0.05, 2, '.', ','); ?></del>
                  </h6>
                </div>

                <!-- Visits /-->
                <small class="pt-1">(<?php echo $product['product_views']; ?>) Visitas</small>

                <!-- Likes /-->
                <div class="d-flex align-items-center justify-content-center mb-1">
                  <?php $functionObject->printStarsWithScore ($product['product_likes']); ?>
                  <small>(<?php echo $product['product_likes']; ?>)</small>
                </div>
              </div>
            </div>
          </div>
          
          <?php $counter++; ?>
        <?php endforeach; ?>
      
      <?php else: // No products. ?>
        <div class="col-lg-12 h-auto  mb-3">
          <div class=" bg-light p-30">
            <h3 class="text-center">No hay resultados</h3>
          </div>
        </div>
      <?php endif; ?>
    
    <?php endforeach; ?>
  </div>
</div>
<!-- Products / End -->