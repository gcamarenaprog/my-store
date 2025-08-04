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
  
  # = GET ALL products via AJAX for DataTable =
  if (isset($_GET['product_get_all'])) {
    ProductController::getProductsForProductList ();
  }
  
  # = DELETE product via Ajax for DataTable =
  if (isset($_POST['product_delete'])) {
    
    $productObject = new ProductController();
    $productData = array();
    
    $productID = $_POST['product_id'];
    
    $productData['productId'] = $_POST['product_id'];
    $productData['productName'] = $_POST['product_name'];
    
    # Content-Type: application/json
    header ('Content-Type: application/json');
    
    # Delete product by product id
    $queryResult = $productObject->deleteProduct ($productID);
    
    if ($queryResult) {
      $productData['title'] = '¡Proceso correcto!';
      $productData['message'] = 'El proceso se completó de manera exitosa.';
      $productData['confirmButtonText'] = 'Aceptar';
      $productData['icon'] = 'success';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    } else {
      $productData['title'] = '¡Error en el proceso!';
      $productData['message'] = 'El proceso no se completó correctamente.';
      $productData['confirmButtonText'] = 'Aceptar';
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    }
    
    
  }
  
  # = ADD new product via AJAX for DataTable =
  if (isset($_POST['product_add'])) {
    
    $objectFunctions = new Functions();
    $productData = array();
    $resultImageValidation = null;
    $productImagePath = null;
    
    # Content-Type: application/json
    header ('Content-Type: application/json');
    
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
      $productImagePath = 'public_html/resources/admin/dist/img/products/no_image.jpg';
    } elseif (!$_FILES['customFile']['error'] == 0) {
      if ($_FILES['customFile']['error'] == 1) {
        $productData['message'] = 'El archivo cargado excede la directiva upload_max_filesize en php.ini';
      } elseif ($_FILES['customFile']['error'] == 2) {
        $productData['message'] = 'El archivo cargado excede la directiva MAX_FILE_SIZE que se especificó en el formulario HTML';
      } elseif ($_FILES['customFile']['error'] == 3) {
        $productData['message'] = 'El archivo cargado solo se cargó parcialmente.';
      } elseif ($_FILES['customFile']['error'] == 5) {
        $productData['message'] = 'Falta una carpeta temporal.';
      } elseif ($_FILES['customFile']['error'] == 6) {
        $productData['message'] = 'Error al escribir el archivo en el disco';
      } elseif ($_FILES['customFile']['error'] == 7) {
        $productData['message'] = 'Una extensión PHP detuvo la carga del archivo';
      }
      
      # Preparing data for the error modal
      $productData['title'] = '¡Error en el proceso!';
      $productData['confirmButtonText'] = 'Aceptar';
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
          $productData['message'] = 'No se pudo mover el archivo.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-extension') {
          $productData['message'] = 'Extensión de archivo incorrecta.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-size') {
          $productData['message'] = 'Error en el tamaño de archivo.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-mime-type') {
          $productData['message'] = 'Archivo no válido.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-unknown') {
          $productData['message'] = 'No se pudo cargar el archivo.';
        }
        
        # Preparing data for the error modal
        $productData['title'] = '¡Error en el proceso!';
        $productData['confirmButtonText'] = 'Aceptar';
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
    $productName = $_POST['inputName'];
    $productSpecifications = $_POST['textAreaSpecifications'];
    $productBrand = $_POST['inputBrand'];
    $productModel = $_POST['inputModel'];
    $productPrice = $_POST['inputPrice'];
    $productQuantity = $_POST['inputQuantity'];
    $productCategories = implode (',', $_POST['selectCategories']);
    $productLastChange = date ("Y-m-d H:i:s");
    $productViews = 0;
    $productLikes = 0;
    $productCommentId = 0;
    
    $objectProduct = new ProductController();
    
    $data = " ('$productName', '$productSpecifications', '$productPrice', '$productQuantity',
        '$productCategories', '$productBrand', '$productModel', '$productViews', '$productLikes', '$productCommentId', '$productImagePath','$productLastChange') ";
    
    $columns = '(product_name, product_specs, product_price, product_quantity,
        product_categories, product_brand, product_model, product_views, product_likes, product_comment_id, product_image, product_date_last_change)';
    
    # Insert query
    $queryResult = $objectProduct->insertProduct ($columns, $data);
    
    if ($queryResult) {
      $productData['title'] = '¡Proceso correcto!';
      $productData['message'] = 'El proceso se completó de manera exitosa.';
      $productData['confirmButtonText'] = 'Aceptar';
      $productData['icon'] = 'success';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    } else {
      $productData['title'] = '¡Error en el proceso!';
      $productData['message'] = 'El proceso no se completó correctamente.';
      $productData['confirmButtonText'] = 'Aceptar';
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    }
    
  }
  
  # = UPDATE product via AJAX =
  if (isset($_POST['product_edit'])) {
    
    $objectFunctions = new Functions();
    $productData = array();
    $resultImageValidation = null;
    $productImagePath = null;
    
    # Content-Type: application/json
    header ('Content-Type: application/json');
    
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
      $productImagePath = 'public_html/resources/admin/dist/img/products/no_image.jpg';
    } elseif (!$_FILES['customFile']['error'] == 0) {
      if ($_FILES['customFile']['error'] == 1) {
        $productData['message'] = 'El archivo cargado excede la directiva upload_max_filesize en php.ini';
      } elseif ($_FILES['customFile']['error'] == 2) {
        $productData['message'] = 'El archivo cargado excede la directiva MAX_FILE_SIZE que se especificó en el formulario HTML';
      } elseif ($_FILES['customFile']['error'] == 3) {
        $productData['message'] = 'El archivo cargado solo se cargó parcialmente.';
      } elseif ($_FILES['customFile']['error'] == 5) {
        $productData['message'] = 'Falta una carpeta temporal.';
      } elseif ($_FILES['customFile']['error'] == 6) {
        $productData['message'] = 'Error al escribir el archivo en el disco';
      } elseif ($_FILES['customFile']['error'] == 7) {
        $productData['message'] = 'Una extensión PHP detuvo la carga del archivo';
      }
      
      # Preparing data for the error modal
      $productData['title'] = '¡Error en el proceso!';
      $productData['confirmButtonText'] = 'Aceptar';
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
          $productData['message'] = 'No se pudo mover el archivo.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-extension') {
          $productData['message'] = 'Extensión de archivo incorrecta.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-size') {
          $productData['message'] = 'Error en el tamaño de archivo.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-mime-type') {
          $productData['message'] = 'Archivo no válido.';
        } elseif ($resultImageValidation['imageFileProcess'] == 'error-file-unknown') {
          $productData['message'] = 'No se pudo cargar el archivo.';
        }
        
        # Preparing data for the error modal
        $productData['title'] = '¡Error en el proceso!';
        $productData['confirmButtonText'] = 'Aceptar';
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
    $productName = $_POST['inputName'];
    $productSpecifications = $_POST['textAreaSpecifications'];
    $productBrand = $_POST['inputBrand'];
    $productModel = $_POST['inputModel'];
    $productPrice = $_POST['inputPrice'];
    $productQuantity = $_POST['inputQuantity'];
    $productCategories = implode (',', $_POST['selectCategories']);
    $productLastChange = date ("Y-m-d H:i:s");
    
    $objectProduct = new ProductController();
    
    $productId = $_POST['productId'];
    
    $data = null;
    $data .= 'product_name = ' . '\'' . $productName . '\',';
    $data .= 'product_specs = ' . '\'' . $productSpecifications . '\',';
    $data .= 'product_price = ' . '\'' . $productPrice . '\',';
    $data .= 'product_quantity = ' . '\'' . $productQuantity . '\',';
    $data .= 'product_categories = ' . '\'' . $productCategories . '\',';
    $data .= 'product_brand = ' . '\'' . $productBrand . '\',';
    $data .= 'product_model = ' . '\'' . $productModel . '\',';
    $data .= 'product_image = ' . '\'' . $productImagePath . '\',';
    $data .= 'product_date_last_change = ' . '\'' . $productLastChange . '\'';
    
    # Update query
    $queryResult = $objectProduct->updateProduct ($productId, $data);
    
    if ($queryResult) {
      $productData['title'] = '¡Proceso correcto!';
      $productData['message'] = 'El proceso se completó de manera exitosa.';
      $productData['confirmButtonText'] = 'Aceptar';
      $productData['icon'] = 'success';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    } else {
      $productData['title'] = '¡Error en el proceso!';
      $productData['message'] = 'El proceso no se completó correctamente.';
      $productData['confirmButtonText'] = 'Aceptar';
      $productData['icon'] = 'error';
      $productData['confirmButtonColor'] = '#3085d6';
      # JSON encode data
      echo json_encode ($productData);
    }
    
  }
  
  # = EDIT a product =
  if (isset($_POST['product_go_to_edit'])) {
    session_start ();
    $_SESSION['editProductSessionFlag'] = $_POST['product_id_edit'];
  }
  
  # = VIEW a product =
  if (isset($_POST['product_go_to_view'])) {
    session_start ();
    $_SESSION['viewProductSessionFlag'] = $_POST['product_id_view'];
    echo 'ok';
  }
  
  # = VIEW details of a store product =
  if (isset($_POST['product_details_go_to_view'])) {
    session_start ();
    $_SESSION['viewProductDetailsSessionFlag'] = $_POST['product_id_view'];
    echo 'ok';
  }
  
  
  
  /**
   * This class defines the product controller class.
   *
   * - getTotalProducts
   * - getAllProducts
   * - getProduct
   * - deleteProduct
   * - updateProduct
   * - insertProduct
   * - getProductFormattedForDetailsView
   * - getProductsForProductList
   * - calculateTheDsiplacement
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
     * = Get total number of products. =
     *
     * @return int
     */
    function getTotalProducts (): int
    {
      return $this->model->getTotal ();
    }
    
    /**
     * = Get all recent products. =
     *
     * @return array|bool
     */
    function getAllRecentProducts (): array|bool
    {
      return $this->model->getAllRecentProducts ();
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
     * = Get all products of category id. =
     *
     * @param $categoryID
     * @return array|bool
     */
    function getCheapestProductOfCategoryID ($categoryID): array|bool
    {
      return $this->model->getCheapestProductOfCategoryID ($categoryID);
    }
    
    /**
     * = Get product data by product id. =
     *
     * @param string $productId Product id.
     * @return array | bool
     */
    function getProduct (string $productId): array|bool
    {
      return $this->model->getById ($productId);
    }
    
    /**
     * = Delete product data by product id. =
     *
     * @param string $productId Product id.
     * @return int
     */
    function deleteProduct (string $productId): int
    {
      return $this->model->deleteById ($productId);
    }
    
    /**
     * = Update a product. =
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
     * = Insert a new product. =
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
     * = Get product data formatted for details view. =
     *
     * @param string $productId Product id.
     * @return array
     */
    function getProductFormattedForDetailsView (string $productId): array
    {
      $objectFunctions = new Functions();
      $objectCategoriesProduct = new ProductCategoriesController();
      
      $productDataToProductDetailsViewArray[] = array();
      
      # Get product data
      $productData = $this->getProduct ($productId);
      
      $productDataToProductDetailsViewArray['productName'] = $objectFunctions->dataValidationText ($productData['product_name'], 'No hay datos');
      $productDataToProductDetailsViewArray['productSpecifications'] = $objectFunctions->dataValidationText ($productData['product_specs'], 'No hay datos');
      $productDataToProductDetailsViewArray['productPrice'] = number_format ($productData['product_price'], 2, '.', ',');
      $productDataToProductDetailsViewArray['productPriceClean'] = $objectFunctions->dataValidationText ($productData['product_price'], 'No hay datos');
      $productDataToProductDetailsViewArray['productQuantity'] = number_format ($productData['product_quantity'], 2, '.', ',');
      $productDataToProductDetailsViewArray['productCategories'] = $objectCategoriesProduct->getCategoriesNamesByIdsWithSeparator ($productData['product_categories'], '/');
      $productDataToProductDetailsViewArray['productBrand'] = $objectFunctions->dataValidationText ($productData['product_brand'], 'No hay datos');
      $productDataToProductDetailsViewArray['productModel'] = $objectFunctions->dataValidationText ($productData['product_model'], 'No hay datos');
      $productDataToProductDetailsViewArray['productViews'] = $objectFunctions->dataValidationText ($productData['product_views'], 'No hay datos');
      $productDataToProductDetailsViewArray['productLikes'] = $objectFunctions->dataValidationText ($productData['product_likes'], 'No hay datos');
      $productDataToProductDetailsViewArray['productCommentId'] = $objectFunctions->dataValidationText ($productData['product_comment_id'], 'No hay datos');
      $productDataToProductDetailsViewArray['productImage'] = $objectFunctions->dataValidationText ($productData['product_image'], 'No hay datos');
      $productDataToProductDetailsViewArray['productDateLastChange'] = $objectFunctions->dataValidationText ($productData['product_date_last_change'], 'No hay datos');
      $productDataToProductDetailsViewArray['productDateCreation'] = $objectFunctions->dataValidationText ($productData['product_date_creation'], 'No hay datos');
      
      return $productDataToProductDetailsViewArray;
    }
    
    /**
     * = Get all products formatted for all products view. =
     *
     * @return void
     */
    static function getProductsForProductList (): void
    {
      $productObject = new ProductController();
      $categoriesObject = new ProductCategoriesController();
      $result = $productObject->getAllProducts ();
      
      foreach ($result as $row) {
        $data[] = array(
          "product_id" => $row['product_id'],
          "product_name" => $row['product_name'],
          "product_specs" => $row['product_specs'],
          "product_price" => $row['product_price'],
          "product_quantity" => $row['product_quantity'],
          "product_categories" => $row['product_categories'],
          "product_brand" => $row['product_brand'],
          "product_model" => $row['product_model'],
          "product_views" => $row['product_views'],
          "product_likes" => $row['product_likes'],
          "product_comment_id" => $row['product_comment_id'],
          "product_image" => $row['product_image'],
          "product_date_last_change" => $row['product_date_last_change'],
          "product_date_creation" => $row['product_date_creation']
        );
      }
      $indexNumber = 1;
      $productsArrayOrdered[] = array();
      
      
      # Sort the data for the DataTables
      foreach ($data as $index => $item) {
        
        # No. [1. COLUMN] ----------------------------------------------------------------------------------------------
        $productsArrayOrdered[$index][0] = $indexNumber++;
        
        # Tools [2. COLUMN] --------------------------------------------------------------------------------------------
        $productsArrayOrdered[$index][1] = '
          <div class="btn-group" style="padding: 10px;">
          
            <!-- View button /-->
            <button type = "button"
                    class="btn btn-primary btn-flat store-tools-buttons"
                    title = "Ver"
                    onclick = "viewProductAjax(' . $item['product_id'] . ')" >
              <i class="fa-solid fa-eye"></i>
            </button>
            
            <!-- Edit buttons /-->
            <button type = "button"
                    class="btn btn-success btn-flat store-tools-buttons"
                    title = "Editar"
                    onclick = "editProductAjax(' . $item['product_id'] . ')" >
              <i class="fas fa-pen-to-square"></i>
            </button>
            
            <!-- Delete button /-->
            <button type = "button"
                    class="btn btn-danger btn-flat store-tools-buttons"
                    title = "Eliminar"
                    onclick = "deleteProductConfirmationModal(' . $item['product_id'] . ',\'' . $item['product_name'] . '\')" >
              <i class="fas fa-trash-can" ></i>
            </button>
            
          </div>
          
         ';
        
        # Image [3. COLUMN] --------------------------------------------------------------------------------------------
        // If there is no product image
        if (!isset($item['product_image']) || $item['product_image'] == null || $item['product_image'] == '') {
          $item['product_image'] = "public_html/resources/admin/dist/img/products/no_images.jpg";
        }
        $productsArrayOrdered[$index][2] = '
          <a href = "' . $item['product_image'] . '"
                  data-toggle = "lightbox"
                  data-title = "' . $item['product_name'] . '"
                  title = "Ver imágen"
                  data-footer = "' . $item['product_name'] . '">
                  <img  src = "' . $item['product_image'] . '"
                        width = "80px"
                        class="img-thumbnail img-fluid ininsys-product-view-all-image"
                        alt = "' . $item['product_name'] . '" >
              </a>
          ';
        
        # Name [4. COLUMN] ---------------------------------------------------------------------------------------------
        if (!$item['product_name']) {
          $productsArrayOrdered[$index][3] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][3] = $item['product_name'];
        }
        
        # Specifications [4. COLUMN] -----------------------------------------------------------------------------------
        if (!$item['product_specs']) {
          $productsArrayOrdered[$index][4] = 'No hay dato.';
        } else {
          $productsArrayOrdered[$index][4] = $item['product_specs'];
        }
        
        # Price [5. COLUMN] --------------------------------------------------------------------------------------------
        if ($item['product_price'] == 'no-data' || $item['product_price'] == '') {
          $productsArrayOrdered[$index][5] = 'No hay dato.';
        } else {
          $mxnPrice = floatval ($item['product_price']);
          $mxnPriceFormatted = number_format ($mxnPrice, 2, '.', ',');
          $productsArrayOrdered[$index][5] = $mxnPriceFormatted . ' MXN';
        }
        
        # Quantity [6. COLUMN] --------------------------------------------------------------------------------------------
        if (!$item['product_quantity']) {
          $productsArrayOrdered[$index][6] = 'No hay dato.';
        } else {
          $productsArrayOrdered[$index][6] = $item['product_quantity'];
        }
        
        # Categories [7. COLUMN] -----------------------------------------------------------------------------------------
        $categoriesNames = $categoriesObject->getCategoriesNamesByIdsWithSeparator ($item['product_categories'], ',');
        $productsArrayOrdered[$index][7] = $categoriesNames;
        
        # Brand [8. COLUMN] --------------------------------------------------------------------------------------------
        if (!$item['product_brand']) {
          $productsArrayOrdered[$index][8] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][8] = $item['product_brand'];
        }
        
        # Model [9. COLUMN] --------------------------------------------------------------------------------------------
        if (!$item['product_model']) {
          $productsArrayOrdered[$index][9] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][9] = $item['product_model'];
        }
        
        # Views [10. COLUMN] --------------------------------------------------------------------------------------------
        if (!$item['product_views']) {
          $productsArrayOrdered[$index][10] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][10] = $item['product_views'];
        }
        
        # Likes [11. COLUMN] -------------------------------------------------------------------------------------------
        if (!$item['product_likes']) {
          $productsArrayOrdered[$index][11] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][11] = $item['product_likes'];
        }
        
        # Comments [12. COLUMN] ----------------------------------------------------------------------------------------
        if (!$item['product_comment_id']) {
          $productsArrayOrdered[$index][12] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][12] = $item['product_comment_id'];
        }
        
        # Product Date Last Change [13. COLUMN] ------------------------------------------------------------------------
        if (!$item['product_date_last_change']) {
          $productsArrayOrdered[$index][13] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][13] = $item['product_date_last_change'];
        }
        
        
        # Product Date Creation [14. COLUMN] ---------------------------------------------------------------------------
        if (!$item['product_date_creation']) {
          $productsArrayOrdered[$index][14] = 'No hay datos.';
        } else {
          $productsArrayOrdered[$index][14] = $item['product_date_creation'];
        }
      }
      
      # An array is created with the data ordered and prepared for the table
      $new_array = array("data" => $productsArrayOrdered);
      
      # Print data JSON response
      echo json_encode ($new_array);
    }
    
    /**
     * = Get max score of the all products. =
     *
     * @return array|false
     */
    function getMaxScore (): false|array
    {
      return $this->model->getMaxScore ();
    }
    
    /**
     * = Get min score of the all products. =
     *
     * @return array|false
     */
    function getMinScore (): false|array
    {
      return $this->model->getMinScore ();
    }
    
    /**
     * = Calculate the displacement. =
     *
     * @param $displacement
     * @param $resultsPerPage
     * @return array|false
     */
    public function calculateTheDsiplacement ($displacement, $resultsPerPage, $sortingValue = 0): false|array
    {
      return $this->model->calculateTheDsiplacement ($displacement, $resultsPerPage, $sortingValue);
    }
    
  }