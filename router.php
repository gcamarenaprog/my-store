<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Class
   * File description:    Intermediary between the routes and the controller, extracts the parameters from the URL and
   *                      goes to call the controller and its corresponding view if it exists.
   * Module:              Core
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This class is intermediary between the routes and the controller, extracts the parameters from the URL and
   * goes to call the controller and its corresponding view if it exists.
   *
   * - extractViewName ()
   * - matchRoute ()
   */
  class Router
  {
    # Name of the view being called
    private string $view;
    
    /**
     * Constructor of the Router class that executes the matchRouteAdministration or matchRouteCatalog view with the
     * template name as a parameter
     *
     * @param $templateName String Selected template name.
     */
    public function __construct (string $templateName)
    {
      # Extract view name from URL
      $this->extractViewName ();
      
      # Select view for routes
      $this->matchRoute ($templateName);
    }
    
    /**
     * Extracts the view name from the URL and if it doesn't exist, sets the default 'home' name
     *
     * @return void
     */
    public function extractViewName (): void
    {
      # Separates the words corresponding to the name of the controller and the view into an array
      $url = explode ('/', URL);
      $jsonURL = json_encode ($url);
      
      # Check if it contains 'page' or 'category' for store pagination
      $pageString = str_contains ($jsonURL, 'page') ? 1 : 0;
      $categoryString = str_contains ($jsonURL, 'category') ? 1 : 0;
      
      if ($pageString || $categoryString) {
        $this->view = 'shop';
      } else {
        # If the view does not exist, it defaults to the 'Main' controller
        $this->view = !empty($url[0]) ? $url[0] : 'store';
      }
      
    }
    
    /**
     * Extracts the URL information necessary to execute the corresponding controller file and view, for
     * administration template.
     *
     * @param $templateName
     * @return void
     */
    public function matchRoute ($templateName): void
    {
      require_once (__DIR__ . '/php/includes/Functions.php');
      $functionsObject = new Functions();
      
      # Separates the words corresponding to the name of the controller and the view into an array
      $url = explode ('/', URL);
      
      # Get root URL
      $rootUrl = $functionsObject->getRootUrl ();
      
      # Redirect to root if two or more parameters exist in the URL
      if (count ($url) > 1) {
        header ("Location: $rootUrl/store");
        exit();
      }
      
      # Select the controller to load the necessary views
      if ($templateName === 'store') {
        
        # Invoke the controller file dynamically
        require_once (__DIR__ . '/php/controllers/StoreRouterController.php');
        
        # Create a new instance of the class based on the controller of the current URL
        $controller = new StoreRouterController();
      } else {
        
        # Invoke the controller file dynamically
        require_once (__DIR__ . '/php/controllers/AdminRouterController.php');
        
        # Create a new instance of the class based on the controller of the current URL
        $controller = new AdminRouterController();
        
      }
      
      # Execute the view of the controller class
      $controller->selectView ($this->view);
    }
  }