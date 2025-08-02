<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Model file
   * File description:    This file is the comment model.
   * Module:              Models
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  require_once (__DIR__ . '/Generic.php');
  
  /**
   * This class defines the User model class
   */
  class Comment extends Generic
  {
    
    /**
     * Constructor of the User class
     */
    public function __construct ()
    {
      parent::__construct ('comments', 'comment_id');
    }
    
  }