<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the administration template structure.
   * Module:              Template
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  ob_start();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Administración</title>

  <!-- Google Font: Source Sans Pro /-->
  <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback'>

  <!-- Font Awesome /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/fontawesome-free/css/all.min.css'>

  <!-- daterange picker /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/daterangepicker/daterangepicker.css'>
  
  <!-- iCheck for checkboxes and radio inputs /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css'>
  
  <!-- Bootstrap Color Picker /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'>

  <!-- Tempusdominus Bootstrap 4 /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'>

  <!-- Select2 /-->
  <link rel='stylesheet' href='public_html/resources/admin/plugins/select2/css/select2.min.css'>
  <link rel='stylesheet' href='public_html/resources/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'>

  <!-- Bootstrap4 Duallistbox /-->
  <link rel="stylesheet" href="public_html/resources/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  
  <!-- BS Stepper /-->
  <link rel="stylesheet" href="public_html/resources/admin/plugins/bs-stepper/css/bs-stepper.min.css">

  <!-- dropzonejs /-->
  <link rel="stylesheet" href="public_html/resources/admin/plugins/dropzone/min/dropzone.min.css">

  <!-- Ekko Lightbox /-->
  <link rel="stylesheet" href="public_html/resources/admin/plugins/ekko-lightbox/ekko-lightbox.css">

  <!-- Theme style /-->
  <link rel='stylesheet' href='public_html/resources/admin/dist/css/adminlte.min.css'>

  <!-- Ionicons /-->
  <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>

  <!-- Theme style personalized /-->
  <link rel='stylesheet' href='public_html/resources/admin/dist/css/custom.css'>

</head>

<body class='hold-transition sidebar-mini layout-fixed'>

<div class='wrapper'>

  <!-- Preloader /-->
  <?php //include 'modules/preloader.php'; ?>

  <!-- Navbar /-->
  <?php include 'modules/navbar.php'; ?>

  <!-- Main Sidebar Container /-->
  <?php include 'modules/aside.php'; ?>

  <!-- Content Wrapper /-->
  <div class='content-wrapper'>
    
    <?php
      $templateName = 'administration';
      $router = new Router($templateName);
    ?>

  </div>

  <!-- Footer /-->
  <?php include 'modules/footer.php'; ?>

</div>

<?php  ob_end_flush();?>

<!-- jQuery /-->
<script src='public_html/resources/admin/plugins/jquery/jquery.min.js'></script>

<!-- jquery-validation /-->
<script src='public_html/resources/admin/plugins/jquery-validation/jquery.validate.min.js'></script>
<script src='public_html/resources/admin/plugins/jquery-validation/additional-methods.min.js'></script>

<!-- Select2 /-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js'></script>

<!-- Bootstrap 4 /-->
<script src='public_html/resources/admin/plugins/bootstrap/js/bootstrap.bundle.min.js'></script>

<!-- Ekko Lightbox /-->
<script src="public_html/resources/admin/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<!-- AdminLTE App /-->
<script src='public_html/resources/admin/dist/js/adminlte.min.js'></script>

<!-- DataTables & Plugins /-->
<script src='public_html/resources/admin/plugins/datatables/jquery.dataTables.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'></script>
<script src='public_html/resources/admin/plugins/jszip/jszip.min.js'></script>
<script src='public_html/resources/admin/plugins/pdfmake/pdfmake.min.js'></script>
<script src='public_html/resources/admin/plugins/pdfmake/vfs_fonts.js'></script>
<script src='public_html/resources/admin/plugins/datatables-buttons/js/buttons.html5.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-buttons/js/buttons.print.min.js'></script>
<script src='public_html/resources/admin/plugins/datatables-buttons/js/buttons.colVis.min.js'></script>

<!-- Sweet Alert /-->
<script src='public_html/resources/admin/plugins/sweetalert2/sweetalert2.11.7.31.js'></script>

<!-- Custom JS Code /-->
<script src='public_html/js/js-functions.js'></script>

<script>
</script>

</body>
</html>