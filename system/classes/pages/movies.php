<?php

  class Movies extends Page {

		public $movies;

    function __construct($pages = NULL) {
      parent::__construct($pages);

			$this->page->title = "Movies";

      if(count($_POST) > 0) {
        return $this->_create();
      }

      if(count($pages) != 2) {
        return $this->_index();
      }

      if($pages[1] == 'add') {
        if(!$this->u->is_admin) {
          header("Location: /movies");
          exit;
        }

        return $this->_new();
      }

      $this->_show((int) $pages[1]);
    }

		private function _show($movie_id) {
			$this->page->movie = $this->db->query("SELECT * FROM MOVIES WHERE (movie_id = ?) LIMIT 1", array($movie_id));
      $this->template = 'movies/show';
		}

		private function _index() {
			$this->page->movies = $this->db->query("SELECT * FROM MOVIES", array());
      $this->template = 'movies/index';
		}

		public function getLinkedActors() {
			//TODO: query for linked actors.
		}

    private function _create()  {
      $this->template = 'movies/new';
      $title = htmlspecialchars($_POST['title']);
      $description = htmlspecialchars($_POST['description']);
      $poster_url = $_POST['poster_url'];
      $year = (int) $_POST['year'];


      if(strlen($title) < 2) {
        $this->page->error = "Title is too short";
        return;
      }

      if(strlen($poster_url) < 10) {
        $this->page->error = "Poster url is too short";
        return;
      }

      if(strlen($description) < 4) {
        $this->page->error = "Description is too short";
        return;
      }

      if($year < 1800) {
        $this->page->error = "Year is not valid";
        return;
      }

      $this->db->insert("MOVIES", array("title" => $title,
                                        "poster_url" => $poster_url,
                                        "description" => $description,
                                        "year" => $year));

      header("Location: /movies");
      exit;
    }

    private function _new() {
      $this->template = 'movies/new';
    }
  }
?>
