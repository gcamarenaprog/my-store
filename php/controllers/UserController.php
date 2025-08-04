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
   *
   * - getTotalUsers
   * - getUserById
   * - verifyUserAndPassword
   */
  class UserController
  {
    private User $model;
    
    /**
     * = User controller construct. =
     */
    function __construct ()
    {
      $this->model = new User();
    }
    
    /**
     * = Get total number of users. =
     *
     * @return int
     */
    function getTotalUsers (): int
    {
      return $this->model->getTotal ();
    }
    
    /**
     * @return array|bool
     */
    function getUserById ($userId): bool|array
    {
      return $this->model->getById ($userId);
    }
    
    /**
     * = Verify if exists user and password. =
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