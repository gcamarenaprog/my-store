<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Model file
   * File description:    This file is the product model.
   * Module:              Models
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  require_once (__DIR__ . '/Generic.php');
  
  /**
   * This class defines the product model class. This class inherits from the generic model class. Its methods are:
   *
   * - getAllProductsForDataTables
   */
  class Product extends Generic
  {
    
    protected string $table;
    protected string $field;
    
    /**
     * Constructor of the Product model class
     */
    public function __construct ()
    {
      parent::__construct ('products', 'product_id');
    }
    
    /**
     * = Get all products for DataTables format. =
     *
     * @return array|false
     */
    public function getAllProducts (): false|array
    {
      $stmt = $this->connectionPDO->prepare ("SELECT * FROM {$this->table} ");
      $stmt->execute ();
      return $stmt->fetchAll ();
    }
    
  }