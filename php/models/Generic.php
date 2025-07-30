<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Model file
   * File description:    This file is the generic model.
   * Module:              Models
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (__DIR__ . '/Database.php');
  require_once (dirname (__DIR__, 1) . '/interfaces/GenericInterface.php');
  
  /**
   * This class defines the user model class. This class inherits from the Database model class.
   * Its methods are:
   *
   * - getTotal
   * - getAll
   * - getById
   * - deleteById
   * - updateById
   * - insert
   */
  class Generic extends Database implements GenericInterface
  {
    
    protected string $table;
    protected string $field;
    
    /**
     * ModelGeneric class constructor with the parameters: table name and field.
     *
     * @param $table string <p>Name of the table to use.</p>
     * @param $field string <p>Name of the field of the table to use.</p>
     */
    public function __construct (string $table, string $field)
    {
      parent::__construct ();
      $this->connectionPDO = parent::getConnectionPDO ();
      $this->table = $table;
      $this->field = $field;
    }
    
    /**
     * Returns the total number of records of the table.
     *
     * @return int
     */
    public function getTotal (): int
    {
      $sql = " SELECT COUNT(*) FROM {$this->table} ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchColumn ();
    }
    
    /**
     * Get all the records from a table, if you want them sorted you must use the field and order parameters.
     *
     * @param string $order ASC | DESC | NONE, Return all records ordered, If this option is used with the field option.
     * @param string $field Field to order. If this option is used, the field order is also used.
     *
     * @return array|bool
     */
    public function getAll (string $order = 'NONE', string $field = 'NONE'): array|bool
    {
      if ($order == 'NONE' || $field == 'NONE') {
        $sql = " SELECT * FROM {$this->table} ";
      } else {
        $sql = " SELECT * FROM {$this->table} ORDER BY $field $order";
      }
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    /**
     * Returns a record that matches the Id passed as a parameter.
     *
     * @param $id Identifier of the record to obtain.
     */
    public function getById ($id): bool|array
    {
      $sql = " SELECT * FROM {$this->table} WHERE {$this->field} = '$id' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetch ();
    }
    
    /**
     * Generic method that deletes a record that matches the id passed as a parameter
     *
     * @param $id Identifier of the record to delete.
     *
     * @return int Zero is an error and one is successful.
     */
    public function deleteById ($id): int
    {
      $sql = "DELETE FROM {$this->table} WHERE {$this->field} = '$id' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->rowCount ();
    }
    
    /**
     * Generic method that updates a record that matches the id passed as a parameter
     *
     * @param string $id   Record id to update.
     * @param string $data Data to update.
     * @return int
     */
    public function updateById (string $id, string $data): int
    {
      $sql = "UPDATE {$this->table} SET $data WHERE {$this->field} = '$id' ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->rowCount ();
    }
    
    /**
     * Generic method that inserts a new record
     *
     * @param string $dataColumns Name of columns in order.
     * @param string $data Data in same order that data columns.
     *
     * @return int
     */
    public function insert (string $dataColumns, string $data): int
    {
      $sql = "INSERT INTO {$this->table} $dataColumns VALUES $data ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->rowCount ();
    }
    
  }
