<?php
  //shortcut to user
  class U {
    public $logged = false;
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
      // Check password by using password_verify($pass, $hash)
    }

    private function _create_hash($password) {
      $options = [
        'cost' => 9,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      ];

      return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function create($username, $password) {
      global $C;

      $hash = $this->_create_hash($password);
      $user_id = $this->db->insert("USERS", array("username" => $username, "hash" => $hash));

      if(!$user_id) return false;

      $this->id = $user_id;

      // TO DO: create session
      // $_SESSION[$C->SITEURL."-id"] = $this->id;
      // $_SESSION[$C->SITEURL."-hash"] = $hash;
    }

  }
?>
