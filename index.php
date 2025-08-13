<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Template file
   * File description:    Index file that is the starting point of the templates.
   * Module:              Core
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Files are required from the current directory
  require_once (__DIR__ . '/install/config.php');
  require_once (__DIR__ . '/router.php');
  require_once (__DIR__ . '/php/includes/functions.php');
  
  session_start ();
  
  # Separates the words corresponding to the name of the controller and the method into an array
  $url = explode ('/', URL);
  $jsonURL = json_encode ($url);
  
  # Check if it contains 'page' or 'category' for store pagination
  $pageString = str_contains ($jsonURL, 'page') ? 1 : 0;
  $categoryString = str_contains ($jsonURL, 'category') ? 1 : 0;
  
  $storeUrls = ['store', 'shop', 'contact', 'product', 'login', '', 'category', 'page'];
  
  # If the user is logged in, the administration template is loaded
  if (in_array ($url[0], $storeUrls) || ($pageString || $categoryString)) {
    
    $return_value = match ($url[0]) {
      'login' => include 'login.php',
      default => include 'public_html/views/store/template-store.php',
    };
    
  } elseif (isset($_SESSION['user_username'])) {
    
    # Template file of administration
    include 'public_html/views/admin/template-admin.php';
    
  } elseif ($url[0] == 'admin') {
    
    # If you are not logged in, you will be redirected to the login screen
    header ('Location: ../../login.php?error=your-are-not-logged-in');
    
  } else {
    
    # Any other undeclared route redirects to the store's home screen
    include 'public_html/views/store/template-store.php';
  }