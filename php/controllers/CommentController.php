<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file.
   * File description:    Comment controller.
   * Module:              Controllers.
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  global $langTemplate;
  
  # Required files
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  require_once (dirname (__DIR__, 1) . '/models/Comment.php');
  
  /**
   * This class defines the user controller class.
   */
  class CommentController
  {
    private Comment $model;
    
    /**
     * User Controller Constructor
     */
    function __construct ()
    {
      $this->model = new Comment();
    }
    
    /**
     * Get total number of comments.
     *
     * @return int
     */
    function getTotalComments (): int
    {
      return $this->model->getTotal ();
    }
  }