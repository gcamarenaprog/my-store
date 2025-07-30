<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file
   * File description:    Product controller
   * Module:              Controllers
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  require_once (dirname (__DIR__, 1) . '/models/Product.php');
  require_once (dirname (__DIR__, 1) . '/controllers/ProductController.php');
  require_once (dirname (__DIR__, 1) . '/controllers/ProductCategoriesController.php');
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  
  # GET ALL products via AJAX for DataTable_
  if (isset($_GET['getAllProducts'])) {
    
    # JSON decode language strings
    $objectLanguage = json_decode ($_GET['language']);
    
    ControllerProduct::getAllProductsFormattedForAllProductsView ($objectLanguage);
  }
  
  # DELETE product via Ajax for DataTable_
  if (isset($_POST['deleteProduct'])) {
    
    $productObject = new ControllerProduct();
    $productData = array();
    
    $productData['productId'] = $_POST['productId'];
    $productData['productName'] = $_POST['productName'];
    
    # Content-Type: application/json
    header ('Content-Type: application/json');
    
    # JSON decode language strings
    $objectLanguage = json_decode ($_POST['language']);
    
    # Delete product by product id
    $queryResult = $productObject->deleteProduct ($_POST['productId']);
    
    if ($queryResult) {
      $productData['title'] = $objectLanguage->MODAL_PROCESS_SUCCESSFUL_TITLE;
      $productData['message'] = $objectLanguage->MODAL_PROCESS_SUCCESSFUL_MESSAGE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'success';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    } else {
      $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
      $productData['message'] = $objectLanguage->MODAL_PROCESS_ERROR_MESSAGE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    }
    
  }
  
  # ADD new product via AJAX for DataTable_
  if (isset($_POST['addNewProduct'])) {
    
    $objectFunctions = new Functions();
    $productData = array();
    $resultImageValidation = null;
    $productImagePath = null;
    
    # Content-Type: application/json
    header ('Content-Type: application/json');
    
    # JSON decode language strings
    $objectLanguage = json_decode ($_POST['language']);
    
    # Upload file validation -------------------------------------------------------------------------------------------
    
    /**
     * Handling errors when uploading the file to the server
     *
     * 0 = UPLOAD_ERR_OK         => There is no error, the file uploaded with success. Then process continue.
     * 1 = UPLOAD_ERR_INI_SIZE   => The uploaded file exceeds the upload_max_filesize directive in php.ini.
     * 2 = UPLOAD_ERR_FORM_SIZE  => The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
     * 3 = UPLOAD_ERR_PARTIAL    => The uploaded file was only partially uploaded.
     * 4 = UPLOAD_ERR_NO_FILE    => No file was uploaded. Then process continue with no-image.jpg
     * 5 = UPLOAD_ERR_NO_TMP_DIR => Missing a temporary folder.
     * 6 = UPLOAD_ERR_CANT_WRITE => Failed to write file to disk.
     * 7 = UPLOAD_ERR_EXTENSION  => A PHP extension stopped the file upload.
     */
    if ($_FILES['customFile']['error'] == 4) {
      $productImagePath = 'views/resources/dist/img/modules/no_image.jpg';
    } elseif (!$_FILES['customFile']['error'] == 0) {
      if ($_FILES['customFile']['error'] == 1) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_INI_SIZE;
      } elseif ($_FILES['customFile']['error'] == 2) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_FORM_SIZE;
      } elseif ($_FILES['customFile']['error'] == 3) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_PARTIAL;
      } elseif ($_FILES['customFile']['error'] == 5) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_NO_TMP_DIR;
      } elseif ($_FILES['customFile']['error'] == 6) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_CANT_WRITE;
      } elseif ($_FILES['customFile']['error'] == 7) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_EXTENSION;
      }
      
      # Preparing data for the error modal
      $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      
      # JSON encode data
      echo json_encode ($productData);
      return false;
      
      # If exist file then:
    } elseif ($_FILES['customFile']['error'] == 0) {
      
      # File validation ------------------------------------------------------------------------------------------------
      
      $mimeTypesArray = array('image/png', 'image/jpeg');
      $extensionsArray = array('jpg', 'jpeg', 'png');
      $fileSize = 1500000;
      
      # File validation
      $resultImageValidation = $objectFunctions->fileValidation ($_FILES['customFile'], 'users', 'users', $mimeTypesArray, $fileSize, $extensionsArray);
      
      /**
       * Error handling when file validation fails
       *
       * error-file-move = MODAL_UPLOAD_ERROR_MOVE
       * error-file-extension = MODAL_UPLOAD_ERROR_EXTENSION
       * error-file-size = MODAL_UPLOAD_ERROR_SIZE
       * error-file-mime-type = MODAL_UPLOAD_ERROR_FILE
       * error-file-unknown = MODAL_UPLOAD_ERROR_UNKNOWN
       * successful = Process continue
       */
      if ($resultImageValidation['imageFileProcess'] != 'successful') {
        
        if ($resultImageValidation['imageFileProcess'] == 'error-file-move') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_MOVE;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-extension') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_EXTENSION;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-size') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_SIZE;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-mime-type') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_FILE;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-unknown') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_UNKNOWN;
        }
        
        # Preparing data for the error modal
        $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
        $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
        $productData['icon'] = 'error';
        $productData['confirmButtonColor'] = '#3085d6';
        
        # JSON encode data
        echo json_encode ($productData);
        return false;
        
      } else {
        $productImagePath = $resultImageValidation['imageFilePath'];
      }
    }
    
    # If there are no errors in the file validations, then:
    $productName = $_POST['inputDataName'];
    $productDescription = $_POST['textAreaDataDescription'];
    $productAdditionalDescription = $_POST['textAreaDataAdditionalInformation'] ?? 'no-data';
    $productQuantity = $_POST['inputInventoryQuantity'] ?? 'no-data';
    $productPriceUSD = $_POST['inputInventoryPriceUSD'] ?? 'no-data';
    $productPriceComments = $_POST['textAreaInventoryPriceComments'] ?? 'no-data';
    $productWeightKg = $_POST['inputMeasurementsWeightKg'] ?? 'no-data';
    $productWeightLb = $_POST['inputMeasurementsWeightLb_'] ?? 'no-data';
    $productLengthIn = $_POST['inputDimensionsLengthIn'] ?? 'no-data';
    $productLengthCm = $_POST['inputDimensionsLengthCm_'] ?? 'no-data';
    $productWidthIn = $_POST['inputDimensionsWidthIn'] ?? 'no-data';
    $productWidthCm = $_POST['inputDimensionsWidthCm_'] ?? 'no-data';
    $productHeightIn = $_POST['inputDimensionsHeightIn'] ?? 'no-data';
    $productHeightCm = $_POST['inputDimensionsHeightCm_'] ?? 'no-data';
    $productColor = $_POST['inputPropertiesColor'] ?? 'no-data';
    $productMaterial = $_POST['inputPropertiesMaterial'] ?? 'no-data';
    $productImageDescription = $_POST['textAreaImageDescription'] ?? 'no-data';
    $productPublishStatus = $_POST['customSwitchStatus'] ?? 'off';
    $productPublishCatalog = $_POST['customSwitchVisibility'] ?? 'off';
    $productCategories = implode (',', $_POST['selectCategories']);
    $productLastChange = date ("Y-m-d H:i:s");
    
    $objectProduct = new ControllerProduct();
    
    $data = " ('$productName', '$productDescription', '$productAdditionalDescription', '$productQuantity',
        '$productPriceUSD', '$productPriceComments', '$productWeightKg',
        '$productWeightLb', '$productLengthIn' , '$productLengthCm', '$productWidthIn', '$productWidthCm',
        '$productHeightIn', '$productHeightCm', '$productColor', '$productMaterial','$productImagePath',
        '$productImageDescription', '$productPublishStatus', '$productPublishCatalog', '$productCategories', '$productLastChange') ";
    
    $columns = '(product_general_name, product_general_description, product_general_additional_information, product_inventory_quantity,
        product_inventory_price_usd, product_inventory_price_comments, product_measures_weight_kg,
        product_measures_weight_lb, product_measures_length_cm, product_measures_length_in, product_measures_width_cm,
        product_measures_width_in, product_measures_height_cm, product_measures_height_in, product_properties_color,
        product_properties_material, product_image, product_image_description, product_publish_status, product_publish_catalog,
        product_categories, product_date_last_change)';
    
    # Insert query
    $queryResult = $objectProduct->insertProduct ($columns, $data);
    
    if ($queryResult) {
      $productData['title'] = $objectLanguage->MODAL_PROCESS_SUCCESSFUL_TITLE;
      $productData['message'] = $objectLanguage->MODAL_PROCESS_SUCCESSFUL_MESSAGE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'success';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    } else {
      $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
      $productData['message'] = $objectLanguage->MODAL_PROCESS_ERROR_MESSAGE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    }
    
  }
  
  # UPDATE product via AJAX
  if (isset($_POST['updateProduct'])) {
    
    $objectFunctions = new Functions();
    $productData = array();
    $resultImageValidation = null;
    $productImagePath = null;
    
    # Content-Type: application/json
    header ('Content-Type: application/json');
    
    # JSON decode language strings
    $objectLanguage = json_decode ($_POST['language']);
    
    # Upload file validation -------------------------------------------------------------------------------------------
    
    /**
     * Handling errors when uploading the file to the server
     *
     * 0 = UPLOAD_ERR_OK         => There is no error, the file uploaded with success. Then process continue.
     * 1 = UPLOAD_ERR_INI_SIZE   => The uploaded file exceeds the upload_max_filesize directive in php.ini.
     * 2 = UPLOAD_ERR_FORM_SIZE  => The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
     * 3 = UPLOAD_ERR_PARTIAL    => The uploaded file was only partially uploaded.
     * 4 = UPLOAD_ERR_NO_FILE    => No file was uploaded. Then process continue with no-image.jpg
     * 5 = UPLOAD_ERR_NO_TMP_DIR => Missing a temporary folder.
     * 6 = UPLOAD_ERR_CANT_WRITE => Failed to write file to disk.
     * 7 = UPLOAD_ERR_EXTENSION  => A PHP extension stopped the file upload.
     */
    if ($_FILES['customFile']['error'] == 4) {
      $productImagePath = 'views/resources/dist/img/modules/no_image.jpg';
    } elseif (!$_FILES['customFile']['error'] == 0) {
      if ($_FILES['customFile']['error'] == 1) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_INI_SIZE;
      } elseif ($_FILES['customFile']['error'] == 2) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_FORM_SIZE;
      } elseif ($_FILES['customFile']['error'] == 3) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_PARTIAL;
      } elseif ($_FILES['customFile']['error'] == 5) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_NO_TMP_DIR;
      } elseif ($_FILES['customFile']['error'] == 6) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_CANT_WRITE;
      } elseif ($_FILES['customFile']['error'] == 7) {
        $productData['message'] = $objectLanguage->MODAL_UPLOAD_ERROR_EXTENSION;
      }
      
      # Preparing data for the error modal
      $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      
      # JSON encode data
      echo json_encode ($productData);
      return false;
      
      # If exist file then:
    } elseif ($_FILES['customFile']['error'] == 0) {
      
      # File validation ------------------------------------------------------------------------------------------------
      
      $mimeTypesArray = array('image/png', 'image/jpeg');
      $extensionsArray = array('jpg', 'jpeg', 'png');
      $fileSize = 1500000;
      
      # File validation
      $resultImageValidation = $objectFunctions->fileValidation ($_FILES['customFile'], 'products', 'products', $mimeTypesArray, $fileSize, $extensionsArray);
      
      /**
       * Error handling when file validation fails
       *
       * error-file-move = MODAL_UPLOAD_ERROR_MOVE
       * error-file-extension = MODAL_UPLOAD_ERROR_EXTENSION
       * error-file-size = MODAL_UPLOAD_ERROR_SIZE
       * error-file-mime-type = MODAL_UPLOAD_ERROR_FILE
       * error-file-unknown = MODAL_UPLOAD_ERROR_UNKNOWN
       * successful = Process continue
       */
      if ($resultImageValidation['imageFileProcess'] != 'successful') {
        
        if ($resultImageValidation['imageFileProcess'] == 'error-file-move') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_MOVE;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-extension') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_EXTENSION;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-size') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_SIZE;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-mime-type') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_FILE;
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-unknown') {
          $productData['message'] = $objectLanguage->MODAL_FILE_ERROR_UNKNOWN;
        }
        
        # Preparing data for the error modal
        $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
        $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
        $productData['icon'] = 'error';
        $productData['confirmButtonColor'] = '#3085d6';
        
        # JSON encode data
        echo json_encode ($productData);
        return false;
        
      } else {
        $productImagePath = $resultImageValidation['imageFilePath'];
      }
    }
    
    # If there are no errors in the file validations, then:
    $productName = $_POST['inputDataName'];
    $productDescription = $_POST['textAreaDataDescription'];
    $productAdditionalDescription = $_POST['textAreaDataAdditionalInformation'] ?? 'no-data';
    $productQuantity = $_POST['inputInventoryQuantity'] ?? 'no-data';
    $productPriceUSD = $_POST['inputInventoryPriceUSD'] ?? 'no-data';
    $productPriceComments = $_POST['textAreaInventoryPriceComments'] ?? 'no-data';
    $productWeightKg = $_POST['inputMeasurementsWeightKg'] ?? 'no-data';
    $productWeightLb = $_POST['inputMeasurementsWeightLb_'] ?? 'no-data';
    $productLengthIn = $_POST['inputDimensionsLengthIn'] ?? 'no-data';
    $productLengthCm = $_POST['inputDimensionsLengthCm_'] ?? 'no-data';
    $productWidthIn = $_POST['inputDimensionsWidthIn'] ?? 'no-data';
    $productWidthCm = $_POST['inputDimensionsWidthCm_'] ?? 'no-data';
    $productHeightIn = $_POST['inputDimensionsHeightIn'] ?? 'no-data';
    $productHeightCm = $_POST['inputDimensionsHeightCm_'] ?? 'no-data';
    $productColor = $_POST['inputPropertiesColor'] ?? 'no-data';
    $productMaterial = $_POST['inputPropertiesMaterial'] ?? 'no-data';
    $productImageDescription = $_POST['textAreaImageDescription'] ?? 'no-data';
    $productPublishStatus = $_POST['customSwitchStatus'] ?? 'off';
    $productPublishCatalog = $_POST['customSwitchVisibility'] ?? 'off';
    $productCategories = implode (',', $_POST['selectCategories']);
    $productLastChange = date ("Y-m-d H:i:s");
    
    $objectProduct = new ControllerProduct();
    
    $productId = $_POST['productId'];
    
    $data = null;
    $data .= 'product_general_name = ' . '\'' . $productName . '\',';
    $data .= 'product_general_description = ' . '\'' . $productDescription . '\',';
    $data .= 'product_general_additional_information = ' . '\'' . $productAdditionalDescription . '\',';
    $data .= 'product_inventory_quantity = ' . '\'' . $productQuantity . '\',';
    $data .= 'product_inventory_price_usd = ' . '\'' . $productPriceUSD . '\',';
    $data .= 'product_inventory_price_comments = ' . '\'' . $productPriceComments . '\',';
    
    $data .= 'product_measures_weight_kg = ' . '\'' . $productWeightKg . '\',';
    $data .= 'product_measures_weight_lb = ' . '\'' . $productWeightLb . '\',';
    
    $data .= 'product_measures_length_cm = ' . '\'' . $productLengthCm . '\',';
    $data .= 'product_measures_length_in = ' . '\'' . $productLengthIn . '\',';
    
    $data .= 'product_measures_width_cm = ' . '\'' . $productWidthCm . '\',';
    $data .= 'product_measures_width_in = ' . '\'' . $productWidthIn . '\',';
    
    $data .= 'product_measures_height_cm = ' . '\'' . $productHeightCm . '\',';
    $data .= 'product_measures_height_in = ' . '\'' . $productHeightIn . '\',';
    
    $data .= 'product_properties_color = ' . '\'' . $productColor . '\',';
    $data .= 'product_properties_material = ' . '\'' . $productMaterial . '\',';
    
    $data .= 'product_image = ' . '\'' . $productImagePath . '\',';
    $data .= 'product_image_description = ' . '\'' . $productImageDescription . '\',';
    $data .= 'product_publish_status = ' . '\'' . $productPublishStatus . '\',';
    $data .= 'product_publish_catalog = ' . '\'' . $productPublishCatalog . '\',';
    $data .= 'product_categories = ' . '\'' . $productCategories . '\',';
    $data .= 'product_date_last_change = ' . '\'' . $productLastChange . '\'';
    
    # Update query
    $queryResult = $objectProduct->updateProduct ($productId, $data);
    
    if ($queryResult) {
      $productData['title'] = $objectLanguage->MODAL_PROCESS_SUCCESSFUL_TITLE;
      $productData['message'] = $objectLanguage->MODAL_PROCESS_SUCCESSFUL_MESSAGE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'success';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    } else {
      $productData['title'] = $objectLanguage->MODAL_PROCESS_ERROR_TITLE;
      $productData['message'] = $objectLanguage->MODAL_PROCESS_ERROR_MESSAGE;
      $productData['confirmButtonText'] = $objectLanguage->MODAL_BUTTON_ACCEPT;
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    }
    
  }
  
  # UPDATE a product_
  if (isset($_POST['productIdEdit'])) {
    session_start ();
    $_SESSION['editProductSessionFlag'] = $_POST['productIdEdit'];
  }
  
  # VIEW a product_
  if (isset($_POST['productIdView'])) {
    session_start ();
    $_SESSION['viewProductSessionFlag'] = $_POST['productIdView'];
  }
  
  /**
   * This class defines the product controller class.
   *
   * - getTotalProducts
   * - getAllProducts
   * - getAllProductsForDataTables
   * - getProduct
   * - deleteProduct
   * - updateProduct
   * - insertProduct
   * - getProductFormattedForDetailsView
   * - getAllProductsFormattedForAllProductsView
   */
  class ProductController
  {
    private Product $model;
    
    /**
     * Product controller constructor.
     */
    function __construct ()
    {
      $this->model = new Product();
    }
    
    /**
     * Get total number of products.
     *
     * @return int
     */
    function getTotalProducts (): int
    {
      return $this->model->getTotal ();
    }
    
    /**
     * Get all the records from a table, if you want them sorted you must use the field and order parameters.
     *
     * @param string $order ASC | DESC | NONE
     * @param string $field Field to order, the field should exist on table.
     * @return array|bool
     */
    function getAllProducts (string $order = 'NONE', string $field = 'NONE'): array|bool
    {
      return $this->model->getAll ();
    }
    
    /**
     * Get all products for DataTables format.
     *
     * @return bool|mysqli_result
     */
    public function getAllProductsForDataTables (): mysqli_result|bool
    {
      return $this->model->getAllProductsForDataTables ();
    }
    
    /**
     * Get product data by product id.
     *
     * @param string $productId Product id.
     * @return array | bool
     */
    function getProduct (string $productId): array|bool
    {
      return $this->model->getById ($productId);
    }
    
    /**
     * Delete product data by product id.
     *
     * @param string $productId Product id.
     * @return int
     */
    function deleteProduct (string $productId): int
    {
      return $this->model->deleteById ($productId);
    }
    
    /**
     * Update a product.
     *
     * @param string $productId Product id.
     * @param string $data      Data for update record.
     * @return int
     */
    function updateProduct (string $productId, string $data): int
    {
      return $this->model->updateById ($productId, $data);
    }
    
    /**
     * Insert a new product.
     *
     * @param string $dataColumns Names of columns.
     * @param string $data        Data of new record.
     * @return int
     */
    function insertProduct (string $dataColumns, string $data): int
    {
      return $this->model->insert ($dataColumns, $data);
    }
    
    /**
     * Get product data formatted for details view.
     *
     * @param string   $productId Product id.
     * @param stdClass $language  Object of language strings
     * @return array
     */
    function getProductFormattedForDetailsView (string $productId, stdClass $language): array
    {
      $objectFunctions = new Functions();
      $objectCategoriesProduct = new ControllerProductCategories();
      
      $productDataToProductDetailsViewArray[] = array();
      
      # Get product data
      $productData = $this->getProduct ($productId);
      
      $productDataToProductDetailsViewArray['productName'] = $objectFunctions->dataValidationText ($productData['product_general_name'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productDescription'] = $objectFunctions->dataValidationText ($productData['product_general_description'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productAdditionalInformation'] = $objectFunctions->dataValidationText ($productData['product_general_additional_information'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productQuantity'] = $objectFunctions->dataValidationText ($productData['product_inventory_quantity'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productPriceUSD'] = number_format ($productData['product_inventory_price_usd'], 2, '.', ',');
      $productDataToProductDetailsViewArray['productPriceMXN'] = number_format ($productData['product_inventory_price_usd'] * $_COOKIE['dollarValue'], 2, '.', ',');
      $productDataToProductDetailsViewArray['productPriceComments'] = $objectFunctions->dataValidationText ($productData['product_inventory_price_comments'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productWeightKg'] = $objectFunctions->dataValidationText ($productData['product_measures_weight_kg'], '0');
      $productDataToProductDetailsViewArray['productWeightLb'] = $objectFunctions->dataValidationText ($productData['product_measures_weight_lb'], '0');
      $productDataToProductDetailsViewArray['productLengthIn'] = $objectFunctions->dataValidationText ($productData['product_measures_length_in'], '0');
      $productDataToProductDetailsViewArray['productLengthCm'] = $objectFunctions->dataValidationText ($productData['product_measures_length_cm'], '0');
      $productDataToProductDetailsViewArray['productWidthIn'] = $objectFunctions->dataValidationText ($productData['product_measures_width_in'], '0');
      $productDataToProductDetailsViewArray['productWidthCm'] = $objectFunctions->dataValidationText ($productData['product_measures_width_cm'], '0');
      $productDataToProductDetailsViewArray['productHeightIn'] = $objectFunctions->dataValidationText ($productData['product_measures_height_in'], '0');
      $productDataToProductDetailsViewArray['productHeightCm'] = $objectFunctions->dataValidationText ($productData['product_measures_height_cm'], '0');
      $productDataToProductDetailsViewArray['productColor'] = $objectFunctions->dataValidationText ($productData['product_properties_color'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productMaterial'] = $objectFunctions->dataValidationText ($productData['product_properties_material'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productCategories'] = $objectCategoriesProduct->getAllCategoriesNamesById ($productData['product_categories'], $language, '/');
      $productDataToProductDetailsViewArray['productImage'] = $productData['product_image'];
      $productDataToProductDetailsViewArray['productImageDescription'] = $objectFunctions->dataValidationText ($productData['product_image_description'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productRegistrationDate'] = $objectFunctions->dataValidationText ($productData['product_date_creation'], $language->NO_DATA);
      $productDataToProductDetailsViewArray['productLastChangeDate'] = $objectFunctions->dataValidationText ($productData['product_date_last_change'], $language->NO_DATA);
      $productPublishStatus = $objectFunctions->dataValidationText ($productData['product_publish_status'], $language->INACTIVE);
      
      if ($productPublishStatus == 'on') {
        $productPublishStatus = $language->ACTIVE;
      }
      
      $productDataToProductDetailsViewArray['productPublishStatus'] = $productPublishStatus;
      $productPublishCatalog = $objectFunctions->dataValidationText ($productData['product_publish_catalog'], $language->INACTIVE);
      
      
      if ($productPublishCatalog == 'on') {
        $productPublishCatalog = $language->ACTIVE;
      }
      
      $productDataToProductDetailsViewArray['productPublishCatalog'] = $productPublishCatalog;
      
      return $productDataToProductDetailsViewArray;
    }
    
    /**
     * Get all products formatted for all products view.
     *
     * @param stdClass $languageObject Array of text strings of selected language.
     * @return void
     */
    static function getAllProductsFormattedForAllProductsView (stdClass $languageObject): void
    {
      $productObject = new ControllerProduct();
      $categoriesObject = new ControllerProductCategories();
      $productsArray = array();
      
      $allProducts = $productObject->getAllProductsForDataTables ();
      
      # The data is sorted to create a new array
      while ($data = $allProducts->fetch_object ()) {
        $productsArray[] = array(
          $data->product_id,                              // [0]  | Id
          $data->product_id,                              // [1]  | Tools
          $data->product_image,                           // [2]  | Image
          $data->product_general_name,                    // [3]  | Name
          $data->product_general_description,             // [4]  | Description
          $data->product_general_additional_information,  // [5]  | Additional information
          $data->product_categories,                      // [6]  | Categories
          $data->product_inventory_quantity,              // [7]  | Amount
          $data->product_inventory_price_usd,             // [8]  | Price USD
          $data->product_inventory_price_comments,        // [9]  | Price comments
          $data->product_measures_weight_kg,              // [10] | Weight kg
          $data->product_measures_weight_lb,              // [11] | Weight lb
          $data->product_measures_length_cm,              // [12] | Length cm
          $data->product_measures_length_in,              // [13] | Length in
          $data->product_measures_width_cm,               // [14] | Width cm
          $data->product_measures_width_in,               // [15] | Width in
          $data->product_measures_height_cm,              // [16] | Height cm
          $data->product_measures_height_in,              // [17] | Height in
          $data->product_properties_color,                // [18] | Color
          $data->product_properties_material,             // [19] | Material
          $data->product_publish_status,                  // [20] | Status
          $data->product_publish_catalog,                 // [21] | Catalog
          $data->product_date_last_change,                // [22] | Last change
          $data->product_date_creation,                   // [23] | Date creation
          $data->product_image_description                // [24] | Description
        );
      }
      
      $indexNumber = 1;
      $productsArrayOrdered[] = array();
      
      # Sort the data for the DataTables
      foreach ($productsArray as $index => $item) {
        
        # No. [COLUMN] -------------------------------------------------------------------------------------------------
        $productsArrayOrdered[$index][0] = $indexNumber++;
        
        # Tools [COLUMN] -----------------------------------------------------------------------------------------------
        $productsArrayOrdered[$index][1] = '
          <div class="btn-group" style="padding: 10px;">
          
            <!-- View button /-->
            <button type = "button"
                    class="btn btn-primary btn-flat ininsys-tools-buttons"
                    title = "' . $languageObject->VIEW . '"
                    onclick = "viewProduct(' . $item[1] . ')" >
              <i class="fa-solid fa-eye"></i>
            </button>
            
            <!-- Edit buttons /-->
            <button type = "button"
                    class="btn btn-success btn-flat ininsys-tools-buttons"
                    title = "' . $languageObject->EDIT . '"
                    onclick = "editProduct(' . $item[1] . ')" >
              <i class="fas fa-pen-to-square"></i>
            </button>
            
            <!-- Delete button /-->
            <button type = "button"
                    class="btn btn-danger btn-flat ininsys-tools-buttons"
                    title = "' . $languageObject->DELETE . '"
                    onclick = "deleteProduct(' . $item[1] . ',\'' . $item[3] . '\')" >
              <i class="fas fa-trash-can" ></i>
            </button>
            
          </div>
          
         ';
        
        # Image [COLUMN] -----------------------------------------------------------------------------------------------
        // If there is no product image
        if (!isset($item[2]) || $item[2] == null || $item[2] == '') {
          $item[2] = "views/resources/dist/img/products/no_image.jpg";
        }
        $productsArrayOrdered[$index][2] = '
          <a href = "' . $item[2] . '"
                  data-toggle = "lightbox"
                  data-title = "' . $item[3] . '"
                  title = "' . $languageObject->ZOOM_IMAGE . '"
                  data-footer = "' . $item[24] . '">
                  <img  src = "' . $item[2] . '"
                        width = "80px"
                        class="img-thumbnail img-fluid ininsys-product-view-all-image"
                        alt = "' . $item[3] . '" >
              </a>
          ';
        
        # Name [COLUMN] ------------------------------------------------------------------------------------------------
        if (!$item[3]) {
          $productsArrayOrdered[$index][3] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][3] = $item[3];
        }
        
        # Description [COLUMN] -----------------------------------------------------------------------------------------
        if (!$item[4]) {
          $productsArrayOrdered[$index][4] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][4] = $item[4];
        }
        
        # Additional information [COLUMN] ------------------------------------------------------------------------------
        if ($item[5] == 'no-data' || $item[5] == '') {
          $productsArrayOrdered[$index][5] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][5] = $item[5];
        }
        
        # Categories [COLUMN] ------------------------------------------------------------------------------------------
        $categoriesNames = $categoriesObject->getAllCategoriesNamesById ($item[6], $languageObject, ',');
        $productsArrayOrdered[$index][6] = $categoriesNames;
        
        # Quantity [COLUMN] ----------------------------------------------------------------------------------------------
        if ($item[7] == 'no-data' || $item[7] == '') {
          $productsArrayOrdered[$index][7] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][7] = $item[7];
        }
        
        # Price USD [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[8] == 'no-data' || $item[8] == '') {
          $productsArrayOrdered[$index][8] = $languageObject->NO_DATA;
        } else {
          //$productsArrayOrdered[$index][8] = $item[8] . ' USD';
          $usdPrice = floatval ($item[8]);
          $usdPriceFormatted = number_format ($usdPrice, 2, '.', ',');
          $productsArrayOrdered[$index][8] = $usdPriceFormatted . ' USD';
        }
        
        # Price MXN [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[8] == 'no-data' || $item[8] == '') {
          $productsArrayOrdered[$index][9] = $languageObject->NO_DATA;
        } else {
          $mxnPrice = floatval ($_COOKIE["dollarValue"]) * floatval ($item[8]);
          $mxnPriceFormatted = number_format ($mxnPrice, 2, '.', ',');
          $productsArrayOrdered[$index][9] = $mxnPriceFormatted . ' MXN';
        }
        
        # Price comments [COLUMN] --------------------------------------------------------------------------------------
        if ($item[9] == 'no-data' || $item[9] == '') {
          $productsArrayOrdered[$index][10] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][10] = $item[9];
        }
        
        # Weight Kg [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[10] == 'no-data' || $item[10] == '') {
          $productsArrayOrdered[$index][11] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][11] = $item[10] . ' kg';
        }
        
        # Weight Lb [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[11] == 'no-data' || $item[11] == '') {
          $productsArrayOrdered[$index][12] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][12] = $item[11] . ' lb';
        }
        
        # Length cm [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[12] == 'no-data' || $item[12] == '') {
          $productsArrayOrdered[$index][13] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][13] = $item[12] . ' cm';
        }
        
        # Length in [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[13] == 'no-data' || $item[13] == '') {
          $productsArrayOrdered[$index][14] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][14] = $item[13] . ' in';
        }
        
        # Width cm [COLUMN] --------------------------------------------------------------------------------------------
        if ($item[14] == 'no-data' || $item[14] == '') {
          $productsArrayOrdered[$index][15] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][15] = $item[14] . ' cm';
        }
        
        # Width in [COLUMN] --------------------------------------------------------------------------------------------
        if ($item[15] == 'no-data' || $item[15] == '') {
          $productsArrayOrdered[$index][16] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][16] = $item[15] . ' in';
        }
        
        # Height cm [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[16] == 'no-data' || $item[16] == '') {
          $productsArrayOrdered[$index][17] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][17] = $item[16] . ' cm';
        }
        
        # Height in [COLUMN] -------------------------------------------------------------------------------------------
        if ($item[17] == 'no-data' || $item[17] == '') {
          $productsArrayOrdered[$index][18] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][18] = $item[17] . ' in';
        }
        
        # Color [COLUMN] -----------------------------------------------------------------------------------------------
        if ($item[18] == 'no-data' || $item[18] == '') {
          $productsArrayOrdered[$index][19] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][19] = $item[18];
        }
        
        # Material [COLUMN] --------------------------------------------------------------------------------------------
        if ($item[19] == 'no-data' || $item[19] == '') {
          $productsArrayOrdered[$index][20] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][20] = $item[19];
        }
        
        # Status [COLUMN] ----------------------------------------------------------------------------------------------
        if (!$item[20]) {
          $productsArrayOrdered[$index][21] = $languageObject->NO_DATA;
        } else {
          if ($item[20] == 'on') {
            $productsArrayOrdered[$index][21] = $languageObject->ACTIVE;
          } else {
            $productsArrayOrdered[$index][21] = $languageObject->INACTIVE;
          }
        }
        
        # Catalogue [COLUMN] -------------------------------------------------------------------------------------------
        if (!$item[21]) {
          $productsArrayOrdered[$index][22] = $languageObject->NO_DATA;
        } else {
          if ($item[21] == 'on') {
            $productsArrayOrdered[$index][22] = $languageObject->ACTIVE;
          } else {
            $productsArrayOrdered[$index][22] = $languageObject->INACTIVE;
          }
        }
        
        # Last change date [COLUMN] ------------------------------------------------------------------------------------
        if (!$item[22]) {
          $productsArrayOrdered[$index][23] = $languageObject->NO_DATA;
        } else {
          $productsArrayOrdered[$index][23] = $item[22];
        }
        
        # Date creation [COLUMN] ------------------------------------------------------------------------------------
        $productsArrayOrdered[$index][24] = $item[23];
      }
      
      # An array is created with the data ordered and prepared for the table
      $new_array = array("data" => $productsArrayOrdered);
      
      # Print data JSON response
      echo json_encode ($new_array);
    }
  }