<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Sessions file
   * File description:    Destroy the session started by the user.
   * Module:              Sessions
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  
  # Session start
  session_start ();
  session_destroy ();
  
  # Redirect site to log in page
  header ("Location: ../../login.php?ok=you-have-successfully-logged-out");
  exit();