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
    
    
    public function insertData ($dataColumns, $data): int|bool
    {
      return parent::insert ($dataColumns, $data);
    }
    
    /**
     * Check exist a user if username and password match in database and return a row with the user data.
     *
     * @param string $user     <p>String with the username</p>
     * @param string $password <p>String with the password</p>
     * @return mixed
     */
    public function verifyUserAndPassword  (string $user, string $password): mixed
    {
      $sql = "SELECT * FROM " . $this->table . " WHERE user_username = '$user' AND user_password = '$password' ";
      $sth = $this->connectionPDO->prepare ($sql);
      $sth->execute ();
      return $sth->fetch (PDO::FETCH_ASSOC);
    }
    
    /**
     * Get all users with user role
     *
     * @param $role
     * @return bool|array
     */
    public function getAllUsersWithRole ($role): bool|array
    {
      $sql = " SELECT * FROM {$this->table} WHERE user_role = {$role} ";
      $statement = $this->connectionPDO->prepare ($sql);
      $statement->execute ();
      return $statement->fetchAll ();
    }
    
    public function getUserName (int $id): string
    {
      $sql = "SELECT * FROM $this->table WHERE user_id = '$id'";
      $sth = $this->connectionPDO->prepare ($sql);
      $sth->execute ();
      $result = $sth->fetch (PDO::FETCH_ASSOC);
      return $result['user_name'] .' '. $result['user_last_name'];
    }
    
    
  }