<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Model file
   * File description:    This file is the database model.
   * Module:              Models
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  /**
   * This class defines the database model for the connection to the database with PDO.
   * Its methods are:
   *
   * - __construct
   * - connectionPDO
   * - getConnectionPDO
   * - closeConnectionPDO
   */
  class Database
  {
    private PDO $connectionPDO;
    
    /**
     * ModelDatabase class constructor
     */
    public function __construct ()
    {
      require_once (dirname (__DIR__, 1) . '/includes/functions.php');
      require_once (dirname (__DIR__, 2) . '/install/config.php');
      
      $this->connectionPDO ();
    }
    
    /**
     * Create a new PDO type connection to the database.
     *
     * @return void
     */
    private function connectionPDO (): void
    {
      $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ];
      
      try {
        $this->connectionPDO = new PDO('mysql:host=' . DB_HOSTNAME . '; dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, $options);
        $this->connectionPDO->exec ("SET CHARACTER SET UTF8");
      } catch (PDOException $e) {
        $this->closeConnectionPDO ();
        header ("Location: ../login.php?error=database-connect" . $e->getMessage());
      }
    }
    
    /**
     * Recovers the PDO type connection
     *
     * @return PDO
     */
    public function getConnectionPDO (): PDO
    {
      return $this->connectionPDO;
    }
    
    /**
     * Close the PDO type connection
     *
     * @return PDO
     */
    public function closeConnectionPDO (): PDO
    {
      return $this->connectionPDO = null;
    }
    
  }