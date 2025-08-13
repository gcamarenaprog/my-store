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
  require_once (dirname (__DIR__, 4) . '/php/controllers/ProductController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/CommentController.php');
  require_once (dirname (__DIR__, 4) . '/php/controllers/UserController.php');
  
  $objectProduct = new ProductController();
  $objectComments = new CommentController();
  $objectUser = new UserController();
  
  # Get product id to details view it
  if (isset($_SESSION['viewProductDetailsSessionFlag'])) {
    
    # Get product id from session var
    $productId = $_SESSION['viewProductDetailsSessionFlag'];
    
    # Get product data formatted
    $productData = $objectProduct->getProductFormattedForDetailsView ($productId);
    
    # Get product id from session flag var
    $productId = $_SESSION['viewProductDetailsSessionFlag'];
    
    # Get comments
    $resultComments = $objectComments->getAllCommentsOfProduct ($productId);
    
    # Get total comments
    $totalCommentsOfTheProduct = $objectComments->getTotalCommentsOfProduct ($productId);
    
    # Get score total of comments for this product
    $countComments = 0;
    $totalScore = 0;
    foreach ($resultComments as $comment) {
      $totalScore = $totalScore + $comment['comment_score'];
      $countComments++;
    }
    $scoreAverage = $totalScore / $countComments;
    $scoreAverage = round ($scoreAverage);
    
    # Else redirect product view all screen
  } else {
    header ('Location: ' . 'shop');
  }

?>

<!-- Breadcrumb / Start -->
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-12">
      <nav class="breadcrumb bg-light mb-30">
        <a class="breadcrumb-item text-dark" href="store">Inicio</a>
        <a class="breadcrumb-item text-dark" href="shop">Tienda</a>
        <a class="breadcrumb-item text-dark" href="#"><?php echo $productData['productCategories']; ?></a>
        <span class="breadcrumb-item active"><strong> <?php echo $productData['productName']; ?></strong></span>
      </nav>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Detail / Start -->
<div class="container-fluid pb-5">

  <!-- Images carrousel /-->
  <div class="row px-xl-5">
    <div class="col-lg-5 mb-30">
      <div id="product-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner bg-light">
          <div class="carousel-item active">
            <img class="w-100 h-100" src="<?php echo $productData['productImage']; ?>" alt="Image">
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="<?php echo $productData['productImage']; ?>" alt="Image">
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="<?php echo $productData['productImage']; ?>" alt="Image">
          </div>
          <div class="carousel-item">
            <img class="w-100 h-100" src="<?php echo $productData['productImage']; ?>" alt="Image">
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
          <small class="store-product-details-categories"
                 title="Categoría/s">CATEGORÍA/S: <?php echo $productData['productCategories']; ?>
          </small>
        </h4>

        <!-- Name /-->
        <h3><?php echo $productData['productName']; ?></h3>

        <!-- Comments /-->
        <div class="d-flex mb-1">
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
          <small class="pt-1">(<?php echo $countComments; ?> Comentarios)</small>
        </div>

        <!-- Views -->
        <div class="d-flex mb-1">
          <div class="text-primary mr-2">
            <small class="fas fa-eye"></small>
          </div>
          <small class="pt-1">(<?php echo $productData['productViews']; ?> Visitas) </small>
        </div>

        <!-- Likes -->
        <div class="d-flex mb-3">
          <div class="text-primary mr-2">
            <small class="fas fa-heart"></small>
          </div>
          <small class="pt-1">(<?php echo $productData['productLikes']; ?> Likes) </small>
        </div>

        <!-- Description /-->
        <h3 class="font-weight-semi-bold mb-4">$<?php echo $productData['productPrice']; ?></h3>
        <p class="mb-4"><?php echo $productData['productSpecifications']; ?></p>

        <!-- Brand /-->
        <div class="d-flex mb-3">
          <strong class="text-dark mr-3">Marca:</strong><?php echo $productData['productBrand']; ?>
        </div>

        <!-- Model /-->
        <div class="d-flex mb-3">
          <strong class="text-dark mr-3">Modelo:</strong><?php echo $productData['productModel']; ?>
        </div>

        <!-- Add to cart / Start -->
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
        <!-- Add to cart / End -->

        <!-- Share in / Start -->
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
        <!-- Share in / End -->

      </div>
    </div>
  </div>
  <div class="row px-xl-5">
    <div class="col">
      <div class="bg-light p-30">

        <!-- Tabs names -->
        <div class="nav nav-tabs mb-4">
          <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Comentarios</a>
        </div>

        <div class="tab-content">

          <!-- Comments tab / Start -->
          <div class="tab-pane fade show active" id="tab-pane-3">
            <div class="row">

              <!-- Comments list / Start -->
              <div class="col-md-6">
                <h4 class="mb-4"><?php echo $totalCommentsOfTheProduct; ?>"<?php echo $productData['productName']; ?>
                  "</h4>
                
                <?php foreach ($resultComments as $comment): ?>
                  <?php
                  $username = $objectUser->getUserById ($comment['comment_user']);
                  $commentText = $comment['comment_text'];
                  $commentDateCreation = date ("F j, Y, g:i a", strtotime ($comment['comment_date_creation']));
                  $commentScore = $comment['comment_score'];
                  ?>
                  <div class="media mb-4">
                    <img src="<?php echo $username['user_image']; ?>" alt="Image"
                         class="img-fluid mr-3 mt-1" style="width: 45px;">
                    <div class="media-body">
                      <h6><?php echo $username['user_name']; ?> <?php echo $username['user_last_name']; ?><small> -
                          <i><?php echo $commentDateCreation; ?></i></small></h6>
                      <div class="text-primary mb-2">
                        <?php for ($i = 1; $i <= $commentScore; $i++) : ?>
                          <i class="fas fa-star"></i>
                        <?php endfor; ?>
                        
                        <?php if ($commentScore < 5): ?>
                          <?php
                          $remaining = 5 - $commentScore;
                          for ($i = 1; $i <= $remaining; $i++) : ?>
                            <i class="far fa-star"></i>
                          <?php endfor; ?>
                        <?php endif; ?>

                      </div>
                      <p><?php echo $commentText; ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>

              </div>
              <!-- Comments list / End -->

              <!-- Leave a comment / Start -->
              <div class="col-md-6">
                <h4 class="mb-4">Dejar un comentario</h4>
                <small>Su dirección de correo electrónico no será publicada. Los campos obligatorios están marcados con
                  *</small>
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
                    <label for="message">Tu comentario *</label>
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
              <!-- Leave a comment / End -->

            </div>
          </div>
          <!-- Comments tab / End -->

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Shop Detail End -->
