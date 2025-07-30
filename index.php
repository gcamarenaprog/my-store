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
  
  # If the user is logged in, the administration template is loaded
  if ( $url[0] == 'store' || $url[0] == '' || $url[0]== 'login') {
    
    if ( $url[0] == 'login') {
      
      # Template file of store
      include 'login.php';
      
    }else {
      # Template file of store
      include 'public_html/views/store/template-store.php';
    }
    
  } elseif( isset($_SESSION['user_username']) || ($url[0] == 'admin')) {
    
    # Template file of administration
    include 'public_html/views/admin/template-admin.php';
    
  }