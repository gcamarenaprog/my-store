<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Contains the store template structure.
   * Module:              Template
   * Revised:             12-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  ob_start ();

?>

<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <title><?php echo SYSTEM_FULL_NAME ?></title>

  <!-- Favicon /-->
  <link href='public_html/resources/store/dist/img/favicon.ico' rel='icon'>

  <!-- Google Web Fonts /-->
  <link rel='preconnect' href='https://fonts.gstatic.com'>
  <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap' rel='stylesheet'>

  <!-- Font Awesome /-->
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css' rel='stylesheet'>

  <!-- Libraries Stylesheet /-->
  <link href='public_html/resources/store/plugins/lib/animate/animate.min.css' rel='stylesheet'>
  <link href='public_html/resources/store/plugins/lib/owlcarousel/assets/owl.carousel.min.css' rel='stylesheet'>

  <!-- Customized Bootstrap Stylesheet /-->
  <link href='public_html/resources/store/dist/css/style.css' rel='stylesheet'>

  <!-- Customized Bootstrap Stylesheet /-->
  <link href='public_html/resources/store/dist/css/custom.css' rel='stylesheet'>

</head>

<body class='hold-transition sidebar-mini layout-fixed'>

<!-- Topbar /-->
<?php include 'modules/topbar.php'; ?>

<!-- Navbar /-->
<?php include 'modules/navbar.php'; ?>

<!-- Content wrapper /-->
<div>
  
  <?php
    $templateName = 'store';
    $router = new Router($templateName);
  ?>

</div>

<!-- Footer /-->
<?php include 'modules/footer.php'; ?>

<!-- Back to top /-->
<?php include 'modules/back-to-top.php'; ?>

<?php ob_end_flush (); ?>

<!-- JavaScript Libraries /-->
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
<script src='public_html/resources/store/plugins/lib/easing/easing.min.js'></script>
<script src='public_html/resources/store/plugins/lib/owlcarousel/owl.carousel.min.js'></script>

<!-- Contact Javascript File /-->
<script src='public_html/resources/store/plugins/mail/jqBootstrapValidation.min.js'></script>
<script src='public_html/resources/store/plugins/mail/contact.js'></script>

<!-- Template Javascript /-->
<script src='public_html/resources/store/dist/js/main.js'></script>

</body>
</html>