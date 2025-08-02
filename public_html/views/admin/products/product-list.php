<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show the list of products of the inventory.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */

?>

<head>
  
  <!-- DataTables /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'>
  <link rel='stylesheet' href='public_html/resources/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'>
  <link rel='stylesheet' href='public_html/resources/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'>
  
  <!-- Theme style personalized /-->
  <link rel='stylesheet' href='public_html/resources/admin/dist/css/custom.css'>

</head>

<!-- Header /-->
<div class='content-header'>
  <div class='container-fluid'>
    <div class='row mb-2'>
      
      <!-- Title /-->
      <div class='col-sm-6'>
        <h1>Inventario</h1>
      </div>
      
      <!-- Icon page /-->
      <div class='col-sm-6 store-icon-page'>
        <ol class='breadcrumb float-sm-right'>
          <i class='fa fa-truck-ramp-box'></i>
        </ol>
      </div>
    
    </div><!-- .row mb-2 /-->
  </div> <!-- .container-fluid /-->
</div><!-- .content-header /-->

<!-- Content /-->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        
        <!-- Card /-->
        <div class="card card-outline card-olive">
          
          <!-- Card: Header /-->
          <div class="card-header">
            
            <!-- Card: Title /-->
            <h5 class="store-card-title">
              <i class="fa fa-truck-ramp-box"></i>
              Lista de productos
            </h5>
            
            <!-- Card: Tools /-->
            <div class="card-tools text-right">
              
              <!-- Minimize button /-->
              <button type='button'
                      class='btn btn-tool'
                      data-card-widget='collapse'
                      title='Minimizar'>
                <i class='fas fa-minus'></i>
              </button>
              
              <!-- Refresh button /-->
              <button type='button'
                      class='btn btn-tool'
                      data-card-widget='card-refresh'
                      data-source='widgets.html'
                      data-source-selector=''#card-refresh-content'
                      data-load-on-init='false'
                      title='Actualizar'>
                <i class='fas fa-sync-alt'></i>
              </button>
              
              <!-- Maximize button /-->
              <button type='button'
                      class='btn btn-tool'
                      data-card-widget='maximize'
                      title='Maximizar'>
                <i class='fas fa-expand'></i>
              </button>
            
            </div>
          
          </div>
          
          <!-- Card: Body /-->
          <div class="card-body">
            <table id="tableProducts" class="table table-bordered table-striped">
              
              <thead>
              <tr>
                <th>ID</th>
                
                <th class="notexport">Herramientas</th>
                <th class="notexport">Imágen</th>
                
                <th>Nombre</th>
                <th>Descripción</th>
                
                <th>Precio</th>
                <th>Cantidad</th>
                
                <th>Categoría</th>
                
                <th>Marca</th>
                <th>Modelo</th>
                <th>Visitas</th>
                
                <th>Likes</th>
                <th>Comentarios</th>
                
                <th class="notexport">Fecha de actualización</th>
                <th class="notexport">Fecha de creación</th>
              </tr>
              </thead>
              <tbody style="text-align: center;">
              <!-- Show content -->
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>

                <th class="notexport">Herramientas</th>
                <th class="notexport">Imágen</th>

                <th>Nombre</th>
                <th>Descripción</th>

                <th>Precio</th>
                <th>Cantidad</th>

                <th>Categoría</th>

                <th>Marca</th>
                <th>Modelo</th>
                <th>Visitas</th>

                <th>Likes</th>
                <th>Comentarios</th>

                <th class="notexport">Fecha de actualización</th>
                <th class="notexport">Fecha de creación</th>
              </tr>
              </tfoot>
            
            </table>
          </div>
          
          <!-- Card: Loading /-->
          <div class="overlay-wrapper">
            <div class="overlay" id="loading" name="loading" style="visibility: hidden;">
              <i class="fas fa-3x fa-sync-alt fa-spin"></i>
              <div class="text-bold pt-2">Cargando</div>
            </div>
          </div>
          
          <!-- Card: Footer /-->
          <div class="card-footer text-right bg-gradient-olive">
            <?php echo SYSTEM_FULL_NAME; ?>
          </div>
        
        </div><!-- .Card /-->
      
      </div><!-- .col-md-12 /-->
    </div> <!-- .row /-->
  </div><!-- .container-fluid /-->
</div><!-- .content /-->

<!-- jQuery -->
<script src='public_html/resources/admin/plugins/jquery/jquery.min.js'></script>

<!-- Custom JS Code -->
<script src='public_html/js/js-functions.js'></script>

<!-- Custom view JS Code -->
<script src='public_html/js/js-product-list.js'></script>

<script>
</script>