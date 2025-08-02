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
        echo 'public_html/resources/admin/dist/img/users/no_image.jpg';
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
    
    /**
     * Validates whether a variable is null, empty, or has a string value.
     *
     * @param string $value   Value to evaluate in the function.
     * @param string $message Text string returned if null or empty.
     *
     * @return string|null
     */
    function dataValidationText (string $value, string $message): string | null
    {
      if ($value == null) {
        return $message;
      } elseif($value == '1969-12-31 16:00:00'){
        return null;
      } else{
        return $value;
      }
    }
    
    /**
     * Image validation, copy and move to destination folder
     *
     * @param array  $fileContent    $_FILE content of the uploaded file.
     * @param string $folderName     Folder name to save files.
     * @param string $filePrefix     Prefix name for name file of file uploaded.
     * @param array  $mimeTypesArray Array with valid MIME types.
     * @param int    $fileSizeValid  Minimum file size valid.
     * @param array  $extensionArray Array with valid file extensions.
     *
     * @return array
     */
    function fileValidation (array $fileContent, string $folderName, string $filePrefix, array $mimeTypesArray, int $fileSizeValid, array $extensionArray): array
    {
      // Data: File name e.g. image.jpg
      $fileName = $fileContent['name'];
      
      // Data: Filetype e.g. image/jpeg
      $fileMimeType = $fileContent['type'];
      
      // Data: Filetype e.g. C:\xampp\tmp\phpC45D.tmp
      $fileTemporalName = $fileContent['tmp_name'];
      
      // Data: Filetype e.g. 748391 in Kb
      $fileSize = $fileContent['size'];
      
      // Data: Get image dimensions e.g. Array ( [0] => 1920 [1] => 845 [2] => 2 [3] => width="1920" height="845" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
      $fileDimensions = getimagesize ($fileContent['tmp_name']);
      
      // Data: Document root e.g. './public_html/'
      $documentRoot = $_SERVER['DOCUMENT_ROOT'];
      
      // Full path for image
      $fileDirectoryDestination = $documentRoot . '/public_html/resources/admin/dist/img/' . $folderName . '/';
      
      // Get file extension
      $fileExtensionExtracted = explode (".", $fileName);
      
      // Data: File extension e.g. jpg
      $fileExtension = strtolower (end ($fileExtensionExtracted));
      
      // Data: New file name with prefix and date.
      $fileNewFileName = $filePrefix . '_' . date ("Y-m-d_h-i-s") . '.' . $fileExtension;
      
      // Data: New path of the image file
      $filePathForDatabase = 'public_html/resources/admin/dist/img/' . $folderName . '/' . $fileNewFileName;
      
      // Data: New name and path
      $fileNameAndPath = $fileDirectoryDestination . $fileNewFileName; // File names and pat e.g. files/image_file.jpg
      
      // Validate MIME type
      if (in_array ($fileMimeType, $mimeTypesArray)) {
        
        // Validate image size < 1.5 MB
        if ($fileSize < $fileSizeValid) {
          
          // Validate file allowed extensions
          if (in_array($fileExtension, $extensionArray)) {
            
            // Directory in which the uploaded file will be moved
            if (move_uploaded_file ($fileTemporalName, $fileNameAndPath)) {
              
              $dataFile['imageFileProcess'] = 'successful';
              $dataFile['imageFilePath'] = $filePathForDatabase;
              
              return $dataFile;
              
            } else {
              return $dataFile['imageFileProcess'] = 'error-file-move';
            }
          } else {
            return $dataFile['imageFileProcess'] = 'error-file-extension';
          }
        } else {
          return $dataFile['imageFileProcess'] = 'error-file-size';
        }
      } else {
        return $dataFile['imageFileProcess'] = 'error-file-mime-type';
      }
      return $dataFile['imageFileProcess'] = 'error-file-unknown';
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