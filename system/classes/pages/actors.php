<?php

  class Actors extends Page {

    public $actors;

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Actor";

      if(count($_POST) > 0) {
        return $this->_create();
      }

      if(count($pages) != 2) {
        return $this->_index();
      }

      if($pages[1] == 'add') {
        if(!$this->u->is_admin) {
          header("Location: /actors");
          exit;
        }

        return $this->_new();
      }

      $this->_show((int) $pages[1]);
    }

    private function _show($actor_id) {
      $this->page->actor = $this->db->query("SELECT * FROM ACTORS WHERE (actor_id = ?) LIMIT 1", array($actor_id));
      $this->template = 'actors/show';
    }

    private function _index() {
      $this->page->actors = $this->db->query("SELECT * FROM ACTORS", array());
      $this->template = 'actors/index';
    }

    private function _new() {
      $this->template = 'actors/new';
    }

    private function _create() {
      $this->template = 'actors/new';
      $name = htmlspecialchars($_POST['name']);
      $picture_url = $_POST['picture_url'];

      if(strlen($name) < 4) {
        $this->page->error = "Name is too short";
        return;
      }

      if(strlen($picture_url) < 10) {
        $this->page->error = "Picture url is too short";
        return;
      }

      $this->db->insert("ACTORS", array("name" => $name, "picture_url" => $picture_url));

      header("Location: /actors");
      exit;
    }
  }
?>
