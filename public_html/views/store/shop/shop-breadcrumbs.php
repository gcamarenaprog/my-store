<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the breadcrumbs module.
   * Module:              Template Store
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  
  $categoryControllerObject = new ProductCategoriesController();
  
  # Get category Id
  $categoryID = $_GET['category'] ?? 0;
  
  if ($categoryID == 0) {
    $categoryNameBreadcrumb = 'Productos';
  } else {
    $categoryName = $categoryNameBreadcrumb = $categoryControllerObject->getCategoryName ($categoryID);
  }

?>

<!-- Breadcrumb / Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="store">Incio</a>
        <a class="breadcrumb-item text-dark" href="shop">Tienda</a>
        <span class="breadcrumb-item active"><strong>Lista de <?php echo $categoryNameBreadcrumb; ?></strong></span>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb / End -->