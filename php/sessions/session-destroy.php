<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Sessions file
   * File description:    Destroy the session started by the user.
   * Module:              Sessions
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Session start
  session_start ();
  session_destroy ();
  
  # Redirect site to log in page
  header ('Location: ../../login.php?success=you-have-successfully-logged-out');
  exit();