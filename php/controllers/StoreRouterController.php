<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file.
   * File description:    Route controller for the store template, which invokes the select view method. This method
   *                      takes the URL, splits it, and takes the first parameter to execute the view based on its name.
   *                      For example: https://localhost/view
   * Module:              Controllers.
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This class defines the store controller class.
   */
  class StoreRouterController
  {
    
    /**
     * Selects the view based on the view name passed as a parameter.
     *
     * @param $nameOfMethod string
     * @return void
     */
    public function selectView (string $nameOfMethod): void
    {
      
      switch ($nameOfMethod) {
        
        case ($nameOfMethod === 'store'):
          $this->home ();
          break;
        
        case ($nameOfMethod === 'contact'):
          $this->contact ();
          break;
        
        case ($nameOfMethod === 'shop'):
          $this->shop ();
          break;
        
        case ($nameOfMethod === 'product'):
          $this->product ();
          break;
        
        default:
          $this->home ();
      }
    }
    
    /**
     * Load the home view.
     *
     * @return void
     */
    public function home (): void
    {
      include 'public_html/views/store/views/home.php';
    }
    
    /**
     * Load the shop view.
     *
     * @return void
     */
    public function shop (): void
    {
      include 'public_html/views/store/views/shop.php';
    }
    
    /**
     * Load the contact view.
     *
     * @return void
     */
    public function contact (): void
    {
      include 'public_html/views/store/views/contact.php';
    }
    
    /**
     * Load the product details view.
     *
     * @return void
     */
    public function product (): void
    {
      include 'public_html/views/store/views/product.php';
    }
  }
