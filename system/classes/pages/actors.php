<?php

  class Actors extends Page {
  
	public $actors;
	
    function __construct($pages = NULL) {
      parent::__construct($pages);
		$this->page->title = "Actor ";
		
		if(count($pages) != 2 ){
			$this->getActors();
		}else{
			$this->getActor((int) $pages[1]);
		}		
    }
	
	private function getActor($actor_id){
		$this->actors = $this->db->query("SELECT * FROM ACTORS WHERE (actor_id = ?) LIMIT 1", array($actor_id));
	}
	
	private function getActors(){
		$this->actors = $this->db->query("SELECT * FROM ACTORS", array());
	}
  }
?>