<div class='movie_container'>
  <h2><?= $movie["title"] ?></h2>
  <img src="<?= $movie["poster_url"] ?>" alt="<?= $movie["title"] ?>" />
  <div>
    <h3>Description:</h3>
    <div><?= $movie["description"] ?></div>

    <h3>Rating:</h3>
    <h3>Actors in the movie:</h3>
  </div>
</div>
