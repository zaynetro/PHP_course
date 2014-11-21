<?php

  class Login extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Log In";

      if(isset($_POST['username'])) $this->handle_post();
    }

    function handle_post() {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $user = $this->db->query("Select user_id FROM USERS WHERE (username=?) LIMIT 1", array($username));

      // TO DO: compare password hashes
    }

  }
?>
