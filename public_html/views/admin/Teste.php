<?php
  # Required files
  require_once (dirname (__DIR__, 3) . '/php/models/Generic.php');
  require_once (dirname (__DIR__, 1) . '/admin/Teste.php');
  
  class Teste extends Generic
  {
    
    protected string $table;
    protected string $field;
    
    /**
     * Constructor of the Product model class
     */
    public function __construct ()
    {
      parent::__construct ('products', 'product_id');
    }
    
    public function getData (): void
    {
      
      
      // Fetch records
      $stmt = $this->connectionPDO->prepare ("SELECT * FROM {$this->table} ");
      $stmt->execute ();
      $empRecords = $stmt->fetchAll ();
      
      $data = array();
      
      foreach ($empRecords as $row) {
        $data[] = array(
          "product_id" => $row['product_id'],
          "product_name" => $row['product_name'],
          "product_specs" => $row['product_specs'],
          "product_price" => $row['product_price'],
          "product_category_id" => $row['product_category_id'],
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
      
      foreach ($data as $index => $item) {
        $productsArrayOrdered[$index][0] = $indexNumber++;
        $productsArrayOrdered[$index][1] = $item['product_name'];
        
        # Tools [1. COLUMN] -----------------------------------------------------------------------------------------------
        $productsArrayOrdered[$index][1] = '
          <div class="btn-group" style="padding: 10px;">
          
            <!-- View button /-->
            <button type = "button"
                    class="btn btn-primary btn-flat ininsys-tools-buttons"
                    title = "Ver"
                    onclick = "viewProduct(' . $item['product_id'] . ')" >
              <i class="fa-solid fa-eye"></i>
            </button>
            
            <!-- Edit buttons /-->
            <button type = "button"
                    class="btn btn-success btn-flat ininsys-tools-buttons"
                    title = "Editar"
                    onclick = "editProduct(' . $item['product_id'] . ')" >
              <i class="fas fa-pen-to-square"></i>
            </button>
            
            <!-- Delete button /-->
            <button type = "button"
                    class="btn btn-danger btn-flat ininsys-tools-buttons"
                    title = "Eliminar"
                    onclick = "deleteProduct(' . $item['product_id'] . ',\'' . $item[3] . '\')" >
              <i class="fas fa-trash-can" ></i>
            </button>
            
          </div>
          
         ';
        
      }
      # An array is created with the data ordered and prepared for the table
      $new_array = array("data" => $productsArrayOrdered);
      
      echo json_encode ($new_array);
    }
    
  }
  
  
  $object = new Teste();
  $object->getData ();
    
