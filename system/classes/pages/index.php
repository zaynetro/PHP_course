<?php
	
	class Index extends Page {

		function __construct($pages = NULL) {
			parent::__construct($pages);
			
			$this->page->title = "Home";
		}

	}
?>
