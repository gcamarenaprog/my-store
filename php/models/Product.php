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
   * - getCheaperProducts
   * - getRecentProductsList
   * - getMaxScore
   * - getMinScore
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
     * = Get cheaper products list =
     *
     * @param $categoryId
     * @return array|bool
     */
    public function getCheaperProducts ($categoryId): array|bool
    {
      $sql = " SELECT product_id, product_name, product_image, product_likes, product_price, product_views, MIN(product_price) FROM {$this->table} WHERE  product_categories LIKE '%$categoryId%' ";
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
     * = Get a list of top-rated products. =
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
            $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_date_creation DESC  LIMIT $displacement, $resultsPerPage ";
          } else {
            $sql = " SELECT * FROM {$this->table} WHERE  FIND_IN_SET ('$categoryId',product_categories) ORDER BY product_date_creation DESC  LIMIT $displacement, $resultsPerPage ";
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
            $sql = " SELECT * FROM {$this->table}  ORDER BY product_date_creation DESC  LIMIT $displacement, $resultsPerPage ";
          } elseif ($sortingValue == 2) {
            $sql = " SELECT * FROM {$this->table}  ORDER BY product_likes DESC  LIMIT $displacement, $resultsPerPage ";
          } else {
            $sql = " SELECT * FROM {$this->table}  ORDER BY product_views DESC  LIMIT $displacement, $resultsPerPage ";
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