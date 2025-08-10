<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Index file that is the starting point of the templates.
   * Module:              Core
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Files are required from the current directory
  require_once (__DIR__ . '/install/config.php');
  require_once (__DIR__ . '/router.php');
  require_once (__DIR__ . '/php/includes/functions.php');
  
  session_start ();
  
  # Separates the words corresponding to the name of the controller and the method into an array
  $url = explode ('/', URL);
  
  # Check if it contains page for store pagination
  $jsonString = json_encode ($url);
  if (str_contains ($jsonString, 'page')) {
    $url[0] = 'shop';
  }
  
  # Check if it contains page for store pagination
  $jsonString = json_encode ($url);
  if (str_contains ($jsonString, 'category')) {
    $url[0] = 'shop';
  }
  
  # If the user is logged in, the administration template is loaded
  if ($url[0] == 'store' || $url[0] == 'contact' || $url[0] == 'shop' || $url[0] == 'product' || $url[0] == '' || $url[0] == 'login') {
    
    $return_value = match ($url[0]) {
      'login' => include 'login.php',
      default => include 'public_html/views/store/template-store.php',
    };
    
  } elseif (isset($_SESSION['user_username'])) {
    
    # Template file of administration
    include 'public_html/views/admin/template-admin.php';
    
  } elseif ($url[0] == 'admin') {
    
    # If you are not logged in, you will be redirected to the login screen
    include 'login.php';
    
  } else {
    
    # Any other undeclared route redirects to the store's home screen
    include 'public_html/views/store/template-store.php';
  }