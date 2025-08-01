<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file
   * File description:    Product categories controller
   * Module:              Controllers
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  require_once (dirname (__DIR__, 1) . '/models/ProductCategory.php');
  require_once (dirname (__DIR__, 1) . '/models/Product.php');
  
  # = GET ALL product categories via Ajax for DataTable =
  if (isset($_GET['categories_get_all'])) {
    ProductCategoriesController::getCategoriesForCategoriesList ();
  }
  
  # = ADD new product categories via Ajax =
  if (isset($_POST['category_add'])) {
    
    # JSON encode
    header ('Content-Type: application/json');
    
    $objectProductCategory = new ProductCategoriesController();
    
    $data = null;
    $dataFile = array();
    
    $dataFile['product_category_name'] = $categoryName = $_POST['inputCategoryNameAddForm'];
    $dataFile['product_category_description'] = $categoryDescription = $_POST['textAreaCategoryDescriptionAddForm'];
    $dataFile['product_category_parent'] = $categoryParent = $_POST['selectCategoryParentNameAddForm'];
    $dataFile['product_category_date_last_change'] = $categoryLastChange = date ("Y-m-d H:i:s");
    
    $data .= 'product_category_name = ' . '\'' . $categoryName . '\',';
    $data .= 'product_category_description = ' . '\'' . $categoryDescription . '\',';
    $data .= 'product_category_parent = ' . '\'' . $categoryParent . '\',';
    $data .= 'product_category_date_last_change = ' . '\'' . $categoryLastChange . '\'';
    
    $data = " ('$categoryName', '$categoryDescription', '$categoryParent', '$categoryLastChange') ";
    
    $columns = '(product_category_name, product_category_description, product_category_parent, product_category_date_last_change)';
    
    $queryResult = $objectProductCategory->insertProductCategory ($columns, $data);
    
    if ($queryResult) {
      $dataFile['message'] = 'success';
    } else {
      $dataFile['message'] = 'error';
    }
    
    echo json_encode ($dataFile);
  }
  
  # VIEW category via Ajax
  if (isset($_POST['categoryIdView'])) {
    
    $objectProductCategory = new ProductCategoriesController();
    
    $dataFile = array();
    $categoryId = $_POST['categoryIdView'];
    
    $categoryData = $objectProductCategory->getProductCategory ($categoryId);
    
    $data['product_category_id'] = $categoryData['product_category_id'];
    $data['product_category_name'] = $categoryData['product_category_name'];
    $data['product_category_description'] = $categoryData['product_category_description'];
    $data['product_category_parent'] = $categoryData['product_category_parent'];
    $data['product_category_date_last_change'] = $categoryData['product_category_date_last_change'];
    $data['product_category_date_creation'] = $categoryData['product_category_date_creation'];
    
    $totalProducts = $objectProductCategory->getTotalProductsCategoryByIdCategory ($categoryData['product_category_id']);
    $data['product_category_number_of_products'] = $totalProducts;
    
    echo json_encode ($data);
  }
  
  # DELETE product categories via Ajax
  if (isset($_POST['category_delete'])) {
    $productCategoriesObject = new ProductCategoriesController();
    $categoryId = $_POST['categoryIdDelete'];
    
    $totalProducts = $_POST['number_products'];
    $totalChild = $_POST['number_child'];
    
    $response = array();
    
    if ($totalProducts != 0) {
      $response['response'] = 'error-exists-products';
    } elseif ($totalChild != 0) {
      $response['response'] = 'error-exists-child';
    } else {
      $request = $productCategoriesObject->deleteProductCategoryById ($categoryId);
      if ($request == 1) {
        $response['response'] = 'successful';
      } else {
        $response['response'] = 'error';
      }
    }
    echo json_encode ($response);
    
  }
  
  # UPDATE product categories  via Ajax
  if (isset($_POST['category_update'])) {
    
    # JSON encode
    header ('Content-Type: application/json');
    
    $objectProductCategory = new ProductCategoriesController();
    
    $data = null;
    $dataFile = array();
    
    $dataFile['product_category_id'] = $categoryId = $_POST['inputCategoryIdEditForm'];
    $dataFile['product_category_name'] = $categoryName = $_POST['inputCategoryNameEditForm'];
    $dataFile['product_category_description'] = $categoryDescription = $_POST['textAreaCategoryDescriptionEditForm'];
    $dataFile['product_category_parent'] = $categoryParent = $_POST['selectCategoryParentNameEditForm'];
    $dataFile['product_category_date_last_change'] = $categoryLastChange = date ("Y-m-d H:i:s");
    
    // $categoryLastChange = date ("Y-m-d H:i:s");
    $data .= 'product_category_id = ' . '\'' . $categoryId . '\',';
    $data .= 'product_category_name = ' . '\'' . $categoryName . '\',';
    $data .= 'product_category_description = ' . '\'' . $categoryDescription . '\',';
    $data .= 'product_category_parent = ' . '\'' . $categoryParent . '\',';
    $data .= 'product_category_date_last_change = ' . '\'' . $categoryLastChange . '\'';
    
    $queryResult = $objectProductCategory->updateProductCategory ($categoryId, $data);
    
    if ($queryResult) {
      $dataFile['message'] = 'success';
    } else {
      $dataFile['message'] = 'error';
    }
    
    echo json_encode ($dataFile);
  }
  
  /**
   * This class defines the product categories controller class.
   *
   * - getTotalProductCategories
   * - getAllProductCategories
   * - getProductCategory
   * - deleteProductCategoryById
   * - updateProductCategory
   * - insertProduct
   * - getProductsCategoriesForCategoriesList
   */
  class ProductCategoriesController
  {
    private ProductCategory $model;
    
    /**
     * ProductCategoriesController class constructor
     */
    function __construct ()
    {
      $this->model = new ProductCategory();
    }
    
    /**
     * :: Get total number of categories. ::
     *
     * @return int
     */
    function getTotalProductCategories (): int
    {
      return $this->model->getTotal ();
    }
    
    /**
     * :: Get all the records from a table, if you want them sorted you must use the field and order parameters. ::
     *
     * @param string $order ASC | DESC | NONE
     * @param string $field Field to order, the field should exist on table.
     * @return array|bool
     */
    function getAllCategories (string $order = 'NONE', string $field = 'NONE'): array|bool
    {
      return $this->model->getAll ();
    }
    
    /**
     * :: Get the category data with the id category ::
     *
     * @param int $categoryId A number id of the product category.
     * @return array|bool The name of the category or false.
     */
    public function getProductCategory (int $categoryId): array|bool
    {
      return $this->model->getById ($categoryId);
    }
    
    /**
     * :: Delete a category with the category id ::
     *
     * @param int $categoryId The id of the category.
     * @return int Returns 1 if there was deleted and 0 if there was no deleted.
     */
    public function deleteProductCategoryById (int $categoryId): int
    {
      return $this->model->deleteById ($categoryId);
    }
    
    /**
     * :: Update category ::
     *
     * @param string $categoryId   Category id.
     * @param string $categoryData Data of product category to update.
     * @return int Returns 1 if there was updated and 0 if there was no updated.
     */
    public function updateProductCategory (string $categoryId, string $categoryData): int
    {
      return $this->model->updateById ($categoryId, $categoryData);
    }
    
    /**
     * :: Insert a new category ::
     *
     * @param string $dataColumns Names of columns.
     * @param string $data        Data of new record.
     * @return int Returns 1 if there was updated and 0 if there was no updated.
     */
    function insertProductCategory (string $dataColumns, string $data): int
    {
      return $this->model->insert ($dataColumns, $data);
    }
    
    /**
     * :: Get total products category by id category ::
     *
     * @param $categoryId
     * @return string
     */
    public function getTotalProductsCategoryByIdCategory ($categoryId): string
    {
      return $this->model->getTotalProductsCategoryByIdCategory ($categoryId);
    }
    
    /**
     * :: Gets total child categories by id category ::
     *
     * @param $categoryId
     * @return mixed
     */
    public function getTotalChildCategoriesByIdCategory ($categoryId): int
    {
      return $this->model->getTotalChildCategoriesByIdCategory ($categoryId);
    }
    
    /**
     * :: Get category name by id::
     *
     * @param int $categoryId Category id
     * @return string
     */
    public function getCategoryNameById (int $categoryId): string
    {
      return $this->model->getCategoryNameById ($categoryId);
    }
    
    /**
     * :: Get all categories names by ids ::
     *
     * @param string $categoriesIds String with categories id numbers.
     * @param string $separator     Character to separate the list of categories.
     * @return string
     */
    public function getAllCategoriesNamesById (string $categoriesIds, string $separator = ','): string
    {
      
      if ($categoriesIds == 'no-data') {
        $categoriesNames = 'No hay datos.';
      } else {
        $categoriesOfProduct = explode (",", $categoriesIds);
        $categoriesNames = '';
        $categoriesArraySize = count ($categoriesOfProduct);
        if ($categoriesArraySize != 1) {
          for ($index1 = 0; $index1 < $categoriesArraySize; $index1++) {
            $productId = $categoriesOfProduct[$index1];
            $productId = intval ($productId);
            $categoryName = $this->getCategoryNameById ($productId);
            if ($index1 == $categoriesArraySize - 1) {
              $categoriesNames .= $categoryName;
            } else {
              $categoriesNames .= $categoryName . ' ' . $separator . ' ';
            }
          }
        } else {
          $productId = intval ($categoriesOfProduct[0]);
          $categoryName = $this->getCategoryNameById ($productId);
          $categoriesNames = $categoryName;
        }
      }
      return $categoriesNames;
    }
    
    /**
     * :: Get all parent categories ::
     *
     * @return array
     */
    public function getAllParentCategories (): array
    {
      $result = $this->model->getAllParentCategories ();
      $data = array();
      foreach ($result as $row) {
        $data[] = array(
          "product_category_id" => $row['product_category_id'],
          "product_category_name" => $row['product_category_name'],
          "product_category_description" => $row['product_category_description'],
          "product_category_parent" => $row['product_category_parent'],
          "product_category_date_last_change" => $row['product_category_date_last_change'],
          "product_category_date_creation" => $row['product_category_date_creation']
        );
      }
      return $data;
    }
    
    /**
     * :: Get all product categories for DataTables format ::
     *
     * @return void
     */
    static function getCategoriesForCategoriesList (): void
    {
      $categoriesObject = new ProductCategoriesController();
      $result = $categoriesObject->getAllCategories ();
      
      foreach ($result as $row) {
        $data[] = array(
          "product_category_id" => $row['product_category_id'],
          "product_category_name" => $row['product_category_name'],
          "product_category_description" => $row['product_category_description'],
          "product_category_parent" => $row['product_category_parent'],
          "product_category_date_last_change" => $row['product_category_date_last_change'],
          "product_category_date_creation" => $row['product_category_date_creation']
        );
      }
      $indexNumber = 1;
      $categoriesArrayOrdered[] = array();
      
      # Sort the data for the DataTables
      foreach ($data as $index => $item) {
        
        # No. [0. COLUMN] ----------------------------------------------------------------------------------------------
        $categoriesArrayOrdered[$index][0] = $indexNumber++;
        
        # Tools [1. COLUMN] -----------------------------------------------------------------------------------------------
        $totalProducts = $categoriesObject->getTotalProductsCategoryByIdCategory ($item['product_category_id']);
        $totalChild = $categoriesObject->getTotalChildCategoriesByIdCategory ($item['product_category_id']);
        
        $categoriesArrayOrdered[$index][1] = '
          <div class="btn-group" style="padding: 10px;">
          
            <!-- View button /-->
            <button type = "button"
                    class="btn btn-primary btn-flat store-tools-buttons"
                    title = "Ver detalles de categoría."
                    onclick = "viewViewCategoryForm(' . $item['product_category_id'] . ')" >
              <i class="fa-solid fa-eye"></i>
            </button>
           
            <!-- Edit buttons /-->
            <button type = "button"
                    class="btn btn-success btn-flat store-tools-buttons"
                    title = "Editar categoría."
                    onclick = "viewEditCategoryForm(' . $item['product_category_id'] . ')" >
              <i class="fas fa-pen-to-square"></i>
            </button>
            
            <!-- Delete button /-->
            <button type = "button"
                    class="btn btn-danger btn-flat store-tools-buttons"
                    title = "Eliminar categoría."
                    onclick = "modalDeleteCategory(' . $item['product_category_id'] . ',\'' . $item['product_category_name'] . '\', \'' . $totalProducts . '\', \'' . $totalChild . '\')" >
              <i class="fas fa-trash-can" ></i>
            </button>
            
          </div>
          
         ';
        
        
        # Name [2. COLUMN] ---------------------------------------------------------------------------------------------
        if (!$item['product_category_name']) {
          $categoriesArrayOrdered[$index][2] = 'No hay datos.';
        } else {
          $categoriesArrayOrdered[$index][2] = $item['product_category_name'];
        }
        
        
        # Description [3. COLUMN] ---------------------------------------------------------------------------------------------
        if (!$item['product_category_description']) {
          $categoriesArrayOrdered[$index][3] = 'No hay datos.';
        } else {
          $categoriesArrayOrdered[$index][3] = $item['product_category_description'];
        }
        
        # Number of products [4. COLUMN] ---------------------------------------------------------------------------------------------
          $totalProducts = $categoriesObject->getTotalProductsCategoryByIdCategory ($item['product_category_id']);
          $categoriesArrayOrdered[$index][4] = $totalProducts;
        
        # Parent category [5. COLUMN] ---------------------------------------------------------------------------------------------
          $parentCategoryName = $categoriesObject->getCategoryNameById ($item['product_category_parent']);
          if($parentCategoryName){
            $categoriesArrayOrdered[$index][5] = $parentCategoryName;
          }else{
            $categoriesArrayOrdered[$index][5] = 'No tiene.';
          }
          
        # Date last change [6. COLUMN] ---------------------------------------------------------------------------------------------
        if (!$item['product_category_date_last_change']) {
          $categoriesArrayOrdered[$index][6] = 'No hay datos.';
        } else {
          $categoriesArrayOrdered[$index][6] = $item['product_category_date_last_change'];
        }
        
        # Date creation [7. COLUMN] ---------------------------------------------------------------------------------------------
        if (!$item['product_category_date_creation']) {
          $categoriesArrayOrdered[$index][7] = 'No hay datos.';
        } else {
          $categoriesArrayOrdered[$index][7] = $item['product_category_date_creation'];
        }
      }
      
      # An array is created with the data ordered and prepared for the table
      $new_array = array("data" => $categoriesArrayOrdered);
      
      # Print data Json
      echo json_encode ($new_array);
    }
    
  }