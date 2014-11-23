<?php

  class Actor extends Page {
  
	public $actor;
	
    function __construct($pages = NULL) {
      parent::__construct($pages);
		$this->page->title = "Actor ";
		$actor_id;
		
		if(count($pages) != 2 || ){
			$actor_id = 1;
		}else{
			$actor_id = (int) $pages[1];
		}
		
		$this->getActor($actor_id);		
    }
	
	private function getActor($actor_id){
		$this->actor = $this->db->query("SELECT * FROM ACTORS WHERE (actor_id = ?) LIMIT 1", array($actor_id));
	}
  }
?>