<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file.
   * File description:    Main controller which calls its methods through the URL which is divided
   *                      in two parameters: For example: https://localhost/controller/method
   * Module:              Controllers.
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This class defines the administration controller class.
   */
  class AdminRouterController
  {
    
    /**
     * Checks if the method being called exists, if not use the default method
     *
     * @param $nameOfMethod string <p>Name of method to execute</p>
     * @return void
     */
    public function selectMethod (string $nameOfMethod): void
    {
      
      switch ($nameOfMethod) {
        
        case ($nameOfMethod === 'home'):
        case ($nameOfMethod === 'admin'):
          $this->admin ();
          break;
        
        case ($nameOfMethod === 'login'):
          $this->login ();
          break;
        
        case ($nameOfMethod === 'product-add'):
          $this->productAdd ();
          break;
        
        case ($nameOfMethod === 'product-categories'):
          $this->productCategories ();
          break;
        
        case ($nameOfMethod === 'product-edit'):
          $this->productEdit ();
          break;
        
        case ($nameOfMethod === 'product-list'):
          $this->productList ();
          break;
        
        case ($nameOfMethod === 'product-view'):
          $this->productView ();
          break;
        
        default:
          $this->admin ();
      }
    }
    
    /**
     * Load the home view
     *
     * @return void
     */
    public function home (): void
    {
      include 'public_html/views/admin/home.php';
    }
    
    /**
     * Load the home view
     *
     * @return void
     */
    public function admin (): void
    {
      include 'public_html/views/admin/home.php';
    }
    
    
    /**
     * Load the add product view
     *
     * @return void
     */
    public function productAdd (): void
    {
      include 'public_html/views/admin/products/product-add.php';
    }
    
    /**
     * Load the product category view
     *
     * @return void
     */
    public function productCategories (): void
    {
      include 'public_html/views/admin/products/product-categories.php';
    }
    
    /**
     * Load the edit product view
     *
     * @return void
     */
    public function productEdit (): void
    {
      include 'public_html/views/admin/products/product-edit.php';
    }
    
    /**
     * Load the product list view
     *
     * @return void
     */
    public function productList (): void
    {
      include 'public_html/views/admin/products/product-list.php';
    }
    
    /**
     * Load the view to see the product
     *
     * @return void
     */
    public function productView (): void
    {
      include 'public_html/views/admin/products/product-view.php';
    }
    
    /**
     * Load the home view
     *
     * @return void
     */
    public function login (): void
    {
      header ('Location: login.php');
    }
  }