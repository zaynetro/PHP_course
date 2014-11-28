<?php

  class Login extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      if($this->u->logged) {
        header("Location: /");
        return;
      }

      $this->page->title = "Log In";

      if(isset($_POST['username'])) $this->_handle_post();
    }

    private function _handle_post() {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(!$this->u->login($username, $password)) {
        $this->page->error = "User doen't exist";
        return false;
      }

      header("Location: /");
      exit;
    }

  }
?>
