<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show the edit product screen.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  require_once ('php/controllers/ProductCategoriesController.php');
  require_once ('php/controllers/ProductController.php');
  require_once ('php/includes/functions.php');
  
  $objectCategoriesProduct = new ProductCategoriesController();
  $objectProduct = new ProductController();
  $objectFunctions = new Functions();
  
  # Get product id to details view it
  if (isset($_SESSION['viewProductSessionFlag'])) {
    
    # Get product id from session var
    $productId = $_SESSION['viewProductSessionFlag'];
    
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
    header ('Location: ' . 'product-list');
  }

?>

<!-- Header /-->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      
      <!-- Title /-->
      <div class="col-sm-6">
        <h1>Inventario</h1>
      </div>
      
      <!-- Icon /-->
      <div class="col-sm-6 store-icon-page">
        <ol class="breadcrumb float-sm-right">
          <i class="fas fa-box"></i>
        </ol>
      </div>
    
    </div><!--.content-header /-->
  </div><!--.container-fluid /-->
</div><!--.row mb-2 /-->

<!-- Content /-->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
        <!-- Card /-->
        <div class="card card-olive">
          
          <!-- Card: Header /-->
          <div class="card-header">
            
            <!-- Card: Title /-->
            <h5 class="store-card-title">
              <i class="fas fa-box"></i>
              Detalle del producto
            </h5>
            
            <!-- Card: Tools /-->
            <div class="card-tools text-right">
              
              <!-- Button: Maximize /-->
              <button type="button"
                      class="btn btn-tool"
                      data-card-widget="maximize"
                      title=" Maximizar ">
                <i class="fas fa-expand"></i>
              </button>
            
            </div>
          
          </div>
          
          <!-- Card: Body /-->
          <div class="card-body">
            
            <div class="card card-olive card-outline">
              <div class="card-body">
                
                <!-- Main section: Image and data /-->
                <div class="row">
                  
                  <!-- Image/-->
                  <div class="col-12 col-sm-6">
                    
                    <!-- Main title above image /-->
                    <h3 class="d-inline-block d-sm-none" title="Imágen del producto">
                      <?php echo $productName; ?>
                    </h3>
                    
                    <!-- Image /-->
                    <div class="col-12">
                      <a href="<?php echo $productImage; ?>"
                         data-toggle="lightbox"
                         data-title="<?php echo $productName; ?>"
                         title="Ver imágen"
                         data-footer="<?php echo $productName; ?>">
                        <img src="<?php echo $productImage; ?>"
                             class="img-thumbnail img-fluid"
                             alt="<?php echo $productImage; ?>">
                      </a>
                    </div>
                  
                  </div>
                  
                  <!-- Data /-->
                  <div class="col-12 col-sm-6">
                    
                    <!-- Category/ies /-->
                    <h4>
                      <small class="store-product-details-categories" title="Categoría/s"> <?php echo $productCategories; ?></small>
                    </h4>
                    
                    <!-- Name /-->
                    <h3 class="my-3 store-product-details-title" title="Nombre del producto">
                      <?php echo $productName; ?></h3>
                    
                    <!-- Specifications /-->
                    <h4 title="Descripción">
                      <small><?php echo $productDescription; ?></small></h4>
                    
                    <hr>

                    <!-- Price /-->
                    <h4 class="mt-3 store-product-details-data-name" title="Precio">
                      Precio<br>
                      <small class="store-product-details-data-info">
                        $<?php echo $productPrice; ?> MXN
                      </small>
                    </h4>
                    
                    <!-- Brand /-->
                    <h4 class="mt-3 store-product-details-data-name" title="Marca">
                      Marca<br>
                      <small class="store-product-details-data-info">
                        <?php echo $productBrand; ?>
                      </small>
                    </h4>
                    
                    <!-- Model /-->
                    <h4 class="mt-3 store-product-details-data-name" title="Modelo">
                      Modelo<br>
                      <small class="store-product-details-data-info">
                        <?php echo $productModel; ?>
                      </small>
                    </h4>
                    
                    <!-- Views /-->
                    <h4 class="mt-3 store-product-details-data-name" title="Visitas">
                      Visitas<br>
                      <small class="store-product-details-data-info">
                        <?php echo $productViews; ?>
                      </small>
                    </h4>
                    
                    <!-- Likes /-->
                    <h4 class="mt-3 store-product-details-data-name" title="Likes">
                      Likes<br>
                      <small class="store-product-details-data-info">
                        <?php echo $productLikes; ?>
                      </small>
                    </h4>
                    
                    <!-- Comment /-->
                    <h4 class="mt-3 store-product-details-data-name"
                        title="Número de comentarios">
                      Comentarios<br>
                      <small class="store-product-details-data-info">
                        <?php echo $productCommentId; ?>
                      </small>
                    </h4>
                  
                  </div>
                
                </div>
                
                <hr>
                
                <!-- Tabs /-->
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="card card-olive card-outline card-outline-tabs">
                      
                      <!-- Tabs: Titles /-->
                      <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                          
                          <!-- Tabs title: Product data /-->
                          <li class="nav-item">
                            <a class="nav-link active"
                               id="custom-tabs-four-product-data-tab"
                               data-toggle="pill"
                               href="#custom-tabs-four-product-data"
                               role="tab"
                               aria-controls="custom-tabs-four-product-data"
                               aria-selected="false">
                              <h5 class="store-card-subtitle-2">
                                <i class="fas fa-bars"></i> Datos del producto
                              </h5></a>
                          </li>
                          
                          <!-- Tabs title: Post data /-->
                          <li class="nav-item">
                            <a class="nav-link"
                               id="custom-tabs-four-post-data-tab"
                               data-toggle="pill"
                               href="#custom-tabs-four-post-data"
                               role="tab"
                               aria-controls="custom-tabs-four-post-data"
                               aria-selected="false">
                              <h5 class="store-card-subtitle-2">
                                <i class="fas fa-eye"></i> Metadata
                              </h5></a>
                          </li>

                          <!-- Tabs title: Monthly payments /-->
                          <li class="nav-item">
                            <a class="nav-link"
                               id="custom-tabs-four-post-data-tab"
                               data-toggle="pill"
                               href="#custom-tabs-four-monthly-data"
                               role="tab"
                               aria-controls="custom-tabs-four-post-data"
                               aria-selected="false">
                              <h5 class="store-card-subtitle-2">
                                <i class="fas fa-calculator"></i> Calculadora de mensualidades
                              </h5></a>
                          </li>
                          
                        </ul>
                      </div>
                      
                      <!-- Tabs: Contents /-->
                      <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                          
                          <!-- Tab content: Product data /-->
                          <div class="tab-pane fade show active"
                               id="custom-tabs-four-product-data"
                               role="tabpanel"
                               aria-labelledby="custom-tabs-four-product-data-tab">
                            
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                
                                <!-- Name /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Nombre del producto">
                                  Nombre del producto<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productName; ?>
                                  </small>
                                </h4>
                                
                                <!-- Specifications /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Especificaciones del producto.">
                                  Especificaciones<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productDescription; ?>
                                  </small>
                                </h4>
                                
                                <!-- Price /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Precio">
                                  Precio<br>
                                  <small class="store-product-details-data-info">
                                    $<?php echo $productPrice; ?> MXN
                                  </small>
                                </h4>
                                
                                <!-- Categories /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Categoría/s">
                                  Categoría/s<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productCategory; ?>
                                  </small>
                                </h4>

                                <!-- Brand /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Marca">
                                  Marca<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productBrand; ?>
                                  </small>
                                </h4>

                                <!-- Model /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Modelo">
                                  Modelo<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productModel; ?>
                                  </small>
                                </h4>
                              
                              </div>
                            </div>
                          
                          </div>
                          
                          <!-- Tab content: Post data /-->
                          <div class="tab-pane fade"
                               id="custom-tabs-four-post-data"
                               role="tabpanel"
                               aria-labelledby="custom-tabs-four-post-data-tab">
                            
                            <div class="row">
                              <div class="col-12 col-sm-6">


                                <!-- Product registration date /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Visitas">
                                  Visitas<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productViews; ?>
                                  </small>
                                </h4>
                                
                                <!-- Las change date /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title=" Fecha de última modificación del producto">
                                  Fecha de última modificación<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productDateLastChange; ?>
                                  </small>
                                </h4>
                                
                                <!-- Creation date /-->
                                <h4 class="mt-3 store-product-details-data-name"
                                    title="Fecha de registro del producto">
                                  Fecha de registro<br>
                                  <small class="store-product-details-data-info">
                                    <?php echo $productDateCreation; ?>
                                  </small>
                                </h4>
                              
                              </div>
                            </div>
                          
                          </div>

                          <!-- Tab content: Calculator /-->
                          <div class="tab-pane fade"
                               id="custom-tabs-four-monthly-data"
                               role="tabpanel"
                               aria-labelledby="custom-tabs-four-proposals-tab">

                            <div class="row">
                              <div class="col-sm-12 col-xs-12">

                                <!-- General data /-->
                                <div class="row">

                                  <!-- Column 1: Data /-->
                                  <div class="col-6">

                                    <!-- Name /-->
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Nombre del producto">
                                      Nombre del producto<br>
                                      <small class="store-product-details-data-info">
                                        <?php echo $productName; ?>
                                      </small>
                                    </h4>

                                    <!-- Specifications /-->
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Especificaciones del producto.">
                                      Especificaciones<br>
                                      <small class="store-product-details-data-info">
                                        <?php echo $productDescription; ?>
                                      </small>
                                    </h4>

                                  </div>

                                  <!-- Column 2: Data /-->
                                  <div class="col-6">

                                    <!-- Quantity /-->
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Cantidad en stock">
                                     Cantidad<br>
                                      <small class="store-product-details-data-info">
                                        <?php echo $productQuantity; ?>
                                      </small>
                                    </h4>

                                    <!-- Price /-->
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Precio">
                                     Precio<br>
                                      <small class="store-product-details-data-info" id="labelPrices">
                                        $<?php echo $productPrice; ?> MXN
                                      </small>
                                    </h4>

                                  </div>
                                </div>

                                <hr>

                                <!-- Proposals: Unit price | Exchange rate | Quantity /-->
                                <div class="row">

                                  <!-- Price /-->
                                  <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Precio">
                                      Precio<br>
                                      <small class="store-product-details-data-info">
                                        $<?php echo $productPrice; ?> MXN
                                      </small>
                                    </h4>
                                  </div>

                                  <!-- Interest rate % /-->
                                  <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Interés anual">
                                      Interés anual<br>
                                      <small class="store-product-details-data-info">
                                        <select class="custom-select"
                                                id="selectCalculatorInterest"
                                                name="selectCalculatorInterest">
                                          <option value="5">5%</option>
                                          <option selected value="10">10%</option>
                                          <option value="15">15%</option>
                                          <option value="20">20%</option>
                                          <option value="25">25%</option>
                                          <option value="30">30%</option>
                                          <option value="35">35%</option>
                                          <option value="40">40%</option>
                                        </select>
                                      </small>
                                    </h4>
                                  </div>

                                  <!-- Monthly payment /-->
                                  <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Mensualidades">
                                      Mensualidades<br>
                                      <small class="store-product-details-data-info">
                                        <select class="custom-select"
                                                id="selectCalculatorMonthlyPayment"
                                                name="selectCalculatorMonthlyPayment">
                                          <option value="1">1</option>
                                          <option  value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option selected value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                          
                                        </select>
                                      </small>
                                    </h4>
                                  </div>

                                </div>

                                <!-- Calculator Total /-->
                                <div class="row">

                                  <!-- Total /-->
                                  <div class="col-xl-4 col-md-4 col-sm-6 col-xs-12">
                                    <h4 class="mt-3 store-product-details-data-name"
                                        title="Mensualidad (cuota que buscas)">
                                      Mensualidad (cuota que buscas)<br>
                                      <small class="store-product-details-data-info"
                                             style="font-weight: bold"
                                             id="labelTotal"
                                             name="labelTotal">
                                        $ 0.00 MXN
                                      </small>
                                    </h4>
                                  </div>

                                </div>

                              </div>

                            </div>
                          </div>
                        
                        </div>
                      
                      </div>
                    
                    </div>
                  </div>
                </div>
              
              </div>
              <!-- .card-body /-->
            </div>
            <!-- .card card-olive card-outline /-->
          
          </div>
          
          <!-- Card: Loading /-->
          <div class="overlay-wrapper">
            <div class="overlay" id="loading" name="loading" style="visibility: hidden;">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
              <div class="text-bold pt-2">Cargando...</div>
            </div>
          </div>

          <!-- Card: Footer /-->
          <div class="card-footer text-right bg-gradient-olive">
            <?php echo SYSTEM_FULL_NAME; ?>
          </div>
        
        </div>
      
      </div>
      <!-- .col-md-12 /-->
    </div>
    <!-- .row /-->
  </div>
  <!-- .container-fluid /-->
</div>
<!-- Content /-->

<script>
  let valuePrice = '<?php echo $productPriceClean; ?>';
</script>

<!-- jQuery -->
<script src="public_html/resources/admin/plugins/jquery/jquery.min.js"></script>

<!-- jquery-validation -->
<script src="public_html/resources/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="public_html/resources/admin/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- Custom JS Code -->
<script src="public_html/js/js-functions.js"></script>

<!-- Custom view JS Code -->
<script src="public_html/js/js-product-view.js"></script>

