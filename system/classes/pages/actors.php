<?php

  class Actors extends Page {

    public $actors;

    function __construct($pages = NULL) {
      parent::__construct($pages);

      $this->page->title = "Actor";

      // Handle POST request
      if(count($_POST) > 0) {
        if($_POST['type'] == 'edit') return $this->_update((int) $pages[1]);
        return $this->_create();
      }

      // Show all actors
      if(count($pages) == 1) {
        return $this->_index();
      }

      // Show add form
      if($pages[1] == 'add') {
        if(!$this->u->is_admin) {
          header("Location: /actors");
          exit;
        }

        return $this->_new();
      }

      if(count($pages) > 2) {
        // Only admin has access
        if(!$this->u->is_admin) {
          header("Location: /actors");
          exit;
        }

        // Show edit form
        if($pages[2] == 'edit') return $this->_new((int) $pages[1]);
        // Remove actor
        if($pages[2] == 'remove') return $this->_remove((int) $pages[1]);
      }

      $this->_show((int) $pages[1]);
    }

    private function _show($actor_id) {
      $this->page->actor = $this->db->query("SELECT * FROM ACTORS WHERE (actor_id = ?) LIMIT 1", array($actor_id));
      if(count($this->page->actor) > 0) {
        // Select movies in which actor is performing
        $query = "SELECT M.movie_id, M.title
                  FROM MOVIES M
                  INNER JOIN MOVIE_ACTOR_LINKS L
                  ON M.movie_id = L.movie_id
                  WHERE L.actor_id = ?";
        $this->page->actor[0]['movies'] = $this->db->query($query, array($actor_id));
      }
      $this->template = 'actors/show';
    }

    private function _index() {
      $this->page->actors = $this->db->query("SELECT actor_id, name, picture_url FROM ACTORS ORDER BY name");
      $this->template = 'actors/index';
    }

    private function _new($actor_id = null) {
      $this->template = 'actors/new';

      if($actor_id) {
        // Fetch actor to update
        $this->page->actor = $this->db->query("SELECT * FROM ACTORS WHERE (actor_id = ?) LIMIT 1", array($actor_id));
        if(count($this->page->actor) == 0) {
          header("Location: /actors/".$actor_id);
          exit;
        }
        $this->page->actor = $this->page->actor[0];
      }

      $this->page->movies = $this->db->query("SELECT movie_id, title from MOVIES ORDER BY title");
    }

    private function _check_fields($name, $picture_url) {
      if(strlen($name) < 4) {
        return "Name is too short";
      }

      if(strlen($picture_url) < 10) {
        return "Picture url is too short";
      }

      return "";
    }

    private function _create() {
      $this->template = 'actors/new';

      $name = htmlspecialchars($_POST['name']);
      $picture_url = $_POST['picture_url'];

      $err = $this->_check_fields($name, $picture_url);

      if(strlen($err) > 0) {
        $this->page->error = $err;
        return;
      }

      $this->db->insert("ACTORS", array("name" => $name, "picture_url" => $picture_url));

      header("Location: /actors");
      exit;
    }

    private function _update($actor_id) {
      $this->template = 'actors/new';

      $name = htmlspecialchars($_POST['name']);
      $picture_url = $_POST['picture_url'];
      $movies = $_POST['movies'];

      $err = $this->_check_fields($name, $picture_url);

      if(strlen($err) > 0) {
        $this->page->error = $err;
        $this->page->movies = $this->db->query("SELECT movie_id, title from MOVIES ORDER BY title");
        return;
      }

      $this->db->query("UPDATE ACTORS SET name = ?, picture_url = ? WHERE actor_id = ?", array($name, $picture_url, $actor_id));

      // Remove old entries (don't want to waste time on handling updates)
      $this->db->query("DELETE FROM MOVIE_ACTOR_LINKS WHERE actor_id = ?", array($actor_id));
      foreach ($movies as $movie_id) {
        // Insert new
        $this->db->insert("MOVIE_ACTOR_LINKS", array('movie_id' => $movie_id, 'actor_id' => $actor_id));
      }

      header("Location: /actors/".$actor_id);
      exit;
    }

    private function _remove($actor_id) {
      $this->db->query("DELETE FROM ACTORS WHERE actor_id = ?", array($actor_id));

      header("Location: /actors");
      exit;
    }
  }
?>
