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
   * - getCheapestProductOfCategoryID
   * - getAllRecentProducts
   * - getMaxScore
   * - getMinScore
   * - calculateTheDsiplacement
   */
  class Product extends Generic
  {
    
    protected string $table;
    protected string $field;
    
    /**
     * = Product model construct. =
     */
    public function __construct ()
    {
      parent::__construct ('products', 'product_id');
    }
    
    /**
     * = Get the cheapest product of a category. =
     *
     * @param $categoryId
     * @return array|bool
     */
    public function getCheapestProductOfCategoryID ($categoryId): array|bool
    {
      $sql = " SELECT product_id, product_name, product_image, product_likes, product_price, product_views, MIN(product_price) FROM {$this->table} WHERE  product_categories LIKE '%$categoryId%' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Get all recent products. =
     *
     * @return array|bool
     */
    public function getAllRecentProducts (): array|bool
    {
      $sql = "SELECT * FROM {$this->table} ORDER BY product_id DESC LIMIT 10;";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Get mas score of the all products. =
     *
     * @return false|array
     */
    public function getMaxScore (): false|array
    {
      $sql = " SELECT MAX(product_likes) FROM {$this->table}";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Get min score of the all products. =
     *
     * @return false|array
     */
    public function getMinScore (): false|array
    {
      $sql = " SELECT  MIN(product_likes) FROM {$this->table}";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    /**
     * = Calculate the displacement. =
     *
     * @param $displacement
     * @param $resultsPerPage
     * @return array|false
     */
    public function calculateTheDsiplacement ($displacement, $resultsPerPage, $sortingValue = 0, $categoryId, $subcategories = 0): false|array
    {
      if ($subcategories == 0){
        if ($sortingValue == 1 || $sortingValue == 2 || $sortingValue == 3) {
          $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_id DESC  LIMIT $displacement, $resultsPerPage  ";
        }else{
          $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) LIMIT $displacement, $resultsPerPage";
        }
      }else{
        if ($sortingValue == 1 || $sortingValue == 2 || $sortingValue == 3) {
          $sql = " SELECT * FROM {$this->table} WHERE  INSTR('$categoryId',product_categories ) ORDER BY product_id DESC  LIMIT $displacement, $resultsPerPage  ";
        }else{
          $sql = " SELECT * FROM {$this->table} WHERE  INSTR('$categoryId', product_categories) LIMIT $displacement, $resultsPerPage";
        }
      }
      

      
      
      //  } elseif ($hasChildCategories == 0 && $isParentCategory == 0) {
      
      /*       if ($sortingValue == 1) {
               $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_id DESC  LIMIT $displacement, $resultsPerPage  ";
               
             } elseif ($sortingValue == 2) {
               $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_likes DESC  LIMIT $displacement, $resultsPerPage ";
               
             } elseif ($sortingValue == 3) {
               $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_views DESC  LIMIT $displacement, $resultsPerPage ";
               
             } else {
               $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) LIMIT $displacement, $resultsPerPage";
               
             }*/
      
      /* } else {
         echo 'test';
         $categoriesIds = [];
        $result = $productCategoriesObject->getChildCategoriesByIdCategory ($categoryId);
        foreach ($result as $categoryData){
          $categoriesIds [] = $categoryData['product_category_id'];
        }
        var_dump ($categoriesIds);
        $categories = implode (',', $categoriesIds);
        echo $categories;
        
         if ($sortingValue == 1) {
           $sql = " SELECT * FROM {$this->table} WHERE FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_id DESC  LIMIT $displacement, $resultsPerPage  ";
           
         } elseif ($sortingValue == 2) {
           $sql = " SELECT * FROM {$this->table} WHERE FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_likes DESC  LIMIT $displacement, $resultsPerPage ";
           
         } elseif ($sortingValue == 3) {
           $sql = " SELECT * FROM {$this->table} WHERE FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_views DESC  LIMIT $displacement, $resultsPerPage ";
           
         } else {
           $sql = " SELECT * FROM {$this->table} WHERE FIND_IN_SET ('$categoryId',product_categories) LIMIT $displacement, $resultsPerPage";
           
         }
       }*/
      
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
  }