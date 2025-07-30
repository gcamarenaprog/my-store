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
        
        case ($nameOfMethod === 'admin'):
          $this->admin ();
          break;
        
        case ($nameOfMethod === 'login'):
          $this->login ();
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
      include "public_html/views/admin/view-home.php";
    }
    
    /**
     * Load the home view
     *
     * @return void
     */
    public function admin (): void
    {
      include "public_html/views/admin/view-home.php";
    }
    
    /**
     * Load the home view
     *
     * @return void
     */
    public function login (): void
    {
      header ("Location: login.php");
    }
    
  }