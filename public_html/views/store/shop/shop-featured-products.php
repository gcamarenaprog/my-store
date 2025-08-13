<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the store's featured products module, as a criterion, products with the lowest
   *                      prices are selected.
   * Module:              Template Store
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  global $productControllerObject, $functionsObject, $categoryControllerObject, $categoryId;
  
  require_once (dirname (__DIR__, 4) . '/php/controllers/CommentController.php');
  
  $objectComments = new CommentController();
  
  $counterOfCards = 0;
  $numberOfCards = 6;
  
  # Get a list of cheaper products.
  $cheaperProductList = $productControllerObject->getCheapestProductOfTheCategory ($categoryId, $numberOfCards);

?>

<!-- Featured products / Start -->
<div class="container-fluid">
  <div class="row px-xl-5">

    <!-- Title /-->
    <div class="col-lg-12 col-md-12 col-sm-12 pb-1">
      <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Productos destacados</span>
      </h5>
    </div>
    
    <?php if ($cheaperProductList): // There are products.?>
      
      <?php foreach ($cheaperProductList as $product): ?>
        
        <?php
        
        # Only print the number selected of the cards
        if ($counterOfCards >= $numberOfCards) {
          break;
        }
        
        # Get comments of product
        $commentsListOfTheProduct = $objectComments->getAllCommentsOfProduct ($product['product_id']);
        
        # Get total comments
        $totalCommentsOfTheProduct = $objectComments->getTotalCommentsOfProduct ($product['product_id']);
        
        # Get the average review score for this product
        $countComments = 0;
        $sumOfScores = 0;
        foreach ($commentsListOfTheProduct as $comment) {
          $sumOfScores = $sumOfScores + $comment['comment_score'];
          $countComments++;
        }
        $scoreAverage = $sumOfScores / $countComments;
        $scoreAverage = round ($scoreAverage);
        ?>

        <!-- List of products / Start -->
        <div class="col-lg-2 col-md-4 col-sm-6 pb-1">
          <div class="product-item bg-light mb-4">

            <!-- Image /-->
            <div class="product-img position-relative overflow-hidden">
              <img class="img-fluid w-100" src="<?php echo $product['product_image']; ?>" alt="">
              <div class="product-action">
                <a class="btn btn-outline-dark btn-square" href="#" title="Añadir al carrito"><i
                      class="fa fa-shopping-cart"></i></a>
                <a class="btn btn-outline-dark btn-square" href="#" title="Me gusta"><i class="far fa-heart"></i></a>
              </div>
            </div>

            <!-- Product data / Start -->
            <div class="text-center py-4">

              <!-- Name /-->
              <a class="h6 text-decoration-none text-truncate font-size-90p"
                 onclick="viewProductDetailsInShop(<?php echo $product['product_id']; ?>)"
                 href="#">
                <?php echo $product['product_name']; ?>
              </a>

              <!-- Price with discount /-->
              <div class="d-flex align-items-center justify-content-center mt-2">
                <h6 class="text-muted ml-2 font-size-90p">
                  <del>
                    $<?php echo number_format ($product['product_price'] + $product['product_price'] * 0.05, 2, '.', ','); ?></del>
                </h6>
              </div>

              <!-- Price -->
              <div class="d-flex align-items-center justify-content-center mt-2">
                <h5 class="font-size-90p">$<?php echo number_format ($product['product_price'], 2, '.', ','); ?></h5>
              </div>


              <!-- Views -->
              <div class="d-flex align-items-center justify-content-center mb-1">
                <div class="text-primary mr-2">
                  <small class="fas fa-eye"></small>
                </div>
                <small class="pt-1"><?php echo $product['product_views']; ?> Visitas </small>
              </div>

              <!-- Likes -->
              <div class="d-flex align-items-center justify-content-center mb-1">
                <div class="text-primary mr-2">
                  <small class="fas fa-heart"></small>
                </div>
                <small class="pt-1"><?php echo $product['product_likes']; ?> Likes </small>
              </div>


              <!-- Product score -->
              <div class="d-flex align-items-center justify-content-center mb-1">
                <div class="text-primary mr-2">
                  
                  <?php for ($i = 1; $i <= $scoreAverage; $i++) : ?>
                    <small class="fas fa-star"></small>
                  <?php endfor; ?>
                  
                  <?php if ($scoreAverage < 5): ?>
                    <?php
                    $remaining = 5 - $scoreAverage;
                    for ($i = 1; $i <= $remaining; $i++) : ?>
                      <small class="far fa-star"></small>
                    <?php endfor; ?>
                  <?php endif; ?>

                </div>
                <small class="pt-1">(<?php echo $countComments; ?>)</small>
              </div>

            </div>
            <!-- Product data / End -->

          </div>
        </div>
        <!-- List of products / End -->
        
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
<!-- Featured products / End -->