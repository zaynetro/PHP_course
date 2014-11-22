<?php

  class Signup extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Sign up";

      if(isset($_POST['username'])) $this->_handle_post();
    }

    private function _handle_post() {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $repeat_pass = $_POST['repeatpassword'];

      if(strlen($username) < 1) {
        $this->page->error = "Input username";
        return false;
      }

      if(!preg_match("/^[a-z0-9_]+$/i", $username)) {
        $this->page->error = "Use lating characters, numbers and underscore only in username";
        return false;
      }

      if(strlen($password) < 5) {
        $this->page->error = "Password should be at least 5 symbols long";
        return false;
      }

      if($password != $repeat_pass) {
        $this->page->error = "Passwords don't match";
        return false;
      }

      $user_exists = $this->db->query("SELECT user_id FROM USERS WHERE (username = ?) LIMIT 1", array($username));
      if(count($user_exists) > 0) {
        $this->page->error = "Selected username is taken";
        return false;
      }

      // TO DO: create password hash, add user to db and start session
      if(!$this->u->create($username, $password)) {
        $this->page->error = "There was a problem with database query, try again";
        return false;
      }

      // TO DO: redirect user to somewhere
    }

  }
?>
