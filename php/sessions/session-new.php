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
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Files required
  require_once (dirname (__DIR__, 2) . '/install/config.php');
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  require_once (dirname (__DIR__, 1) . '/controllers/UserController.php');
  
  session_start ();
  
  # Check if is defined username and password on $_POST variable
  if (isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
    
    # Clear username and password strings entered from the login form
    $username = Functions::cleanStringFromInput ($_POST['inputUsername']);
    $password = Functions::cleanStringFromInput ($_POST['inputPassword']);
    
    # If is empty username or password fields
    if (empty($username) || empty($password)) {
      
      # Redirect to log in screen with an error message in the URL
      header ("Location: ../../login.php?error=empty-fields");
      
    } else { # If are not empty username or password fields
      
      # Prepare and coding password string to md5
      $password = md5 ($password);
      
      # Create new object of User type
      $controllerUserObject = new UserController();
      
      # Check if there is a record with the username and password entered
      $dataUser = $controllerUserObject->verifyUserAndPassword ($username, $password);
      
      # If exist data on data user variable
      if ($dataUser) {
        
        # If the username and password match in the data obtained previously
        if ($dataUser['user_username'] === $username && $dataUser['user_password'] === $password) {
          
          # Initializes the SESSION variable from the user data obtained from the database
          Functions::sessionsInitializeSessionVariable ($dataUser);
          
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
  } else {
    # Redirect to log in page with an error message
    header ('Location: ../../login.php?error=empty-fields');
  }
  exit();