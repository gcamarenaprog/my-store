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
   * This class defines the store controller class.
   * Its methods are:
   *
   * - selectMethod
   * - home
   */
  class StoreRouterController
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
     * Load the contact view.
     *
     * @return void
     */
    public function contact (): void
    {
      include 'public_html/views/store/views/contact.php';
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
     * Load the product view.
     *
     * @return void
     */
    public function product (): void
    {
      include 'public_html/views/store/views/product.php';
    }
  }
