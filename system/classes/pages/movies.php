<?php

  class Movies extends Page {

		public $movies;

    function __construct($pages = NULL) {
      parent::__construct($pages);

			$this->page->title = "Movies";

      // Handle POST request
      if(count($_POST) > 0) {
        if($_POST['type'] == 'edit') return $this->_update((int) $pages[1]);
        return $this->_create();
      }

      // Show all movies
      if(count($pages) == 1) {
        return $this->_index();
      }

      // Show add form
      if($pages[1] == 'add') {
        if(!$this->u->is_admin) {
          header("Location: /movies");
          exit;
        }

        return $this->_new();
      }

      if(count($pages) > 2) {
        // Only admin has access
        if(!$this->u->is_admin) {
          header("Location: /movies");
          exit;
        }

        // Show edit form
        if($pages[2] == 'edit') return $this->_new((int) $pages[1]);
        // Remove movie
        if($pages[2] == 'remove') return $this->_remove((int) $pages[1]);
      }

      $this->_show((int) $pages[1]);
    }

		private function _show($movie_id) {
			$this->page->movie = $this->db->query("SELECT * FROM MOVIES WHERE (movie_id = ?) LIMIT 1", array($movie_id));
      if(count($this->page->movie) > 0) {
        // Select movies in which actor is performing
        $query = "SELECT A.actor_id, A.name
                  FROM ACTORS A
                  INNER JOIN MOVIE_ACTOR_LINKS L
                  ON A.actor_id = L.actor_id
                  WHERE L.movie_id = ?";
        $this->page->movie[0]['actors'] = $this->db->query($query, array($movie_id));
      }
      $this->template = 'movies/show';
		}

		private function _index() {
			$this->page->movies = $this->db->query("SELECT * FROM MOVIES ORDER BY title", array());
      $this->template = 'movies/index';
		}

    private function _new($movie_id = null) {
      $this->template = 'movies/new';

      if($movie_id) {
        // Fetch movie to update
        $this->page->movie = $this->db->query("SELECT * FROM MOVIES WHERE (movie_id = ?) LIMIT 1", array($movie_id));
        if(count($this->page->movie) == 0) {
          header("Location: /movies/".$movie_id);
          exit;
        }
        $this->page->movie = $this->page->movie[0];
      }
    }

		public function getLinkedActors() {
			//TODO: query for linked actors.
		}

    private function _check_fields($title, $description, $poster_url, $year) {
      if(strlen($title) < 2) {
        return "Title is too short";
      }

      if(strlen($poster_url) < 10) {
        return "Poster url is too short";
      }

      if(strlen($description) < 4) {
        return "Description is too short";
      }

      if($year < 1800) {
        return "Year is not valid";
      }

      return "";
    }

    private function _create()  {
      $this->template = 'movies/new';

      $title = htmlspecialchars($_POST['title']);
      $description = htmlspecialchars($_POST['description']);
      $poster_url = $_POST['poster_url'];
      $year = (int) $_POST['year'];

      $err = $this->_check_fields($title, $description, $poster_url, $year);

      if(strlen($err) > 0) {
        $this->page->error = $err;
        return;
      }

      $this->db->insert("MOVIES", array("title" => $title,
                                        "poster_url" => $poster_url,
                                        "description" => $description,
                                        "year" => $year));

      header("Location: /movies");
      exit;
    }

    private function _update($movie_id) {
      $this->template = 'movies/new';

      $title = htmlspecialchars($_POST['title']);
      $description = htmlspecialchars($_POST['description']);
      $poster_url = $_POST['poster_url'];
      $year = (int) $_POST['year'];

      $err = $this->_check_fields($title, $description, $poster_url, $year);

      if(strlen($err) > 0) {
        $this->page->error = $err;
        return;
      }

      $q = "UPDATE MOVIES SET title = ?, poster_url = ?, description = ? WHERE movie_id = ?";
      $this->db->query($q, array($title, $poster_url, $description, $movie_id));

      header("Location: /movies/".$movie_id);
      exit;
    }

    private function _remove($movie_id) {
      $this->db->query("DELETE FROM MOVIES WHERE movie_id = ?", array($movie_id));

      header("Location: /movies");
      exit;
    }
  }
?>
