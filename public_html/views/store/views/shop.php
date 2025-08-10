<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show the shop screen.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  
  $productObject = new ProductController();
  $objectFunction = new Functions();
  $objectCategory = new ProductCategoriesController();
  
  # Get category Id
  $categoryID = $_GET['category'] ?? 0;
  
  //setcookie('categoryIdValue', $categoryID);
  
  if ($_COOKIE['categoryIdValue'] == 0) {
    $categoryName = 'Productos';
  } else {
    $categoryName = $objectCategory->getCategoryNameById ($categoryID);
  }
  
  # Get the order value
  $sortingValue = $_COOKIE["sortingValue"] ?? '0';
  
  # Get the current page (default, page 1)
  $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  
  # Number of results per page
  $resultsPerPage = $_COOKIE["showValue"] ?? 9;
  
  # Calculate the displacement and get all products of the category selected
  $displacement = ($currentPage - 1) * $resultsPerPage;
  $productList = $productObject->calculateTheDisplacementAndGetProducts ($displacement, $resultsPerPage, $sortingValue, $categoryID);
  
  # Get the total number of results
  $totalProducts = $objectCategory->getTotalProductsOfCategory ($categoryID);
  
  # Calculate the total number of pages
  $totalPages = ceil ($totalProducts / $resultsPerPage);

?>


<!-- Breadcrumb / Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="store">Incio</a>
        <a class="breadcrumb-item text-dark" href="shop">Tienda</a>
        <span class="breadcrumb-item active"><strong>Lista de <?php echo $categoryName; ?></strong></span>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb / End -->

