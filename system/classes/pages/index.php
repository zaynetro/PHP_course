<?php

  class Index extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Home";

      $this->_index();
    }

    private function _index() {
      $this->page->movies = $this->db->query("SELECT movie_id, title FROM MOVIES ORDER BY created_at LIMIT 5");
      $this->page->actors = $this->db->query("SELECT actor_id, name FROM ACTORS ORDER BY created_at LIMIT 5");
    }

  }
?>
