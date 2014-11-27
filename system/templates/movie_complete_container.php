<?php
	// $actors = $this->getLinkedActors();
?>

<div class='movie_container'>
	<h2><?= $movie["title"] ?></h2>
	<img src="<?= $movie["poster_url"] ?>" alt="<?= $movie["title"] ?>" />
	<div><?= $movie["description"] ?></div>
	<?php
		// foreach($actors as $actor){
			// require("actor_container.php");
		// }
	?>
</div>