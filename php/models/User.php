<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Model file
   * File description:    This file is the user model.
   * Module:              Models
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  require_once (__DIR__ . '/Generic.php');
  
  /**
   * This class defines the User model class
   *
   * - checkIfTheUserAndPasswordExist
   */
  class User extends Generic
  {
    
    /**
     * Constructor of the User class
     */
    public function __construct ()
    {
      parent::__construct ('users', 'user_id');
    }
    
    /**
     * = Verify if exists user and password. =
     *
     * @param string $user
     * @param string $password
     * @return array|bool
     */
    public function checkIfTheUserAndPasswordExist  (string $user, string $password): array | bool
    {
      $sql = "SELECT * FROM " . $this->table . " WHERE user_username = '$user' AND user_password = '$password' ";
      $sth = $this->connectionPDO->prepare ($sql);
      $sth->execute ();
      return $sth->fetch ();
    }
    
  }