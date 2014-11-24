<?php

  class Admin extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      if(!$this->u->is_admin) {
        header("Location: /");
        return;
      }

      $this->page->title = "Admin";

      if(count($pages) == 1) {
        $this->_show_main();
      }
    }

    private function _show_main() {
      $this->page->server_time = date("F j, Y, g:i a");
    }
  }
?>
