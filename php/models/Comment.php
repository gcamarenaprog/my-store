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
    
    /**
     * Get all comments of product id.
     *
     * @param $productId
     * @return array|false
     */
    public function getAllCommentsOfProduct ($productId): false|array
    {
      $sql = "SELECT * FROM " . $this->table . " WHERE comment_product_id = '$productId' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
      
    }
    
    /**
     * Get total comments of a product
     * @param $productId
     * @return int
     */
    public function getTotalCommentsOfProduct ($productId): int
    {
      $sql = " SELECT COUNT(*) FROM {$this->table} WHERE comment_product_id = '$productId' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
  }