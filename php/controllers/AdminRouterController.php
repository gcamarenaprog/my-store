<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file.
   * File description:    Route controller for the admin template, which invokes the select view method. This method
   *                      takes the URL, splits it, and takes the first parameter to execute the view based on its name.
   *                      For example: https://localhost/view
   * Module:              Controllers.
   * Revised:             13-08-2025
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
     * @param $nameOfView string
     * @return void
     */
    public function selectView (string $nameOfView): void
    {
      
      switch ($nameOfView) {
        
        case ($nameOfView === 'admin'):
          $this->home ();
          break;
        
        case ($nameOfView === 'login'):
          $this->login ();
          break;
        
        case ($nameOfView === 'product-add'):
          $this->productAdd ();
          break;
        
        case ($nameOfView === 'product-categories'):
          $this->productCategories ();
          break;
        
        case ($nameOfView === 'product-edit'):
          $this->productEdit ();
          break;
        
        case ($nameOfView === 'product-list'):
          $this->productList ();
          break;
        
        case ($nameOfView === 'product-view'):
          $this->productView ();
          break;
        
        default:
          $this->store ();
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
     * Load the add product view
     *
     * @return void
     */
    public function productAdd (): void
    {
      include 'public_html/views/admin/products/product-add.php';
    }
    
    /**
     * Load the product categories view
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
     * Load the view product details
     *
     * @return void
     */
    public function productView (): void
    {
      include 'public_html/views/admin/products/product-view.php';
    }
    
    /**
     * Load the login view
     *
     * @return void
     */
    public function login (): void
    {
      header ('Location: login.php');
    }
    
    
    /**
     * Load the store view
     *
     * @return void
     */
    public function store (): void
    {
      header ('Location: store');
    }
  }