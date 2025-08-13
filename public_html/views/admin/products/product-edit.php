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
  
  $objectProduct = new ProductController();
  $objectCategoriesProduct = new ProductCategoriesController();
  
  $allProductCategories = $objectCategoriesProduct->getCategoriesList ('ASC');
  
  # Get product id to edit view it
  if (isset($_SESSION['editProductSessionFlag'])) {
    
    # Get product id from session var
    $productId = $_SESSION['editProductSessionFlag'];
    
    $productData = $objectProduct->getProduct ($productId);
    
    $productName = $productData['product_name'];
    $productDescription = $productData['product_specs'];
    $productCategories = $productData['product_categories'];
    $productPrice = $productData['product_price'];
    $productQuantity = $productData['product_quantity'];
    $productBrand = $productData['product_brand'];
    $productModel = $productData['product_model'];
    $productViews = $productData['product_views'];
    $productLikes = $productData['product_likes'];
    $productCommentId = $productData['product_comment_id'];
    $productImage = $productData['product_image'];
    $productDateLastChange = $productData['product_date_last_change'];
    $productDateCreation = $productData['product_date_creation'];
    
  } else {
    header ('Location: ' . 'product-list');
  }
  $categoriesIds = explode (",", $productCategories);

?>

<!-- Title /-->
<div class='content-header'>
  <div class='container-fluid'>
    <div class='row mb-2'>
      
      <!-- Title module /-->
      <div class='col-sm-6'>
        <h1>Editar producto</h1>
      </div>
      
      <!-- Icon module /-->
      <div class='col-sm-6 store-icon-page'>
        <ol class='breadcrumb float-sm-right'>
          <i class='fa fa-box-open'></i>
        </ol>
      </div>
    
    </div>
  </div>
</div>

