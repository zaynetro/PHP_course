<?php $this->load_template("sections/header"); ?>


<div class='container'>
<h1>Actors</h1>
	<div class='container_actors_movies'>
	  <?php
		foreach($this->page->actors as $actor) {
		  require("short.php");
		}
	  ?>
	</div>
</div>

<?php $this->load_template("sections/footer"); ?>
