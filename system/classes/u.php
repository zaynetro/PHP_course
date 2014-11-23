<?php
  //shortcut to user
  class U {

    public $logged = false;
    public $id;
    public $is_admin = false;
    private $db;

    function __construct($db) {

      $this->db = $db;
      $this->_trylogin();
    }

    private function _trylogin() {
      global $C;
      // Try to log in using $_SESSION
      if($this->logged) return false;
      if(!isset($_SESSION[$C->SITEURL."-id"])) return false;
      if(!isset($_SESSION[$C->SITEURL."-hash"])) return false;

      $user_id = $_SESSION[$C->SITEURL."-id"];
      $hash = $_SESSION[$C->SITEURL."-hash"];

      $user = $this->db->query("SELECT username, privilege FROM USERS WHERE (user_id = ? AND hash = ?) LIMIT 1", array($user_id, $hash));
      if(count($user) == 0) return false;

      $this->id = $user_id;
      $this->logged = true;
      $this->_set_admin($user[0]['privilege']);
    }

    public function login($username, $password) {
      if($this->logged) return false;
      // Check password by using password_verify($pass, $hash)
      $user = $this->db->query("SELECT user_id, hash, privilege FROM USERS WHERE (username = ?) LIMIT 1", array($username));
      if(count($user) == 0) return false;
      $user = $user[0];

      if(!password_verify($password, $user['hash'])) return false;

      $this->id = $user['user_id'];
      $this->logged = true;
      $this->_init_session($user['hash']);
      $this->_set_admin($user['privilege']);

      return true;
    }

    private function _create_hash($password) {
      $options = [
        'cost' => 9,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      ];

      return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function create($username, $password) {
      if($this->logged) return false;

      $hash = $this->_create_hash($password);
      $user_id = $this->db->insert("USERS", array("username" => $username, "hash" => $hash));

      if(!$user_id) return false;

      $user_id = $user_id;

      $this->id = $user_id;
      $this->_init_session($hash);
      $this->logged = true;

      // Make first user admin
      if($user_id == '1') {
        $this->db->query("UPDATE USERS SET privilege = ? WHERE (user_id = ?) LIMIT 1", array(5, $user_id));
        $this->is_admin = true;
      }

      return true;
    }

    private function _init_session($hash) {
      global $C;

      $_SESSION[$C->SITEURL."-id"] = $this->id;
      $_SESSION[$C->SITEURL."-hash"] = $hash;
    }

    private function _unset_session() {
      global $C;

      $_SESSION[$C->SITEURL."-id"] = NULL;
      $_SESSION[$C->SITEURL."-hash"] = NULL;

      unset($_SESSION[$C->SITEURL."-id"]);
      unset($_SESSION[$C->SITEURL."-hash"]);
    }

    public function logout() {
      if(!$this->logged) return false;

      $this->_unset_session();

      $this->logged = false;
      $this->id = NULL;

      return true;
    }

    private function _set_admin($privilege) {
      if($privilege == 5) {
        $this->is_admin = true;
      }
    }

  }
?>
