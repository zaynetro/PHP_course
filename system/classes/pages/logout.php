<?php

  class Logout extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      if(!$this->u->logged) {
        header("Location: /login");
        exit;
      }

      $this->u->logout();
      header("Location: /");
      exit;
    }

  }

?>
