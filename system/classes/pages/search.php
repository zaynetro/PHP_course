<?php

  class Search extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Search";

      $this->_index();
    }

    private function _index() {
      $q = urldecode($_GET['q']);
      $this->page->query = $q;

      $q = '%'.$q.'%';

      $query = "SELECT movie_id, title FROM MOVIES WHERE title LIKE ? ORDER BY title";
      $this->page->movies = $this->db->query($query, array($q));

      $query = "SELECT actor_id, name FROM ACTORS WHERE name LIKE ? ORDER BY name";
      $this->page->actors = $this->db->query($query, array($q));
    }

  }
?>
