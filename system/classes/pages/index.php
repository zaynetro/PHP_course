<?php

  class Index extends Page {

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Home";

      $this->_index();
    }

    private function _index() {
      $this->page->movies = $this->db->query("SELECT movie_id, title FROM MOVIES ORDER BY created_at DESC LIMIT 5");
      $this->page->actors = $this->db->query("SELECT actor_id, name FROM ACTORS ORDER BY created_at DESC LIMIT 5");
      $this->page->reviews = $this->db->query("SELECT movie_id, review FROM REVIEWS ORDER BY created_at DESC LIMIT 5");
    }

    public function short_review_with_link($text, $movie_id) {
      if(strlen($text) > 100) {
        $text = substr($text, 0, 100);
        $text .= '...';
      }
      $text .= " <a href='/movies/{$movie_id}'>read full</a>";
      return $text;
    }

  }
?>
