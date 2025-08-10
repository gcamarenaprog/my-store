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
   * - getTotalChildCategoriesByIdCategory
   * - getCategoryIdIfItIsChildOfTheCategoryId
   * - isParentCategory
   * - getTotalProductsOfCategory
   * - getTotalProductsCategoryByIdCategory
   * - getCategoryNameById
   * - getParentCategories
   * - getAllSubcategories
   * - countChildCategoriesOfCategory
   */
  class ProductCategory extends Generic
  {
    
    /**
     *  = Product category construct. =
     */
    public function __construct ()
    {
      parent::__construct ('products_categories', 'product_category_id');
    }
    
    /**
     * = Gets total child categories by ID category. =
     *
     * @param string $categoryId
     * @return int
     */
    public function getTotalChildCategoriesByIdCategory (string $categoryId): int
    {
      $sql = " SELECT COUNT(product_category_parent) AS NumberOfChildCategories  from {$this->table} WHERE product_category_parent LIKE '%$categoryId%' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * = Gets child categories by id category =
     *
     * @param int $categoryId
     * @return array
     */
    public function getChildCategories (int $categoryId): array
    {
      $sql = " SELECT * from {$this->table} WHERE product_category_parent LIKE '%$categoryId%' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Get category id if its Is child of the category id. =
     *
     * @param $categoryId
     * @return array
     */
    public function getCategoryIdIfItIsChildOfTheCategoryId ($categoryId): array
    {
      $sql = " SELECT product_category_id  from {$this->table} WHERE  product_category_parent = '$categoryId'";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Is parent category =
     *
     * @param $categoryId
     * @return int|bool
     */
    public function isParentCategory ($categoryId): int|bool
    {
      $sql = "SELECT COUNT(product_category_id) AS IsParentCategory from {$this->table} WHERE product_category_id = '$categoryId' AND product_category_parent = 0";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * = Get total records. =
     *
     * @param $categoryId
     * @return int
     */
    public function getTotalProductsOfCategoryId ($categoryId): int
    {
      $sql = " SELECT COUNT(product_categories) AS NumberOfProducts from products WHERE  FIND_IN_SET ('$categoryId',product_categories) ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * = Gets total products on a category. =
     *
     * @param string $categoryId
     * @return string
     */
    public function getsTotalProductsWithoutChildCategoriesByCategoryId (string $categoryId): string
    {
      $sql = " SELECT COUNT(product_categories) AS NumberOfProducts from products WHERE  FIND_IN_SET ('$categoryId',product_categories) ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * = Get category name by category ID. =
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
     * = Get all parent categories. =
     *
     * @return array|bool
     */
    public function getParentCategories (): array|bool
    {
      $sql = "SELECT * FROM $this->table WHERE product_category_parent = 0";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Get all subcategories. =
     *
     * @param $product_category_id
     * @return array|false
     */
    public function getAllSubcategories ($product_category_id): false|array
    {
      $sql = "SELECT * FROM products_categories WHERE product_category_parent=$product_category_id ORDER BY product_category_name ASC";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Count child categories of a category. =
     *
     * @param int $idCategory
     * @return int
     */
    public function countChildCategoriesOfCategory (int $idCategory): int
    {
      $sql = "SELECT COUNT(*) FROM $this->table WHERE product_category_parent = '$idCategory' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
  }