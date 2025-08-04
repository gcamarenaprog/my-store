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
  
  $productObject = new ProductController();
  $objectFunction = new Functions();
  
  # Get the current page (default, page 1)
  $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  
  # Number of results per page
  $resultsPerPage = 9;
  
  # Calculate the displacement
  $displacement = ($currentPage - 1) * $resultsPerPage;
  $result = $productObject->calculateTheDsiplacement ($displacement, $resultsPerPage);
  
  # Get the total number of results
  $totalRows = $productObject->getTotalProducts ();
  $totalResults = $totalRows;
  
  # Calculate the total number of pages
  $totalPages = ceil ($totalResults / $resultsPerPage);

?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="store">Incio</a>
        <a class="breadcrumb-item text-dark" href="shop">Tienda</a>
        <span class="breadcrumb-item active">Lista de Productos</span>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
  <div class="row px-xl-5">

    <!-- Shop Sidebar Start -->
    <div class="col-lg-3 col-md-4">
      <!-- Price Start -->
      <h5 class="section-title position-relative text-uppercase mb-3"><span
            class="bg-secondary pr-3">Filter by price</span></h5>
      <div class="bg-light p-4 mb-30">
        <form>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" checked id="price-all">
            <label class="custom-control-label" for="price-all">All Price</label>
            <span class="badge border font-weight-normal">1000</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-1">
            <label class="custom-control-label" for="price-1">$0 - $100</label>
            <span class="badge border font-weight-normal">150</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-2">
            <label class="custom-control-label" for="price-2">$100 - $200</label>
            <span class="badge border font-weight-normal">295</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-3">
            <label class="custom-control-label" for="price-3">$200 - $300</label>
            <span class="badge border font-weight-normal">246</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="price-4">
            <label class="custom-control-label" for="price-4">$300 - $400</label>
            <span class="badge border font-weight-normal">145</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
            <input type="checkbox" class="custom-control-input" id="price-5">
            <label class="custom-control-label" for="price-5">$400 - $500</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
        </form>
      </div>
      <!-- Price End -->

      <!-- Color Start -->
      <h5 class="section-title position-relative text-uppercase mb-3"><span
            class="bg-secondary pr-3">Filter by color</span></h5>
      <div class="bg-light p-4 mb-30">
        <form>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" checked id="color-all">
            <label class="custom-control-label" for="price-all">All Color</label>
            <span class="badge border font-weight-normal">1000</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-1">
            <label class="custom-control-label" for="color-1">Black</label>
            <span class="badge border font-weight-normal">150</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-2">
            <label class="custom-control-label" for="color-2">White</label>
            <span class="badge border font-weight-normal">295</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-3">
            <label class="custom-control-label" for="color-3">Red</label>
            <span class="badge border font-weight-normal">246</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="color-4">
            <label class="custom-control-label" for="color-4">Blue</label>
            <span class="badge border font-weight-normal">145</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
            <input type="checkbox" class="custom-control-input" id="color-5">
            <label class="custom-control-label" for="color-5">Green</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
        </form>
      </div>
      <!-- Color End -->

      <!-- Size Start -->
      <h5 class="section-title position-relative text-uppercase mb-3"><span
            class="bg-secondary pr-3">Filter by size</span></h5>
      <div class="bg-light p-4 mb-30">
        <form>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" checked id="size-all">
            <label class="custom-control-label" for="size-all">All Size</label>
            <span class="badge border font-weight-normal">1000</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-1">
            <label class="custom-control-label" for="size-1">XS</label>
            <span class="badge border font-weight-normal">150</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-2">
            <label class="custom-control-label" for="size-2">S</label>
            <span class="badge border font-weight-normal">295</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-3">
            <label class="custom-control-label" for="size-3">M</label>
            <span class="badge border font-weight-normal">246</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
            <input type="checkbox" class="custom-control-input" id="size-4">
            <label class="custom-control-label" for="size-4">L</label>
            <span class="badge border font-weight-normal">145</span>
          </div>
          <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
            <input type="checkbox" class="custom-control-input" id="size-5">
            <label class="custom-control-label" for="size-5">XL</label>
            <span class="badge border font-weight-normal">168</span>
          </div>
        </form>
      </div>
      <!-- Size End -->
    </div>
    <!-- Shop Sidebar End -->

    <!-- Shop Product Start -->
    <div class="col-lg-9 col-md-8">
      <div class="row pb-3">
        <div class="col-12 pb-1">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
              <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
            </div>
            <div class="ml-2">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">Latest</a>
                  <a class="dropdown-item" href="#">Popularity</a>
                  <a class="dropdown-item" href="#">Best Rating</a>
                </div>
              </div>
              <div class="btn-group ml-2">
                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#">10</a>
                  <a class="dropdown-item" href="#">20</a>
                  <a class="dropdown-item" href="#">30</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <?php if ($result): // There are products.?>
          
          <?php foreach ($result as $product): ?>
            
            <?php
            
            $productName = $product['product_name'];
            $productPrice = number_format ($product['product_price'], 2, '.', ',');
            $productPriceDisscount = $product['product_price'] + $product['product_price'] * 0.05;
            $productLikes = $product['product_likes'];
            $productImage = $product['product_image'];
            $productId = $product['product_id'];
            
            ?>

            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
              <div class="product-item bg-light mb-4">

                <!-- Product image -->
                <div class="product-img position-relative overflow-hidden">
                  <img class="img-fluid w-100" src="<?php echo $productImage; ?>" alt="">
                  <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                  </div>
                </div>

                <div class="text-center py-4">

                  <!-- Product details -->
                  <a class="h6 text-decoration-none text-truncate" href=""><?php echo $productName; ?></a>
                  <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5><?php echo $productPrice; ?></h5>
                    <h6 class="text-muted ml-2">
                      <del><?php echo $productPriceDisscount; ?></del>
                    </h6>
                  </div>

                  <!-- Product score -->
                  <div class="d-flex align-items-center justify-content-center mb-1">
                    <?php $objectFunction->printStarsWithScore ($productLikes); ?>
                    <small>(<?php echo $productLikes; ?>)</small>
                  </div>

                </div>

              </div>
            </div>
          <?php endforeach; ?>
        
        <?php else: // No products. ?>
          <div class="col-lg-12 h-auto  mb-3">
            <div class=" bg-light p-30">
              <h3 class="text-center">No hay resultados</h3>
            </div>
          </div>
        <?php endif; ?>

        <!-- Pagination -->
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

      </div>
    </div>
    <!-- Shop Product End -->

  </div>
</div>
<!-- Shop End -->
