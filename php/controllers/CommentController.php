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
  
  # Required files
  require_once (dirname (__DIR__, 1) . '/includes/Functions.php');
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
    
    /**
     * Get all comments
     *
     * @return array|bool
     */
    function getAllComments (): bool|array
    {
      return $this->model->getAll ();
    }
    
    /**
     * Get all comments of product id.
     *
     * @param $productId
     * @return array|false
     */
    function getAllCommentsOfProduct ($productId): false|array
    {
      return $this->model->getAllCommentsOfProduct ($productId);
    }
    
    /**
     * Get total comments of a product
     *
     * @param $productId
     * @return string
     */
    public function getTotalCommentsOfProduct ($productId): string
    {
      $result = $this->model->getTotalCommentsOfProduct ($productId);
      if ($result == 0) {
        return 'No hay comentarios para: ';
      } elseif ($result == 1) {
        return '1 comentario para: ';
      } else {
        return $result . ' comentarios para: ';
      }
    }
  }