<!-- Shop / Start -->
<div class="container-fluid">
  <div class="row px-xl-5">

    <!-- Shop Sidebar / Start -->
    <div class="col-lg-3 col-md-4">

      <!-- Price filter / Start -->
      <h5 class="section-title position-relative text-uppercase mb-3"><span
            class="bg-secondary pr-3">Filtrar por precio</span></h5>
      <div class="bg-light p-4 mb-30">
        <form>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" checked id="price-all">
            <label class="custom-control-label" for="price-all">Sin precio</label>
            <span class="badge border font-weight-normal"><?php echo $totalProducts; ?></span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-1">
            <label class="custom-control-label" for="price-1">$0 - $10,000</label>
            <span class="badge border font-weight-normal">150</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-2">
            <label class="custom-control-label" for="price-2">$10,000 - $20,000</label>
            <span class="badge border font-weight-normal">295</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-3">
            <label class="custom-control-label" for="price-3">$20,000 - $30,000</label>
            <span class="badge border font-weight-normal">246</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-4">
            <label class="custom-control-label" for="price-4">$30,000 - $40,000</label>
            <span class="badge border font-weight-normal">145</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-5">
            <label class="custom-control-label" for="price-5">$40,000 - $50,000</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-5">
            <label class="custom-control-label" for="price-5">$50,000 - $60,000</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
            <input type="checkbox" class="custom-control-input" id="price-5">
            <label class="custom-control-label" for="price-5">Más de $60,000</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
        </form>
      </div>
      <!-- Price filter / End -->

      <!-- Stock filter / Start -->
      <h5 class="section-title position-relative text-uppercase mb-3"><span
            class="bg-secondary pr-3">Filtrar por stock</span></h5>
      <div class="bg-light p-4 mb-30">
        <form>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" checked id="color-all">
            <label class="custom-control-label" for="price-all">Sin filtro</label>
            <span class="badge border font-weight-normal"><?php echo $totalProducts; ?></span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-1">
            <label class="custom-control-label" for="color-1">0-500</label>
            <span class="badge border font-weight-normal">150</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-2">
            <label class="custom-control-label" for="color-2">500-1000</label>
            <span class="badge border font-weight-normal">295</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-3">
            <label class="custom-control-label" for="color-3">1000-2000</label>
            <span class="badge border font-weight-normal">246</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-4">
            <label class="custom-control-label" for="color-4">2000-4000</label>
            <span class="badge border font-weight-normal">333</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
            <input type="checkbox" class="custom-control-input" id="color-5">
            <label class="custom-control-label" for="color-5">Más de 4000</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
        </form>
      </div>
      <!-- Stock filter / End -->

      <!-- Score filter Start -->
      <h5 class="section-title position-relative text-uppercase mb-3"><span
            class="bg-secondary pr-3">Filtrar por calificación</span></h5>
      <div class="bg-light p-4 mb-30">
        <form>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" checked id="size-all">
            <label class="custom-control-label" for="size-all">Sin filtro</label>
            <span class="badge border font-weight-normal"><?php echo $totalProducts; ?></span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-1">
            <label class="custom-control-label" for="size-1">
              <small class="fa fa-star text-primary mr-1"></small>
            </label>
            <span class="badge border font-weight-normal">150</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-2">
            <label class="custom-control-label" for="size-2">
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
            </label>
            <span class="badge border font-weight-normal">295</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-3">
            <label class="custom-control-label" for="size-3">
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
            </label>
            <span class="badge border font-weight-normal">246</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-4">
            <label class="custom-control-label" for="size-4">
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
              <small class="fa fa-star text-primary mr-1"></small>
            </label>
            <span class="badge border font-weight-normal">145</span>
          </div>

        </form>
      </div>
      <!-- Score filter End -->

    </div>
    <!-- Shop Sidebar End -->

    <!-- Shop Product Start -->
    <div class="col-lg-9 col-md-8">
      <div class="row pb-3">

        <!-- Tools of product list / Start -->
        <div class="col-12 pb-1">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
              <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
            </div>
            <div class="ml-2">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Ordenar
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#" onclick="sortingSelectedOption(1);">Recientes</a>
                  <a class="dropdown-item" href="#" onclick="sortingSelectedOption(2);">Popularidad</a>
                  <a class="dropdown-item" href="#" onclick="sortingSelectedOption(3);">Más visitados</a>
                </div>
              </div>
              <div class="btn-group ml-2">
                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Mostrar
                </button>
                <div id="myDropdown" class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#" onclick="showSelectedOption(9);">9</a>
                  <a class="dropdown-item" href="#" onclick="showSelectedOption(18);">18</a>
                  <a class=" dropdown-item" href="#" onclick="showSelectedOption(27);">27</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Tools of product list / End -->
        
        <?php if ($productList): // There are products.?>
          
          <?php foreach ($productList as $product): ?>

            <!-- Product list / Start -->
            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
              <div class="product-item bg-light mb-4">

                <!-- Product image -->
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="<?php echo $product['product_image']; ?>" alt="">
                  <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                  </div>
                </div>

                <!-- Product data -->
                <div class="text-center py-4">

                  <!-- Product name -->
                  <a class="h6 text-decoration-none text-truncate"
                     onclick="viewProductDetailsAjax(<?php echo $product['product_id']; ?>)"
                     href=""><?php echo $product['product_name']; ?></a>

                  <!-- Product prices -->
                  <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5><?php echo number_format ($product['product_price'], 2, '.', ','); ?></h5>
                    <h6 class="text-muted ml-2">
                      <del><?php echo $product['product_price'] + $product['product_price'] * 0.05; ?></del>
                    </h6>
                  </div>

                  <!-- Product visits -->
                  <small class="pt-1">(<?php echo $product['product_views']; ?>) Visitas</small>

                  <!-- Product score -->
                  <div class="d-flex align-items-center justify-content-center mb-1">
                    <?php $objectFunction->printStarsWithScore ($product['product_likes']); ?>
                    <small>(<?php echo $product['product_likes']; ?>)</small>
                  </div>

                </div>

              </div>
            </div>
            <!-- Product list / End -->
          
          <?php endforeach; ?>
        
        <?php else: // No products. ?>
          <div class="col-lg-12 h-auto  mb-3">
            <div class=" bg-light p-30">
              <h3 class="text-center">No hay resultados</h3>
            </div>
          </div>
        <?php endif; ?>

        <!-- Pagination / Start -->
        <div class="col-12">
          <nav>
            <ul class="pagination justify-content-center">
              
              <?php if ($currentPage > 1) : ?>
                <li class="page-item ">
                  <a class="page-link" href='?page=<?php echo $currentPage - 1; ?>'>Anterior</span></a>
                </li>
              <?php else: ?>
                <li class="page-item disabled"><a class="page-link" href='#'>Anterior</span></a></li>
              <?php endif; ?>
              
              <?php
                if ($currentPage > 10) {
                  $i = $currentPage - 5;
                } else {
                  $i = 1;
                }
                if ($currentPage > 0 && $currentPage <= $totalPages - 5) {
                  $totalPages = $currentPage + 5;
                }
              ?>
              
              <?php for ($i; $i <= $totalPages; $i++): ?>
                <?php $activeClass = ($i == $currentPage) ? "active" : ""; ?>
                <li class="page-item <?php echo $activeClass; ?>">
                  <a class="page-link" href='?page=<?php echo $i ?>'><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
              
              <?php if ($currentPage < $totalPages) : ?>
                <a class="page-link" href='?page=<?php echo $currentPage + 1; ?>'>Siguiente</span></a>
              <?php else: ?>
                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
              <?php endif; ?>

            </ul>
          </nav>
        </div>
        <!-- Pagination / End -->

      </div>
    </div>
    <!-- Shop Product End -->

  </div>
</div>
<!-- Shop / End -->

<!-- jQuery -->
<script src='public_html/resources/admin/plugins/jquery/jquery.min.js'></script>

<!-- Custom JS Code -->
<script src='public_html/js/js-functions.js'></script>

<!-- Custom JS Code -->
<script src='public_html/js/js-shop.js'></script>

<script>

  /** Document ready functions -----------------------------------------------------------------------------------------*/
  $(document).ready(function () {

    setCookie('categoryIdValue', '<?php echo $categoryID; ?>')

  });

</script>
