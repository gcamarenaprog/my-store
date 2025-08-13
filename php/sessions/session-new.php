<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Sessions file
   * File description:    Check the username and password from the login screen, check if it exists and start a new
   *                      user session
   * Module:              Sessions
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Files required
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  require_once (dirname (__DIR__, 1) . '/controllers/UserController.php');
  
  # Declaration and initialization of variables
  $controllerUserObject = new UserController();
  
  session_start ();
  
  if (isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) { // Check if is defined username and password on $_POST variable
    
    # Clear username and password strings entered from the login form
    $username = Functions::cleanStringFromInput ($_POST['inputUsername']);
    $password = Functions::cleanStringFromInput ($_POST['inputPassword']);
    
    if (empty($username) || empty($password)) { // If is empty username or password fields
      
      # Redirect to the login page
      header ("Location: ../../login.php?error=empty-fields");
      
    } else { // If are not empty username or password fields
      
      # Encode the password string in md5
      $password = md5 ($password);
      
      # Check if there is a record with the username and password entered
      $dataUser = $controllerUserObject->checkIfTheUserAndPasswordExist ($username, $password);
      
      # If exist data on data user variable
      if ($dataUser) {
        
        # If the username and password match in the data obtained previously
        if ($dataUser['user_username'] === $username && $dataUser['user_password'] === $password) {
          
          # Initializes the SESSION variable from the user data obtained from the database
          Functions::initializeSessionVariableWithUserData ($dataUser);
          
          # Redirect to admin
          header ("Location: ../../admin");
        } else {
          # Redirect to log in screen with an error message
          header ('Location: ../../login.php?error=invalid-user-and-password');
        }
      } else {
        # Redirect to log in screen with an error message
        header ('Location: ../../login.php?error=invalid-user-and-password');
      }
    }
  } else { // Redirect to the login page
    header ('Location: ../../login.php?error=empty-fields');
  }
  exit();