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
     * _Constructor of the ModelProductCategory class, inherit of the model generic class.
     */
    public function __construct ()
    {
      parent::__construct ('products_categories', 'product_category_id');
    }
    
    /**
     * REVISED
     * Get category name by category id
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
     * REVISED
     * Gets total products on a category.
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
     * REVISED
     * Gets total child categories by id category.
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
    
    
    /***
     * REVISED
     * Get all products categories for DataTables format
     *
     * @return bool|mysqli_result
     */
    public function getAllProductsCategoriesForDataTables (): mysqli_result|bool
    {
      $sql = "SELECT * FROM $this->table";
      $connection = $this->connectionMysqli;
      return $connection->query ($sql);
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * Check if the product exists in a category
     *
     * @param $idCategory
     * @return bool|array
     */
    public function checkExistsProductInCategory ($idCategory): bool|int
    {
      $sql = "SELECT COUNT(*) FROM $this->table WHERE product_category='$idCategory'";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * Check if the product exists in a category
     *
     * @param $categoryId
     * @return bool|array
     */
    public function existsProductInCategory ($categoryId): bool|int
    {
      $sql = "SELECT COUNT(*) FROM $this->table WHERE product_categories='$categoryId'";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    
    /**
     * _Returns categories that have the same parent category, sorted in ascending or descending order.
     *
     * @param string $parenCategoryId <p>Parent category Id.</p>
     * @param string $order           <p>Order ASC | DESC.</p>
     * @return array                  <p>Array with categories or empty array.</p>
     */
    public function getAllProductCategoriesWithParentCategoryId (string $parenCategoryId, string $order = 'ASC'): array
    {
      $sql = "SELECT * FROM $this->table WHERE product_category_parent = $parenCategoryId ORDER BY product_category_name $order";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    /**
     * Verifies if the category has child categories
     *
     * @param int $idCategory <p>Id category.</p>
     * @return int            <p>0 or int number.</p>
     */
    public function verifyExistsChildProductCategories (int $idCategory): int
    {
      $sql = "SELECT COUNT(*) FROM $this->table WHERE product_category_parent='$idCategory'";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    
    /**
     * _Get parent category with id category parent
     *
     * @param int $idCategoryParent
     * @return array|bool
     */
    public function getParentCategory (int $idCategoryParent): array|bool
    {
      $sql = "SELECT * FROM $this->table WHERE product_category_id='$idCategoryParent'";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      $result = $statement->fetch (PDO::FETCH_ASSOC);
      if (!$result) {
        return false;
      } else {
        return $result;
      }
    }
    
    
    /**
     * _Get all parent Categories
     *
     * @return mysqli_result
     */
    public function getAllParentCategories (): mysqli_result
    {
      $sql = "SELECT * FROM $this->table WHERE product_category_parent=0";
      $connection = $this->connectionMysqli;
      return $connection->query ($sql);
    }
    
    
    /**
     * _Get all subcategories
     *
     * @param $product_category_id
     * @return mysqli_result|bool
     */
    public function getAllSubcategories ($product_category_id): mysqli_result|bool
    {
      $sql = "SELECT * FROM products_categories WHERE product_category_parent=$product_category_id ORDER BY product_category_name ASC";
      $connection = $this->connectionMysqli;
      return $connection->query ($sql);
    }
    
    
    
    
    
  }