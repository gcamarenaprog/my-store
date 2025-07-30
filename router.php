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
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This class is intermediary between the routes and the controller, extracts the parameters from the URL and
   * goes to call the controller and its corresponding view if it exists.
   */
  class Router
  {
    # Name of the view being called
    private string $view;
    
    /**
     * Constructor of the Router class that executes the matchRouteAdministration or matchRouteCatalog view with the
     * template name as a parameter
     *
     * @param $templateName String <p> Selected template name </p>
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
      
      $this->view = !empty($url[0]) ? $url[0] : 'home';
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
      # Separates the words corresponding to the name of the controller and the view into an array
      $url = explode ('/', URL);
      
      # Redirect to root if two or more parameters exist in the URL
      if (count ($url) > 1) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim (dirname ($_SERVER['PHP_SELF']), '/\\');
        header ("Location: http://$host$uri/home");
        exit();
      }
      
      # Invoke the controller file dynamically
      require_once (__DIR__ . '/php/controllers/AdminRouterController.php');
      
      # Create a new instance of the class based on the controller of the current URL
      $controller = new AdminRouterController();
      
      # Execute the view of the controller class
      $controller->selectView ($this->view);
    }
  }