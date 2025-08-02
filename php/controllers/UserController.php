<?php
  /**
   * -------------------------------------------------------------------------------------------------------------------
   * Project name:        Store
   * Project description: Selection process skills assessment.
   * Version:             1.0.0
   * File type:           Controller file.
   * File description:    User controller.
   * Module:              Controllers.
   * -------------------------------------------------------------------------------------------------------------------
   */
  
  # Required files
  require_once (dirname (__DIR__, 1) . '/includes/functions.php');
  require_once (dirname (__DIR__, 1) . '/models/User.php');
  require_once (dirname (__DIR__, 1) . '/controllers/UserController.php');
  
  /**
   * This class defines the user controller class.
   * Its methods are:
   *
   * - __construct
   * - getTotalUsers
   * - getAllUsers
   * - getUser
   * - verifyUserAndPassword
   */
  class UserController
  {
    private User $model;
    
    /**
     * User Controller Constructor
     */
    function __construct ()
    {
      $this->model = new User();
    }
    
    /**
     * Get total number of users.
     *
     * @return int
     */
    function getTotalUsers (): int
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
    function getAllUsers (string $order = 'none', string $field = 'none'): array|bool
    {
      return $this->model->getAll ();
    }
    
    
    /**
     * This method return a user from with the parameter id
     *
     * @param $id
     * @return array|bool
     */
    function getUser ($id): array|bool
    {
      return $this->model->getById ($id);
    }
    
    /***
     * This method checks if a user and password exist in the database users table
     *
     * @param string $user
     * @param string $password
     *
     * @return mixed
     */
    function verifyUserAndPassword (string $user, string $password): mixed
    {
      return $this->model->verifyUserAndPassword ($user, $password);
    }
    
  }