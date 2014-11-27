<?php
  //shortcut to user
  class U {

    public $logged = false;
    public $id;
    public $is_admin = false;
    private $db;

    const COOKIE_DUR = 2592000; // 30 days
    const ADMIN_PRIVILEGE = 5;
    const COOKIE_NAME = "imdb";

    function __construct($db) {

      $this->db = $db;
      $this->_trylogin();
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
      $this->_init_cookie();
      $this->_set_admin($user['privilege']);

      return true;
    }

    public function create($username, $password) {
      if($this->logged) return false;

      $hash = $this->_create_hash($password);
      $user_id = $this->db->insert("USERS", array("username" => $username, "hash" => $hash));

      if(!$user_id) return false;

      $user_id = $user_id;

      $this->id = $user_id;
      $this->_init_session($hash);
      $this->_init_cookie();
      $this->logged = true;

      // Make first user admin
      if($user_id == '1') {
        $this->db->query("UPDATE USERS SET privilege = ? WHERE (user_id = ?) LIMIT 1", array(self::ADMIN_PRIVILEGE, $user_id));
        $this->is_admin = true;
      }

      return true;
    }

    public function logout() {
      if(!$this->logged) return false;

      $this->_unset_session();
      $this->_unset_cookie();

      $this->logged = false;
      $this->id = NULL;

      return true;
    }

    private function _trylogin() {
      global $C;

      if($this->logged) return false;
      if(!isset($_SESSION[$C->SITEURL."-id"])
        || !isset($_SESSION[$C->SITEURL."-hash"])) {
        // Try to get session from cookies
        if(!$this->_session_from_cookie()) return false;
      }

      $user_id = $_SESSION[$C->SITEURL."-id"];
      $hash = $_SESSION[$C->SITEURL."-hash"];

      $user = $this->db->query("SELECT username, privilege FROM USERS WHERE (user_id = ? AND hash = ?) LIMIT 1", array($user_id, $hash));
      if(count($user) == 0) return false;

      $this->id = $user_id;
      $this->logged = true;
      $this->_set_admin($user[0]['privilege']);
    }

    private function _create_hash($password) {
      $options = [
        'cost' => 9,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
      ];

      return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    private function _session_from_cookie() {
      global $C;

      if(!isset($_COOKIE[self::COOKIE_NAME])) return false;

      list($id, $hash) = explode("_", $_COOKIE[self::COOKIE_NAME], 2);

      $_SESSION[$C->SITEURL."-id"] = $id;
      $_SESSION[$C->SITEURL."-hash"] = $hash;

      return true;
    }

    private function _init_session($hash) {
      global $C;

      $_SESSION[$C->SITEURL."-id"] = $this->id;
      $_SESSION[$C->SITEURL."-hash"] = $hash;
    }

    private function _init_cookie() {
      global $C;

      $id = $_SESSION[$C->SITEURL."-id"];
      $hash = $_SESSION[$C->SITEURL."-hash"];

      setcookie(self::COOKIE_NAME, $id."_".$hash, time() + self::COOKIE_DUR);
    }

    private function _unset_session() {
      session_destroy();
    }

    private function _unset_cookie() {
      setcookie(self::COOKIE_NAME, "", time() - self::COOKIE_DUR);
    }

    private function _set_admin($privilege) {
      if($privilege == self::ADMIN_PRIVILEGE) {
        $this->is_admin = true;
      }
    }

  }
?>
