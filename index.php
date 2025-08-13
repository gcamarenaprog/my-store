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
  
  # Required files and libraries
  require_once (__DIR__ . '/install/config.php');
  require_once (__DIR__ . '/router.php');
  require_once (__DIR__ . '/php/includes/functions.php');
  
  session_start ();
  
  # Separate the URL into words
  $url = explode ('/', URL);
  
  $storeUrls = ['store', 'shop', 'contact', 'product', 'login', ''];
  
  // If you are not logged in, you will be redirected to the store template.
  if (in_array($url[0], $storeUrls)) {
    
    $return_value = match ($url[0]) {
      'login' => include 'login.php',
      default => include 'public_html/views/store/template-store.php',
    };
    
  } elseif (isset($_SESSION['user_username'])) { // If the user is logged in, the administration template is loaded.
    
    include 'public_html/views/admin/template-admin.php';
    
  } elseif ($url[0] === 'admin') { // If the user is logged in, the administration template is loaded.
    
    header ('Location: ../../login.php?error=your-are-not-logged-in');
    
  } else { // Any other undeclared route redirects to the store template
    
    include 'public_html/views/store/template-store.php';
  }