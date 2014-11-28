<div class='movie_container'>
	<h2><?= $movie["title"] ?></h2>
	<a href="/movies/<?= $movie["movie_id"] ?>">
	<img src="<?= $movie["poster_url"] ?>" alt="<?= $movie["title"] ?>"/>
	</a>
</div>