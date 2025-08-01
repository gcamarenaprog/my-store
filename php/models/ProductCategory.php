<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Model file
   * File description:    This file is the product category model.
   * Module:              Models
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  require_once (__DIR__ . '/Generic.php');
  
  /**
   * This class defines the product category model class. This class inherits from the generic model class. Its methods
   * are:
   *
   * - getAllCategoriesWithParentCategoryId
   * - getAllProductsCategoriesForDataTables
   */
  class ProductCategory extends Generic
  {
    
    /**
     *  :: Constructor of the ModelProductCategory class, inherit of the model generic class ::
     */
    public function __construct ()
    {
      parent::__construct ('products_categories', 'product_category_id');
    }
    
    /**
     * :: Gets total child categories by ID category ::
     *
     * @param $categoryId Category id.
     * @return int
     */
    public function getTotalChildCategoriesByIdCategory($categoryId): int
    {
      $sql = " SELECT COUNT(product_category_parent) AS NumberOfChildCategories  from {$this->table} WHERE product_category_parent LIKE '%$categoryId%' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * :: Get category name by category ID ::
     *
     * @param string $categoryId Category id.
     * @return string
     */
    public function getCategoryNameById (string $categoryId): string
    {
      $sql = " SELECT product_category_name FROM {$this->table} WHERE product_category_id ='$categoryId' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * :: Gets total products on a category ::
     *
     * @param string $categoryId Category id.
     * @return string
     */
    public function getTotalProductsCategoryByIdCategory (string $categoryId): string
    {
      $sql = " SELECT COUNT(product_categories) AS NumberOfProducts from products WHERE product_categories LIKE '%$categoryId%' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * :: Get all parent categories ::
     *
     * @return array|bool
     */
    public function getAllParentCategories (): array|bool
    {
      $sql = "SELECT * FROM $this->table WHERE product_category_parent = 0";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
  }