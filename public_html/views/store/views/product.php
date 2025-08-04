<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show the product screen.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 4) . '/php/includes/functions.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductCategoriesController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  
  $objectCategoriesProduct = new ProductCategoriesController();
  $objectProduct = new ProductController();
  $objectFunctions = new Functions();
  
  # Get product id to details view it
  if (isset($_SESSION['viewProductDetailsSessionFlag'])) {
    
    # Get product id from session var
    $productId = $_SESSION['viewProductDetailsSessionFlag'];
    
    # Get product data formatted
    $formattedProductData = $objectProduct->getProductFormattedForDetailsView ($productId);
    
    $productName = $formattedProductData['productName'];
    $productDescription = $formattedProductData['productSpecifications'];
    $productCategories = $formattedProductData['productCategories'];
    $productPrice = $formattedProductData['productPrice'];
    $productPriceClean = $formattedProductData['productPriceClean'];
    $productQuantity = $formattedProductData['productQuantity'];
    $productBrand = $formattedProductData['productBrand'];
    $productModel = $formattedProductData['productModel'];
    $productViews = $formattedProductData['productViews'];
    $productLikes = $formattedProductData['productLikes'];
    $productCommentId = $formattedProductData['productCommentId'];
    $productImage = $formattedProductData['productImage'];
    $productDateLastChange = $formattedProductData['productDateLastChange'];
    $productDateCreation = $formattedProductData['productDateCreation'];
    
    # Else redirect product view all screen
  } else {
    header ('Location: ' . 'shop');
  }

?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="store">Inicio</a>
        <a class="breadcrumb-item text-dark" href="shop">Tienda</a>
        <span class="breadcrumb-item active"><strong> <?php echo $productName; ?></strong></span>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">

  <!-- Images carrousel /-->
  <div class="row px-xl-5">
    <div class="col-lg-5 mb-30">
      <div id="product-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner bg-light">
          <div class="carousel-item active">
            <img class="w-100 h-100" src="<?php echo $productImage; ?>" alt="Image">
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="<?php echo $productImage; ?>" alt="Image">
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="<?php echo $productImage; ?>" alt="Image">
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="<?php echo $productImage; ?>" alt="Image">
          </div>
        </div>
        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
          <i class="fa fa-2x fa-angle-left text-dark"></i>
        </a>
        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
          <i class="fa fa-2x fa-angle-right text-dark"></i>
        </a>
      </div>
    </div>
    
    <div class="col-lg-7 h-auto mb-30">
      <div class="h-100 bg-light p-30">

        <!-- Category/ies /-->
        <h4>
          <small class="store-product-details-categories" title="Categoría/s">CATEGORÍA/S: <?php echo $productCategories; ?></small>
        </h4>

        <!-- Name /-->
        <h3><?php echo $productName; ?></h3>

        <!-- Likes /-->
        <div class="d-flex mb-3">
          <?php $objectFunctions->printStarsWithScore ($productLikes); ?>
          <small>(<?php echo $productLikes; ?>)</small>
        </div>
      
        <!-- Price /-->
        <h3 class="font-weight-semi-bold mb-4">$<?php echo $productPrice; ?></h3>
        <p class="mb-4"><?php echo $productDescription; ?></p>

        <!-- Brand /-->
        <div class="d-flex mb-3">
          <strong class="text-dark mr-3">Marca:</strong><?php echo $productBrand; ?>
        </div>

        <!-- Model /-->
        <div class="d-flex mb-3">
          <strong class="text-dark mr-3">Modelo:</strong><?php echo $productModel; ?>
        </div>

        <!-- Add to cart /-->
        <div class="d-flex align-items-center mb-4 pt-2">
          <div class="input-group quantity mr-3" style="width: 130px;">
            <div class="input-group-btn">
              <button class="btn btn-primary btn-minus">
                <i class="fa fa-minus"></i>
              </button>
            </div>
            <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
            <div class="input-group-btn">
              <button class="btn btn-primary btn-plus">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Añadir al carrito</button>
        </div>

        <!-- Social media /-->
        <div class="d-flex pt-2">
          <strong class="text-dark mr-2">Compartir en:</strong>
          <div class="d-inline-flex">
            <a class="text-dark px-2" href="">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-dark px-2" href="">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="text-dark px-2" href="">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a class="text-dark px-2" href="">
              <i class="fab fa-pinterest"></i>
            </a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="row px-xl-5">
    <div class="col">
      <div class="bg-light p-30">
        <div class="nav nav-tabs mb-4">
          <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Descripción</a>
          <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Comentarios</a>
          <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reseñas (0)</a>
        </div>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="tab-pane-1">
            <h4 class="mb-3">Descripción del producto</h4>
            <p><?php echo $productDescription; ?></p>
          </div>
          <div class="tab-pane fade" id="tab-pane-2">
            <h4 class="mb-3">Additional Information</h4>
            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
            <div class="row">
              <div class="col-md-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item px-0">
                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                  </li>
                  <li class="list-group-item px-0">
                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                  </li>
                  <li class="list-group-item px-0">
                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                  </li>
                  <li class="list-group-item px-0">
                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item px-0">
                    Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                  </li>
                  <li class="list-group-item px-0">
                    Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                  </li>
                  <li class="list-group-item px-0">
                    Duo amet accusam eirmod nonumy stet et et stet eirmod.
                  </li>
                  <li class="list-group-item px-0">
                    Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="tab-pane-3">
            <div class="row">
              <div class="col-md-6">
                <h4 class="mb-4">1 reseña para "<?php echo $productName; ?>"</h4>
                <div class="media mb-4">
                  <img src="public_html/resources/admin/dist/img/users/user_2.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                  <div class="media-body">
                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                    <div class="text-primary mb-2">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star-half-alt"></i>
                      <i class="far fa-star"></i>
                    </div>
                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <h4 class="mb-4">Dejar una reseña</h4>
                <small>Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados con *</small>
                <div class="d-flex my-3">
                  <p class="mb-0 mr-2">Tu calificación * :</p>
                  <div class="text-primary">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                  </div>
                </div>
                <form>
                  <div class="form-group">
                    <label for="message">Tu reseña *</label>
                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="name">Tu nombre *</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Tu correo electrónico *</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="form-group mb-0">
                    <input type="submit" value="Deja Tu Reseña" class="btn btn-primary px-3">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Shop Detail End -->
