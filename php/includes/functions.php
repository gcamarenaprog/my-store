<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Class
   * File description:    Contains the definition of global system functions
   * Module:              Core
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This class defines the global system functions.
   * Its functions are:
   *
   * - cleanStringFromInput
   * - sessionsInitializeSessionVariable
   * - sessionsAddNewValue
   */
  class Functions
  {
    
    /**
     * Test function.
     * @return void
     */
    static function test (){
      echo 'Silence is golden!';
    }
    
    # General Functions ------------------------------------------------------------------------------------------------
    
    /**
     * Shows the user's image if it exists, otherwise shows a default image.
     *
     * @return void
     */
    static function showUserImage (): void
    {
      # If no exists user image
      if (!isset($_SESSION['user_image'])) {
        echo 'public_html/resources/dist/img/users/no_image.jpg';
      } else {
        echo $_SESSION['user_image'];
      }
    }
    
    /**
     * Clean strings by cleaning them of whitespace, forward slashes, and special characters.
     *
     * @param string $string String to clean.
     *
     * @return string
     */
    static function cleanStringFromInput (string $string): string
    {
      $string = trim ($string); // Clean start and end string of blanks
      $string = stripslashes ($string); // Remove slashes from a string with escaped quotes e.g. \'
      return htmlspecialchars ($string); // Convert special characters to HTML entities
    }
    
    # Menu functions ---------------------------------------------------------------------------------------------------
    
    /**
     * This functions set class active, if is selected.
     *
     * @param string $function Is the class name to activate for function in the menu.
     * @param string $string   URL captured.
     * @param string $namePage Name of page.
     *
     * @return void
     */
    static function menuActive (string $function, string $string, string $namePage): void
    {
      $pos = strpos ($string, $namePage);
      if ($pos === false) {
      } else {
        if ($function === 'menuActiveItem' || $function === 'menuOpenedActive') {
          echo "active";
        } elseif ($function === 'menuOpened') {
          echo "menu-is-opening menu-open";
        }
      }
    }
    
    # Session functions ------------------------------------------------------------------------------------------------
    
    /**
     * This function initialize to $_SESSION variable with the user data in an
     * associative array, the data add in the session of variable are:
     *
     * @param Array $dataUser Associative array with data user.
     *
     * @return void
     */
    static function sessionsInitializeSessionVariable (array $dataUser): void
    {
      $_SESSION['user_id'] = $dataUser['user_id'];
      $_SESSION['user_username'] = $dataUser['user_username'];
      $_SESSION['user_name'] = $dataUser['user_name'];
      $_SESSION['user_lastname'] = $dataUser['user_last_name'];
      $_SESSION['user_role'] = $dataUser['user_role'];
      $_SESSION['user_mail'] = $dataUser['user_mail'];
      $_SESSION['user_phone'] = $dataUser['user_phone'];
      $_SESSION['user_extra_information	'] = $dataUser['user_extra_information'];
      $_SESSION['user_language'] = $dataUser['user_language'];
      $_SESSION['user_status'] = $dataUser['user_status'];
      $_SESSION['user_image'] = $dataUser['user_image'];
      $_SESSION['user_date_last_change'] = $dataUser['user_date_last_change'];
      $_SESSION['user_date'] = $dataUser['user_date'];
    }
    
    /**
     * This function add new data to array of the $_SESSION variable
     *
     * @param String $newName The name of the new value.
     * @param String $newData The data of the new value.
     *
     * @return void
     */
    static function sessionsAddNewValue (string $newName, string $newData): void
    {
      $_SESSION[$newName] = $newData;
    }
    
  }