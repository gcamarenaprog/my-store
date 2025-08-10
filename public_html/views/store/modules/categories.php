<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the template categories module.
   * Module:              Template Store
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  
  $functionObject = new Functions();
  $categoriesObject = new ProductCategoriesController();
  $categoriesList = $categoriesObject->getAllParentCategories ();
  
  $productObject = new ProductController();
  
?>

<!-- Categories Start -->
<div class="container-fluid pt-5">
  <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categorías</span></h2>
  <div class="row px-xl-5 pb-3">
    
    <?php  foreach ($categoriesList as $category): ?>
      
      <?php  $totalProductsOfCategory = $categoriesObject->getTotalProductsOfCategory ($category['product_category_id']); ?>
    
    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
      <a class="text-decoration-none" href="store?category=<?php echo $category['product_category_id'];?>">
        <div class="cat-item d-flex align-items-center mb-4">
          <div class="overflow-hidden" style="width: 100px; height: 100px;">
            <img class="img-fluid" src="<?php echo $category['product_category_image']; ?>" alt="">
          </div>
          <div class="flex-fill pl-3">
            <h6><?php echo $category['product_category_name']; ?></h6>
            <small class="text-body"><?php echo $totalProductsOfCategory; ?> Productos</small>
          </div>
        </div>
      </a>
    </div>
    
    <?php endforeach; ?>
    
  </div>
</div>
<!-- Categories End -->