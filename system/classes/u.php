<?php
  //shortcut to user
  class U {
    public $id;
    private $db;

    function __construct($db) {

      $this->db = $db;
      $this->_trylogin();
    }

    private function _trylogin() {
      // Try to log in using $_SESSION
    }

    public function login($username, $password) {

    }

    private function _create_hash($password) {
      $options = [
        'cost' => 9,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      ];

      return password_hash($password, PASSWORD_BCRYPT, $options);
    }

  }
?>