<!-- Content /-->
<div class='content'>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-md-12'>
        
        <!-- Card /-->
        <div class='card card-olive'>
          
          <!-- Card: Header /-->
          <div class='card-header'>
            
            <!-- Card: Title /-->
            <h5 class='store-card-title'>
              <i class='fa fa-boxes-packing'></i>
              Datos del producto
            </h5>
            
            <!-- Card: Tools /-->
            <div class='card-tools text-right'>
              
              <!-- Button: Clean /-->
              <button type='button'
                      class='btn btn-tool'
                      data-card-widget='card-refresh'
                      data-source='productEdit'
                      data-source-selector='#card-refresh-content'
                      data-load-on-init='false'
                      onclick='cleanEditProductForm()'
                      title='Limpiar'>
                <i class='fa-solid fa-eraser'></i>
              </button>
              
              <!-- Button: Refresh /-->
              <button type="button"
                      class="btn btn-tool"
                      data-card-widget="card-refresh"
                      data-source="productEdit"
                      data-source-selector="#card-refresh-content"
                      data-load-on-init="false"
                      title="Actualizar">
                <i class="fas fa-sync-alt"></i>
              </button>
              
              <!-- Button: Maximize /-->
              <button type='button'
                      class='btn btn-tool'
                      data-card-widget='maximize'
                      title='Maximizar '>
                <i class='fas fa-expand'></i>
              </button>
              
              <!-- Button: Help show /-->
              <button type='button'
                      class='btn btn-tool'
                      onclick='showHelpForm()'
                      id='helpToolButtonInactive'
                      title='Mostrar ayuda'>
                <i class='fas fa-question'></i>
              </button>
              
              <!-- Button: Help hidden /-->
              <button type='button'
                      class='btn btn-tool'
                      onclick='hiddenHelpForm()'
                      id='helpToolButtonActive'
                      style='display: none'
                      title='Ocultar ayuda'>
                <i class='fa-solid fa-question fa-shake'></i>
              </button>
            
            </div>
          
          </div>
          
          <!-- Card: Body /-->
          <div class='card-body'>
            
            <!-- Form /-->
            <form action='php/controllers/ProductController.php'
                  enctype='multipart/form-data'
                  method='post'
                  id='editProductForm'
                  name='editProductForm'>
              
              <div class='row'>
                
                <!-- Card: Description /-->
                <div class='col-md-12'>
                  <p>Los campos con asteriscos (*) son obligatorios</p>
                </div>
                
                <!-- Sub-card: Product data and inventory /-->
                <div class="col-lg-6 mb-6">
                  <div class="card card-olive card-outline store-height">
                    
                    <!-- Sub-card: Header /-->
                    <div class="card-header">
                      <h5 class="card-text">
                        <i class="fas fa-box-open"></i>
                        Datos del producto e inventario
                      </h5>
                    </div>
                    
                    <!-- Sub-card: Body /-->
                    <div class="card-body">
                      
                      <!-- Section: Data /-->
                      <section>
                        
                        <!-- Section: Title /-->
                        <h5 class="store-card-subtitle-2">
                          <i class="fas fa-bars"></i>
                          Datos del producto
                        </h5>
                        
                        <!-- Name /-->
                        <div class="form-group">
                          <label for="inputName">Nombre *</label>
                          <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="inputName"
                                   name="inputName"
                                   title='Nombre'
                                   required
                                   value="<?php echo $productName; ?>"
                                   placeholder="Nombre del producto">
                          </div>
                          <div id="inputNameHelp" class="store-form-help">Nombre del producto</div>
                        </div>
                        
                        <!-- Specifications /-->
                        <div class="form-group">
                          <label for="textAreaSpecifications">Especificaciones *</label>
                          <div class="input-group">
                          <textarea class="form-control"
                                    id="textAreaSpecifications"
                                    name="textAreaSpecifications"
                                    title="Especificaciones del producto"
                                    required
                                    rows="7"
                                    placeholder="Especificaciones del producto"><?php echo $productDescription; ?></textarea>
                          </div>
                          <div id="textAreaSpecificationsHelp"
                               class="store-form-help">Especificaciones del producto</div>
                        </div>


                        <!-- Brand /-->
                        <div class="form-group">
                          <label for="inputBrand">Marca *</label>
                          <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="inputBrand"
                                   name="inputBrand"
                                   title='Marca del producto'
                                   required
                                   value="<?php echo $productBrand; ?>"
                                   placeholder="Marca del producto">
                          </div>
                          <div id="inputBrandHelp" class="store-form-help">Marca del producto</div>
                        </div>



                        <!-- Model /-->
                        <div class="form-group">
                          <label for="inputModel">Modelo *</label>
                          <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="inputModel"
                                   name="inputModel"
                                   title='Modelo del producto'
                                   required
                                   value="<?php echo $productModel; ?>"
                                   placeholder="Modelo del producto">
                          </div>
                          <div id="inputModelHelp" class="store-form-help">Modelo del producto</div>
                        </div>


                        <!-- Price /-->
                        <div class="form-group">
                          <label for="inputPrice">Precio *</label>
                          <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="inputPrice"
                                   name="inputPrice"
                                   title='Precio del producto'
                                   oninput="this.value = this.value.replace(/[^.0-9]/,'')"
                                   required
                                   value="<?php echo $productPrice; ?>"
                                   placeholder="Precio del producto">
                          </div>
                          <div id="inputPriceHelp" class="store-form-help">Precio del producto</div>
                        </div>


                        <!-- Quantity /-->
                        <div class="form-group">
                          <label for="inputQuantity">Cantidad *</label>
                          <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="inputQuantity"
                                   name="inputQuantity"
                                   title='Cantidad de producto'
                                   required
                                   value="<?php echo $productQuantity; ?>"
                                   placeholder="Cantidad de producto">
                          </div>
                          <div id="inputQuantityHelp" class="store-form-help">Cantidad de producto</div>
                        </div>

                      </section>
                      
                      <hr class="store-border-olive">
                      
                      <!-- Section: Meta /-->
                      <section>
                        
                        <!-- Inventory title /-->
                        <h5 class="store-card-subtitle-2">
                          <i class="fa-solid fa-eye"></i>
                          Metadatos
                        </h5>

                        <!-- Views -->
                        <div class="form-group">
                          <label for="inputViews">Visitas *</label>
                          <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   disabled
                                   id="inputViews"
                                   name="inputViews"
                                   title="Número de visitas"
                                   min="0"
                                   required
                                   value="<?php echo $productViews; ?>"
                                   placeholder="Número de visitas">
                          </div>
                          <div id="inputViewsHelp"
                               class="store-form-help">Número de visitas
                          </div>
                        </div>

                        <!-- Likes -->
                        <div class="form-group">
                          <label for="inputLikes">Likes *</label>
                          <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="inputLikes"
                                   name="inputLikes"
                                   disabled
                                   title="Número de likes"
                                   min="0"
                                   required
                                   value="<?php echo $productLikes; ?>"
                                   placeholder="Número de likes">
                          </div>
                          <div id="inputLikesHelp"
                               class="store-form-help">Número de likes
                          </div>
                        </div>


                        <!-- Comments -->
                        <div class="form-group">
                          <label for="inputComments">Número de comentarios</label>
                          <div class="input-group">
                            <input type="number"
                                   class="form-control"
                                   id="inputComments"
                                   name="inputComments"
                                   disabled
                                   title="Número de comentarios"
                                   min="0"
                                   required
                                   value="<?php echo $productCommentId; ?>"
                                   placeholder="Número de comentarios">
                          </div>
                          <div id="inputCommentsHelp"
                               class="store-form-help">Número de comentarios
                          </div>
                        </div>

                        <hr>
                        
                        <!-- Date last change -->
                        <div class="form-group">
                          <label for="inputDateLastChange">Fecha de última modificación</label>
                          <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="inputDateLastChange"
                                   name="inputDateLastChange"
                                   disabled
                                   title="Fecha de última modificación"
                                   required
                                   value="<?php echo $productDateLastChange; ?>"
                                   placeholder=""Fecha de última modificación">
                          </div>
                          <div id="inputDateLastChangeHelp"
                               class="store-form-help">Fecha de última modificación
                          </div>
                        </div>


                        <!-- Date creation -->
                        <div class="form-group">
                          <label for="inputDateCreation">Fecha de creación</label>
                          <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="inputDateCreation"
                                   name="inputDateCreation"
                                   disabled
                                   title="Fecha de creación"
                                   required
                                   value="<?php echo $productDateLastChange; ?>"
                                   placeholder="Fecha de creación">
                          </div>
                          <div id="inputDateCreationHelp"
                               class="store-form-help">Fecha de creación
                          </div>
                        </div>
                      
                      </section>
                    
                    </div>
                  
                  </div>
                </div>
                
                <!-- Sub-card: Image, post and categories /-->
                <div class="col-lg-6 mb-6">
                  <div class="card card-olive card-outline store-height">
                    
                    <!-- Sub-card: Header /-->
                    <div class="card-header">
                      <h5 class="card-text" ">
                      <i class="fas fa-file-lines"></i>
                      Imagen y categoría/s
                      </h5>
                    </div>
                    
                    <!-- Sub-card: Body /-->
                    <div class="card-body">
                      
                      <!-- Section: Image /-->
                      <section>
                        
                        <!-- Image title -->
                        <h5 class="card-text">
                          <i class="fas fa-image"></i>
                          Imagen
                        </h5>
                        
                        <!-- Image /-->
                        <div class="form-group">
                          <label for="textAreaImageDescription">Imagen del producto</label>
                          <div class="text-center">
                            <img src="<?php echo $productImage; ?>"
                                 
                                 class="img-thumbnail"
                                 id="imageProduct"
                                 title="Imágen del producto"
                                 alt="...">
                            <div id="imageProductHelp"
                                 class="store-form-help">Imágen del producto</div>
                          </div>
                        </div>
                        
                        <!-- Image upload /-->
                        <div class="form-group">
                          <label for="customFile">Archivo de imagen</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file"
                                     class="custom-file-input"
                                     id="customFile"
                                     name="customFile"
                                     title="Selecciona una imagen para el producto">
                              <label class="custom-file-label"
                                     for="customFile">Selecciona un archivo</label>
                            </div>
                          </div>
                          <ul id="customFileHelp"
                              class="store-product-add-new-help-file">
                            <li>Formatos de imagen soportados: *.jpg y *.png</li>
                            <li>El tamaño de archivo no debe ser mayor a 2 Mb</li>
                          </ul>
                        </div>
                      
                      </section>
                      
                      <hr class="store-border-olive">
                     
                      <!-- Section: Categories /-->
                      <section>
                        
                        <!-- Post title /-->
                        <h5 class="store-card-subtitle-2">
                          <i class="fas fa-list-check"></i>
                          Categorías
                        </h5>
                        
                        <!-- Categories /-->
                        <div class="form-group">
                          <label for="selectCategories">Categorías *</label>
                          <select class="select2"
                                  style="width: 100%;"
                                  id="selectCategories"
                                  name="selectCategories[]"
                                  title="Selecciona una categoría/s"
                                  multiple="multiple"
                                  required
                                  data-placeholder="Selecciona categorías"
                          ">
                          <?php foreach ($allProductCategories as $element): ?>
                            <option
                              value="<?php echo $element['product_category_id']; ?>"><?php echo $element['product_category_name'] ?></option>
                          <?php endforeach; ?>
                          </select>
                          <div id="selectCategoriesHelp"
                               class="store-form-help">Seleccione una categoría o categorías del nuevo producto.
                          </div>
                        </div>
                      
                      </section>
                    
                    </div>
                  
                  </div>
                </div>
              
              </div>
              
              <!-- Button: Update /-->
              <button type="submit"
                      class="btn btn-primary"
                      id="buttonUpdate"
                      name="buttonUpdate"
                      title="Actualizar datos"
                      disabled>
                Actualizar
              </button>
            
            </form>
          
          </div>
          
          <!-- Card: Loading /-->
          <div class='overlay-wrapper'>
            <div class='overlay' id='loading' name='loading' style='visibility: hidden;'>
              <i class='fas fa-3x fa-sync-alt fa-spin'></i>
              <div class='text-bold pt-2'>Cargando...</div>
            </div>
          </div>

          <!-- Card: Footer /-->
          <div class='card-footer text-right bg-gradient-olive'>
            <?php echo SYSTEM_FULL_NAME; ?>
          </div>
        
        </div>
      
      </div><!-- .col-md-12 /-->
    </div><!-- .row /-->
  </div><!-- .container-fluid /-->
</div><!-- .content /-->

<!-- jQuery -->
<script src='public_html/resources/admin/plugins/jquery/jquery.min.js'></script>

<!-- jquery-validation -->
<script src='public_html/resources/admin/plugins/jquery-validation/jquery.validate.min.js'></script>
<script src='public_html/resources/admin/plugins/jquery-validation/additional-methods.min.js'></script>

<!-- bs-custom-file-input -->
<script src='public_html/resources/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js'></script>

<!-- Custom JS Code -->
<script src='public_html/js/js-functions.js'></script>

<!-- Custom view JS Code -->
<script src='public_html/js/admin/js-product-edit.js'></script>

<script>

  // Set selected categories
  $('#selectCategories').val([  <?php
    foreach ($categoriesIds as $id) {
      echo $id . ',';
    }
    ?>]).trigger('change');

 
  // Pass PHP variables to JavaScript
  let product_id = '<?php echo $productId; ?>';

</script>
