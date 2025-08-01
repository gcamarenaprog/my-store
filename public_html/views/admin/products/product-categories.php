<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show categories product screen.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Files required
  require_once ('php/controllers/ProductCategoriesController.php');
  
  $categoryObject = new ProductCategoriesController();
  
?>

<!-- Head /-->
<head>
  
  <!-- DataTables /-->
  <link rel="stylesheet" href="public_html/resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="public_html/resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="public_html/resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <!-- Theme style personalized /-->
  <link rel="stylesheet" href="public_html/resources/dist/css/custom.css">

</head>

<!-- Header /-->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      
      <!-- Title /-->
      <div class="col-sm-6">
        <h1>Categorías de productos</h1>
      </div>
      
      <!-- Icon page /-->
      <div class="col-sm-6 store-icon-page">
        <ol class="breadcrumb float-sm-right">
          <i class="fa fa-list-check"></i>
        </ol>
      </div>
    
    </div>
  </div>
</section>
<!-- .content-header /-->

<!-- Main content /-->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      
      <!-- View category form /-->
      <div class="" id="viewCategoryForm" name="viewCategoryForm">
        <div class="card card-olive">
          
          <!-- Card: Header /-->
          <div class="card-header">
            
            <!-- Title card /-->
            <h5 class="store-card-title">
              <i class="fa-regular fa-square-check"></i>
              Detalles de la categoría
            </h5>
            
            <!-- Card tools /-->
            <div class="card-tools">
              
              <!-- Minimize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="collapse"
                      title="Minimizar  ">
                <i class="fas fa-minus"></i>
              </button>
              
              <!-- Refresh button /-->
              <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                      data-source="details"
                      data-source-selector="#card-refresh-content" data-load-on-init="false"
                      title=" Recargar ">
                <i class="fas fa-sync-alt"></i>
              </button>
              
              <!-- Maximize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="maximize"
                      title=" Minimizar"><i class="fas fa-expand"></i>
              </button>
            
            </div>
          
          </div>
          
          <!-- Card Content /-->
          <div class="card-body">
            <form action="" name="formViewCategory" id="formViewCategory">
              
              <!-- Id /-->
              <input type="hidden"
                     id="inputCategoryIdViewForm"
                     name="inputCategoryIdViewForm"
                     value="">
              
              <!-- Name /-->
              <div class="form-group">
                <label for="inputCategoryNameViewForm">Nombre</label>
                <input type="text"
                       class="form-control"
                       id="inputCategoryNameViewForm"
                       name="inputCategoryNameViewForm"
                       required
                       disabled
                       title="Nombre de la categoría"
                       value="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Nombre de la categoría.';
                       } ?>"
                       placeholder="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Nombre e la categoría';
                       } ?>">
                <div id="inputCategoryNameViewFormHelp"
                     class="store-form-help-visible">Nombre de la categoría del producto.</div>
              </div>
              
              <!-- Description /-->
              <div class="form-group">
                <label
                  for="textAreaCategoryDescriptionViewForm">Descripción</label>
                <textarea rows="3"
                          class="form-control"
                          id="textAreaCategoryDescriptionViewForm"
                          name="textAreaCategoryDescriptionViewForm"
                          required
                          disabled
                          title="Descripción de la categoría del producto"
                          placeholder="<?php if (isset($categoryData['product_category_description'])) {
                            echo $categoryData['product_category_description'];
                          } else {
                            echo 'Descripción de la categoría del producto';
                          } ?>"><?php if (isset($categoryData['product_category_description'])) {
                    echo $categoryData['product_category_description'];
                  } else {
                    echo 'Descripción de la categoría del producto.';
                  } ?>
                    </textarea>
                <div id="textAreaCategoryDescriptionViewFormHelp"
                     class="store-form-help-visible">Descripción de la categoría del producto.
                </div>
              </div>
              
              <!-- Parent category /-->
              <div class="form-group">
                <label
                  for="selectCategoryParentNameViewForm">Categoría padre</label>
                <select class="form-control select2"
                        style="width: 100%;"
                        id="selectCategoryParentNameViewForm"
                        name="selectCategoryParentNameViewForm"
                        disabled
                        title="Categoría padre"
                        required>
                  <?php
                    $result = $categoryObject->getAllCategories (); ?>
                  <option value="0">Sin categoría padre</option>
                  <?php foreach ($result as $index => $item) { ?>
                    
                    <option value="<?php echo $item['product_category_id']; ?>">
                      <?php echo $item['product_category_name']; ?>
                      <?php echo $item['product_category_name']; ?>
                    </option>';
                  <?php }
                  ?>
                
                </select>
                <div id="selectCategoryParentNameViewFormHelp"
                     class="store-form-help-visible">Categoría padre del producto, si la tiene.
                </div>
              </div>
              
              <!-- Number of products /-->
              <div class="form-group">
                <label
                  for="inputNumberOfProductsViewForm">Número de productos</label>
                <input type="text"
                       class="form-control"
                       id="inputNumberOfProductsViewForm"
                       name="inputNumberOfProductsViewForm"
                       required
                       disabled
                       title="Número de productos"
                       value="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Número de productos';
                       } ?>"
                       placeholder="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Número de productos';
                       } ?>">
                <div id="inputNumberOfProductsViewFormHelp"
                     class="store-form-help-visible">Número de productos en la categoría.</div>
              </div>
              
              <!-- Last change date /-->
              <div class="form-group" title="Fecha de última modificación">
                <p><b>Fecha de última modificación</b><br>
                  <span id="labelLastChangeDateViewForm"
                        name="labelLastChangeDateViewForm">Fecha de última modificación</span>
                </p>
              </div>
              
              <!-- Creation date /-->
              <div class="form-group" title="Fecha de creación">
                <p><b>Fecha de creación</b><br>
                  <span id="labelLastCreationDateViewForm"
                        name="labelLastCreationDateViewForm">Fecha de creación
                </p></span>
              </div>
              
              <!-- Buttons /-->
              <div class="row">
                
                <!-- Edit button /-->
                <button class="btn bg-gradient-blue mr-1"
                        type="button"
                        id="buttonSaveEditForm"
                        name="buttonSaveEditForm"
                        title="Editar"
                        onclick="viewEditCategoryFormFromViewForm()"
                >Editar
                </button>
                
                <!-- Cancel button /-->
                <button class="btn bg-gradient-danger "
                        type="button"
                        id="buttonCancelEditForm"
                        name="buttonCancelEditForm"
                        title="Cancelar"
                        onclick="viewAddNewCategoryForm()"
                >Cancelar
                </button>
              
              </div>
            
            </form>
          
          </div>
          
          <!-- Card: Loading /-->
          <div class="overlay-wrapper">
            <div class="overlay" id="loadingView" name="loadingView" style="visibility: hidden;">
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
      
      <!-- Edit category form /-->
      <div class="" id="editCategoryForm" name="editCategoryForm">
        <div class="card card-olive">
          
          <!-- Card: Header /-->
          <div class="card-header">
            
            <!-- Title card /-->
            <h5 class="store-card-title">
              <i class="fa-regular fa-pen-to-square"></i>
              Editar categoría
            </h5>

            <!-- Card tools /-->
            <div class="card-tools">

              <!-- Minimize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="collapse"
                      title="Minimizar  ">
                <i class="fas fa-minus"></i>
              </button>

              <!-- Refresh button /-->
              <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                      data-source="details"
                      data-source-selector="#card-refresh-content" data-load-on-init="false"
                      title=" Recargar ">
                <i class="fas fa-sync-alt"></i>
              </button>

              <!-- Maximize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="maximize"
                      title=" Minimizar"><i class="fas fa-expand"></i>
              </button>

            </div>
          
          </div>
          
          <!-- Card: Content /-->
          <div class="card-body">
            
            <form action="controllers/controllerProduct.php"
                  enctype="multipart/form-data"
                  method="post"
                  id="formUpdateCategory"
                  name="formUpdateCategory">
              
              <!-- Id /-->
              <input type="hidden"
                     id="inputCategoryIdEditForm"
                     name="inputCategoryIdEditForm"
                     value="">
              
              <!-- Name /-->
              <div class="form-group">
                <label for="inputCategoryNameEditForm">Nombre</label>
                <input type="text"
                       class="form-control"
                       id="inputCategoryNameEditForm"
                       name="inputCategoryNameEditForm"
                       required
                       title="Nombre"
                       value="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Nombre de la categoría';
                       } ?>"
                       placeholder="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Nombre de la categoría';
                       } ?>">
                <div id="inputCategoryNameEditFormHelp"
                     class="store-form-help-visible">Nombre de la categoría del producto</div>
              </div>
              
              <!-- Description /-->
              <div class="form-group">
                <label
                  for="textAreaCategoryDescriptionEditForm">Descripción de la categoría</label>
                <textarea rows="3"
                          class="form-control"
                          id="textAreaCategoryDescriptionEditForm"
                          name="textAreaCategoryDescriptionEditForm"
                          required
                          title="Descripción de la categoría"
                          placeholder="<?php if (isset($categoryData['product_category_description'])) {
                            echo $categoryData['product_category_description'];
                          } else {
                            echo 'Descripción de la categoría';
                          } ?>"><?php if (isset($categoryData['product_category_description'])) {
                    echo $categoryData['product_category_description'];
                  } else {
                    echo 'Descripción de la categoría';
                  } ?>
                    </textarea>
                <div id="textAreaCategoryDescriptionEditFormHelp"
                     class="store-form-help-visible">Descripción de la categoría
                </div>
              </div>
              
              <!-- Parent category /-->
              <div class="form-group">
                <label
                  for="selectCategoryParentNameEditForm">Categoría padre</label>
                <select class="form-control select2"
                        style="width: 100%;"
                        id="selectCategoryParentNameEditForm"
                        name="selectCategoryParentNameEditForm"
                        title="Categoría padre"
                        required>
                  <?php
                    $result = $categoryObject->getAllParentCategories ();
                    echo '<option value="0">Sin categoría padre</option>';
                    foreach ($result as $index => $item) { ?>
                      <option value="<?php echo $item['product_category_id']; ?>">
                        <?php echo $item['product_category_name']; ?>
                      </option>';
                    <?php }
                  ?>
                
                </select>
                <div id="selectCategoryParentNameEditFormHelp"
                     class="store-form-help-visible">Categoría padre del producto, si la tiene.
                </div>
              </div>
              
              <!-- Buttons /-->
              <div class="row">
                
                <!-- Update button /-->
                <button type="submit"
                        class="btn bg-gradient-blue mr-1"
                        id="buttonSaveEditForm"
                        name="buttonSaveEditForm"
                        title="Guardar cambios"
                >Guardar
                </button>
                
                <!-- Cancel button /-->
                <button class="btn bg-gradient-danger "
                        type="button"
                        id="buttonCancelEditForm"
                        name="buttonCancelEditForm"
                        title="Cancelar"
                        onclick="viewAddNewCategoryForm()"
                >Cancelar
                </button>
              
              </div>
            
            </form>
          
          </div>
          
          <!-- Card: Loading /-->
          <div class="overlay-wrapper">
            <div class="overlay" id="loadingEdit" name="loadingEdit" style="visibility: hidden;">
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
      
      <!-- Add new category form /-->
      <div class="" id="addNewCategoryForm" name="addNewCategoryForm">
        <div class="card card-olive">
          
          <!-- Card: Header /-->
          <div class="card-header">
            
            <!-- Title card /-->
            <h5 class="store-card-title">
              <i class="fa-regular fa-square-plus"></i></i>
              Añadir categoría</h5>

            <!-- Card tools /-->
            <div class="card-tools">

              <!-- Minimize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="collapse"
                      title="Minimizar  ">
                <i class="fas fa-minus"></i>
              </button>

              <!-- Refresh button /-->
              <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                      data-source="details"
                      data-source-selector="#card-refresh-content" data-load-on-init="false"
                      title=" Recargar ">
                <i class="fas fa-sync-alt"></i>
              </button>

              <!-- Maximize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="maximize"
                      title=" Minimizar"><i class="fas fa-expand"></i>
              </button>

            </div>
          
          </div>
          
          <!-- Card: Content /-->
          <div class="card-body">
            
            <!-- Form /-->
            <form action="controllers/controllerProduct.php"
                  enctype="multipart/form-data"
                  method="post"
                  id="formAddCategory"
                  name="formAddCategory">
              
              <!-- Name /-->
              <div class="form-group">
                <label for="inputCategoryNameAddForm">Nombre</label>
                <input type="text"
                       class="form-control"
                       id="inputCategoryNameAddForm"
                       name="inputCategoryNameAddForm"
                       required
                       title="Nombre de la categoría"
                       value=""
                       placeholder="<?php if (isset($categoryData['product_category_name'])) {
                         echo $categoryData['product_category_name'];
                       } else {
                         echo 'Nombre de la categoría';
                       } ?>">
                <div id="inputCategoryNameAddFormHelp"
                     class="store-form-help-visible">Nombre de la categoría</div>
              </div>
              
              <!-- Description /-->
              <div class="form-group">
                <label for="textAreaCategoryDescriptionAddForm">Descripción</label>
                <textarea rows="3"
                          class="form-control"
                          id="textAreaCategoryDescriptionAddForm"
                          name="textAreaCategoryDescriptionAddForm"
                          required
                          title="Descripción de la categoría"
                          placeholder="Descripción de la categoría"></textarea>
                <div id="textAreaCategoryDescriptionAddFormHelp"
                     class="store-form-help-visible">Descripción de la categoría
                </div>
              </div>
              
              <!-- Parent category /-->
              <div class="form-group">
                <label
                  for="selectCategoryParentNameAddForm">Categoría padre</label>
                <select class="form-control select2"
                        style="width: 100%;"
                        id="selectCategoryParentNameAddForm"
                        name="selectCategoryParentNameAddForm"
                        title="Categoría padre"
                        required>
                  <?php
                    $result = $categoryObject->getAllParentCategories (); ?>
                  <option value="0">Sin categoría padre</option>
                  <?php foreach ($result as $index => $item) { ?>
                    
                    <option value="<?php echo $item['product_category_id']; ?>">
                      <?php echo $item['product_category_name']; ?>
                    </option>';
                  <?php }
                  ?>
                
                </select>
                <div id="selectCategoryParentNameAddFormHelp"
                     class="store-form-help-visible">Categoría padre del producto, si existe
                </div>
              </div>
              
              <!-- Buttons /-->
              <div class="row">
                
                <!-- Add new button /-->
                <button type="submit"
                        class="btn bg-gradient-blue mr-1"
                        id="buttonAddAddForm"
                        name="buttonAddAddForm"
                        title="Añadir"
                >Añadir
                </button>
              
              </div>
            
            </form>
          
          </div>
          
          <!-- Card: Loading /-->
          <div class="overlay-wrapper">
            <div class="overlay" id="loadingAdd" name="loadingAdd" style="visibility: hidden;">
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
      
      <!-- List of product categories /-->
      <div class="" id="listCategoriesSubForm" name="listCategoriesSubForm">
        <div class="card card-outline card-olive">
          
          <!-- Card: Header /-->
          <div class="card-header">
            
            <!-- Subtitle /-->
            <h5 class="store-card-title">
              <i class="fa fa-list-check"></i>
              Lista de categorías
            </h5>

            <!-- Card tools /-->
            <div class="card-tools">

              <!-- Minimize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="collapse"
                      title="Minimizar  ">
                <i class="fas fa-minus"></i>
              </button>

              <!-- Refresh button /-->
              <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                      data-source="details"
                      data-source-selector="#card-refresh-content" data-load-on-init="false"
                      title=" Recargar ">
                <i class="fas fa-sync-alt"></i>
              </button>

              <!-- Maximize button /-->
              <button type="button" class="btn btn-tool" data-card-widget="maximize"
                      title=" Minimizar"><i class="fas fa-expand"></i>
              </button>

            </div>
          
          </div>
          
          <!-- Card: Content /-->
          <div class="card-body">
            <table id="tableProductCategories" class="table table-bordered table-striped">
              <thead>
              
              <tr>
                <th>ID</th>
                <th>Herramientas</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Número de productos</th>
                <th>Categoría padre</th>
                <th>Último cambio</th>
                <th>Fecha de creación</th>
              </tr>
              </thead>
              <tbody style="text-align: center;">
              <!-- Show content /-->
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Herramientas</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Número de productos</th>
                <th>Categoría padre</th>
                <th>Último cambio</th>
                <th>Fecha de creación</th>
              </tr>
              </tfoot>
            </table>
          </div>
          
          <!-- Card: Loading /-->
          <div class="overlay-wrapper">
            <div class="overlay" id="loadingTable" name="loadingTable" style="visibility: hidden;">
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
    
    </div>
    <!-- .row /-->
  </div>
  <!-- .container-fluid /-->
</div>
<!-- .content /-->

<!-- jQuery /-->
<script src="public_html/resources/plugins/jquery/jquery.min.js"></script>

<!-- Custom JS Code /-->
<script src="public_html/js/js-functions.js"></script>

<!-- Custom JS Code /-->
<script src="public_html/js/js-product-categories.js"></script>

<!-- jquery-validation /-->
<script src="public_html/resources/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="public_html/resources/plugins/jquery-validation/additional-methods.min.js"></script>