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
   * - getCheapestProductInTheCategory
   * - getRecentProductsList
   * - getsTheHighestScoreOfAllProducts
   * - getsTheMinimumScoreOfAllProducts
   * - calculateTheDisplacementAndGetProductsOfCategory
   * - calculateTheDisplacementAndGetAllProducts
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
     * = Get cheaper products in a category =
     *
     * @param $categoryId
     * @param $numberOfProducts
     * @return array|bool
     */
    public function getCheapestProductOfTheCategory ($categoryId, $numberOfProducts): array|bool
    {
      if($categoryId == 0){
        $sql = " SELECT * FROM {$this->table} ORDER BY product_price DESC LIMIT $numberOfProducts ";
      }else{
        $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_price DESC LIMIT $numberOfProducts ";
      }
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Get best scored products in a category =
     *
     * @param $categoryId
     * @param $numberOfProducts
     * @return array|bool
     */
    public function getBestScoredProductsInCategory ($categoryId, $numberOfProducts): array|bool
    {
      if($categoryId == 0){
        $sql = " SELECT * FROM {$this->table} ORDER BY product_likes DESC LIMIT $numberOfProducts ";
      }else{
        $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_likes DESC LIMIT $numberOfProducts ";
      }
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    
    
    
    
    
    
    
    /**
     * = Get total records. =
     *
     * @param $categoryId
     * @return int
     */
    public function getTotalProductsOfCategoryId ($categoryId): int
    {
      $sql = " SELECT COUNT(product_categories) AS NumberOfProducts FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    
    /**
     * = Get count total products of the category between two ranges price =
     *
     * @param $categoryId
     * @param $rangePriceOne
     * @param $rangePriceTwo
     * @return int
     */
    public function getCountTotalProductsOfTheCategoryBetweenRangesPrice ($categoryId, $rangePriceOne, $rangePriceTwo): int
    {
      $sql = " SELECT COUNT(product_categories) AS NumberOfProducts FROM {$this->table} WHERE FIND_IN_SET ('$categoryId',product_categories) AND TRUNCATE(product_price, 0) BETWEEN '$rangePriceOne' AND '$rangePriceTwo'; ";
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
      $sql = " SELECT COUNT(product_categories) AS NumberOfProducts from {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    
    
    
    
    /**
     * = Get the cheapest product in the category =
     *
     * @param $categoryId
     * @return array|bool
     */
    public function getCheapestProductInTheCategory ($categoryId): array|bool
    {
      $sql = " SELECT *, MIN(product_price) FROM {$this->table} WHERE  product_categories LIKE '%$categoryId%' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    

    
    
    /**
     * = Get recent products. =
     *
     * @return array|bool
     */
    public function getRecentProductsList (): array|bool
    {
      $sql = "SELECT * FROM {$this->table} ORDER BY product_id DESC LIMIT 12;";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * = Gets a list of top-rated products. =
     *
     * @return array|bool
     */
    public function getsBestScoredProducts (): array|bool
    {
      $sql = "SELECT * FROM {$this->table} ORDER BY product_likes DESC LIMIT 12;";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    /**
     * = Gets the highest score of all products. =
     *
     * @return false|array
     */
    public function getsTheHighestScoreOfAllProducts (): false|array
    {
      $sql = " SELECT MAX(product_likes) FROM {$this->table}";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    /**
     * = Gets the minimum score of all products. =
     *
     * @return false|array
     */
    public function getsTheMinimumScoreOfAllProducts (): false|array
    {
      $sql = " SELECT  MIN(product_likes) FROM {$this->table}";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    /**
     * = Calculate the displacement and get all products of a category. =
     *
     * @param int       $displacement
     * @param int       $resultsPerPage
     * @param int       $sortingValue
     * @param int|array $categoryId
     * @param int       $subcategories
     * @return false|array
     */
    public function calculateTheDisplacementAndGetProductsOfCategory (int $displacement, int $resultsPerPage, int $sortingValue, int|array $categoryId, int $subcategories = 0): false|array
    {
      if ($subcategories == 0) {
        
        if ($sortingValue == 1 || $sortingValue == 2 || $sortingValue == 3) {
          
          if ($sortingValue == 1) {
            $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_date_creation DESC  LIMIT $displacement, $resultsPerPage ";
          } elseif ($sortingValue == 2) {
            $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_likes DESC  LIMIT $displacement, $resultsPerPage ";
          } else {
            $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_views DESC  LIMIT $displacement, $resultsPerPage ";
          }
          
        } else {
          $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) LIMIT $displacement, $resultsPerPage ";
        }
      } else {
        
        $arrayLength = count ($categoryId);
        $sentence = '';
        for ($i = 0; $i < $arrayLength; $i++) {
          $sentence .= "product_categories LIKE '%$categoryId[$i]%'";
          if ($i < $arrayLength - 1) {
            $sentence .= ' OR ';
          }
        }
        
        if ($sortingValue == 1 || $sortingValue == 2 || $sortingValue == 3) {
          
          if ($sortingValue == 1) {
            $sql = " SELECT * FROM {$this->table} WHERE $sentence ORDER BY product_date_creation DESC  LIMIT $displacement, $resultsPerPage ";
          } elseif ($sortingValue == 2) {
            $sql = " SELECT * FROM {$this->table} WHERE $sentence ORDER BY product_likes DESC  LIMIT $displacement, $resultsPerPage ";
          } else {
            $sql = " SELECT * FROM {$this->table} WHERE $sentence ORDER BY product_views DESC  LIMIT $displacement, $resultsPerPage ";
          }
          
        } else {
          $sql = " SELECT * FROM {$this->table} WHERE  $sentence LIMIT $displacement, $resultsPerPage ";
        }
      }
      
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    
    /**
     * = Calculate the displacement and get all products. =
     *
     * @param int $displacement
     * @param int $resultsPerPage
     * @param int $sortingValue
     * @param int $categoryId
     * @return array|false
     */
    public function calculateTheDisplacementAndGetAllProducts (int $displacement, int $resultsPerPage, int $sortingValue, int $categoryId): false|array
    {
      if ($sortingValue == 1 || $sortingValue == 2 || $sortingValue == 3) {
        
        if ($sortingValue == 1) {
          $sql = " SELECT * FROM {$this->table}  ORDER BY product_date_creation DESC  LIMIT $displacement, $resultsPerPage ";
        } elseif ($sortingValue == 2) {
          $sql = " SELECT * FROM {$this->table}  ORDER BY product_likes DESC  LIMIT $displacement, $resultsPerPage ";
        } else {
          $sql = " SELECT * FROM {$this->table}  ORDER BY product_views DESC  LIMIT $displacement, $resultsPerPage ";
        }
        
      } else {
        $sql = " SELECT * FROM {$this->table} LIMIT $displacement, $resultsPerPage ";
      }
      
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
  }