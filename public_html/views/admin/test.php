<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           View file
   * File description:    This file show the home screen.
   * Module:              Views
   * -------------------------------------------------------------------------------------------------------------------
   */
  

?>

<!-- Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      
      <!-- Title -->
      <div class="col-sm-6">
        <h1>
          Bienvenido <b> <?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname']; ?></b>
        </h1>
      </div>
      
      <!-- Icon page -->
      <div class="col-sm-6 store-icon-page">
        <ol class="breadcrumb float-sm-right">
          <i class="fa fa-home"></i>
        </ol>
      </div>
    
    </div>
  </div>
</section>

<!-- Content -->
<section class="content">
  <div class="container-fluid">
    
    <!-- Counters and fast access -->
    <div class="card ">
      
      <!-- Card body -->
      <div class="card-body">
        
        <!-- Counters -->
        <div class="row">
          
          <!-- Title -->
          <div class="col-12">
            <h5 class="store-card-title mb-2">Test</b></h5>
          </div>
          
        </div>
        
        <hr>
        
        <div class="container mt-5">
          <h2 style="margin-bottom: 30px;">jQuery Datatable Ajax PHP Example</h2>
          <table id="tableList" class="display" style="width:100%">
            <thead>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Herramientas</th>
              <th>Nombre</th>
              <th>Especificaciones</th>
              <th>Precio</th>
              <th>Categoria</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Visitas</th>
              <th>Likes</th>
              <th>Comentarios</th>
              <th>Imagen</th>
              <th>Última modificación</th>
              <th>Creado</th>
            </tr>
            </thead>
            <tbody style="text-align: center;">
            <!-- Show content -->
            </tbody>
            <tfoot>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Herramientas</th>
              <th>Nombre</th>
              <th>Especificaciones</th>
              <th>Precio</th>
              <th>Categoria</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Visitas</th>
              <th>Likes</th>
              <th>Comentarios</th>
              <th>Imagen</th>
              <th>Última modificación</th>
              <th>Creado</th>
            </tr>
            </tfoot>
          </table>
        </div>
      
      </div>
    
    </div>
  
  </div>
</section>


<!-- jQuery -->
<script src="public_html/resources/plugins/jquery/jquery.min.js"></script>

<!-- Sweet Alert -->
<script src="public_html/resources/plugins/sweetalert2/sweetalert2.11.7.31.js"></script>

<!-- Custom JS Code -->
<script src="public_html/js/js-functions.js"></script>

<script type="text/javascript">

  let table = $(function () {
    $("#tableList").DataTable({
      "destroy": true,
      "processing": true,
      "serveSide": true,
      'serverMethod': 'get',
      "columnDefs": [
        {"targets": [], visible: false},
      ],
      "ajax": {
        'url': 'public_html/views/admin/Teste.php',
        'type': 'GET',
        'data': {
          // language: object_language,
        },
      },
      "dom": 'Bfrtip',
      buttons: [
        'pageLength',
        {
          extend: 'copy',
          orientation: 'landscape',
          exportOptions: {
            columns: [4, 5, 6, 7, ':visible'],
            columns: ':not(.notexport)',
            stripHtml: true,
          }
        },
        {
          extend: 'excel',
          orientation: 'landscape',
          exportOptions: {
            columns: [4, 5, 6, 7, ':visible'],
            columns: ':not(.notexport)',
            stripHtml: true,
          }
        },
        {
          extend: 'pdf',
          orientation: 'landscape',
          exportOptions: {
            columns: [4, 5, 6, 7, ':visible'],
            columns: ':not(.notexport)',
            stripHtml: false,
          },
        },
        {
          extend: 'print',
          orientation: 'landscape',
          exportOptions: {
            columns: [4, 5, 6, 7, ':visible'],
            columns: ':not(.notexport)',
            stripHtml: false,
          }
        },
        'colvis',
      ],
      language: {
        buttons: {
          copy: 'Copiar',
          csv: 'CSV',
          excel: 'Excel',
          pdf: 'PDF',
          print: 'Imprimir',
          colvis: 'Mostrar columnas',
          pageLength: {
            '_': "Mostrar %d registros",
            '-1': "Mostrar todos los registros" // « This will not work in JS, right?
          }
        },
        lengthMenu: 'Mostrar _MENU_ registros por página',
        infoEmpty: 'No se encontró ningún registro',
        info: 'Mostrando _START_ de _END_ de un total de _TOTAL_ entradas',
        search: 'Buscar',
        zeroRecords: 'No se encontraron registros coincidentes',
        loadingRecords: 'Cargando...',
        paginate: {
          first: 'Primero',
          last: 'Último',
          next: 'Siguiente',
          previous: 'Anterior'
        }
      },
      "responsive": true,
      "lengthChange": true,
      lengthMenu: [
        [10, 25, 50, -1],
        ['10 registros', '25 registros', '50 registros', 'Mostrar todo']
      ],
      "autoWidth": false
    }).buttons().container().appendTo('#tableList_wrapper .col-md-6:eq(0)');
  });
  
  

</script>