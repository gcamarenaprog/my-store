<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the shop categories and subcategories section.
   * Module:              Template Store
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  global $productControllerObject, $functionsObject, $categoryControllerObject, $categoryId, $totalProductsInTheCategory;
  
  # Get category name
  if ($categoryId == 0) {
    $categoryName = 'Categorías';
  } else {
    $categoryName = $categoryControllerObject->getCategoryName ($categoryId);
  }
  
  # Get a list of parent categories and subcategories
  if ($categoryId != 0) {
    $listOfParentCategoriesAndSubcategories = $categoryControllerObject->getParentsCategoriesWithSubcategoriesByParentCategoryId ($categoryId);
  } else {
    $listOfParentCategoriesAndSubcategories = $categoryControllerObject->getParentsCategoriesWithSubcategories ();
  }
  
  # Has child categories
  $hasChildCategories = $categoryControllerObject->getTotalChildCategories ($categoryId);
?>

<?php if ($hasChildCategories > 0): // If you have child categories it is shown ?>

  <!-- Parent category name /-->
  <h5 class="section-title position-relative text-uppercase mb-2">
    <span class="bg-secondary pr-3"><?php echo $categoryName; ?></span>
  </h5>
  <div class="bg-light p-4 mb-30">
    
    <?php foreach ($listOfParentCategoriesAndSubcategories as $category): ?>

      <!-- Parent category name /-->
      <div class=" d-flex align-items-center justify-content-between mb-2">
        <a href="shop?category=<?php echo $category['product_category_id'] ?>"
           class="text-truncate"
           style="color: #70747c; text-decoration: underline;"><?php echo $category['product_category_name']; ?></a>
        <span class="badge border font-weight-normal"><?php echo $totalProductsInTheCategory; ?></span>
      </div>
      
      <?php if ($category['subcategory']): ?>
        <small class="pt-1 mb-1 ml-3">SUBCATEGORÍAS </small>
      <?php endif; ?>
      
      
      <?php foreach ($category['subcategory'] as $subcategory): ?>
        
        <?php
        # Get the total number of results
        $totalProductsInTheCategory = $productControllerObject->getTotalProductsOfTheCategory ($subcategory['product_category_id']);
        ?>
        <!-- Subcategory name and total products /-->
        <div class=" d-flex align-items-center justify-content-between mb-1 ml-3">
          <a class="text-truncate"
             style="color: #70747c; text-decoration: underline; font-size: 0.95rem;"
             href="shop?category=<?php echo $subcategory['product_category_id'] ?>"><?php echo $subcategory['product_category_name']; ?></a>
          <span class="badge border font-weight-normal"><?php echo $totalProductsInTheCategory; ?></span>
        </div>
      
      <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
