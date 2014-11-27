<?php

  class Movies extends Page {
  
	public $movies;
	
    function __construct($pages = NULL) {
      parent::__construct($pages);
		$this->page->title = "Movies";
		
		if(count($pages) != 2 ){
			$this->getMovies();
		}else{
			$this->getMovie((int) $pages[1]);
		}		
    }
	
	private function getMovie($movie_id){
		$this->movies = $this->db->query("SELECT * FROM MOVIES WHERE (movie_id = ?) LIMIT 1", array($movie_id));
	}
	
	private function getMovies(){
		$this->movies = $this->db->query("SELECT * FROM MOVIES", array());
	}
	
	public function getLinkedActors(){
		//TODO: query for linked actors.
	}
  }
?>