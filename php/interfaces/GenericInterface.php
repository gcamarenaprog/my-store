<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Interface file
   * File description:    Generic interface
   * Module:              Interfaces
   * Revised:             13-08-2025
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This interface defines the generic interface class.
   *
   * - getTotal
   * - getAll
   * - getById
   * - deleteById
   * - updateById
   * - insert
   */
  interface GenericInterface
  {
    
    /**
     * Get total number records of a table.
     *
     * @return bool|int
     */
    public function getTotal (): bool|int;
    
    /**
     * Get all records of a table.
     *
     * @param string $order
     * @param string $field
     * @return bool|array
     */
    public function getAll (string $order, string $field): bool|array;
    
    /**
     * Get record by id.
     *
     * @param string $id User id number.
     * @return array|bool
     */
    public function getById (string $id): array|bool;
    
    /**
     * Generic method that deletes a record that matches the id passed as a parameter.
     *
     * @param string $id User id number.
     * @return int
     */
    public function deleteById (string $id): int;
    
    /**
     * Update a record by id and data as parameters.
     *
     * @param string $id   User id number.
     * @param string $data Data to update on record.
     * @return int
     */
    public function updateById (string $id, string $data): int;
    
    /**
     * Insert a new record.
     *
     * @param string $dataColumns Column name array.
     * @param string $data        Data to insert as a new record.
     * @return int
     */
    public function insert (string $dataColumns, string $data): int;
    
  }
