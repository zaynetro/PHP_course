<?php $this->load_template("header"); ?>
<?php
	if(count($this->movies) == 1){
		$movie = $this->movies[0];
		require("movie_complete_container.php");
	}else{	
		foreach($this->movies as $movie){
			require("movie_container.php");		
		}
	}
?>
<?php $this->load_template("footer"); ?>