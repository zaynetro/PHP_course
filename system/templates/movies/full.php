<?php

  $id = $movie['movie_id'];
  $title = $movie['title'];
  $pic = $movie['poster_url'];
  $description = $movie['description'];
  $confirm_msg = 'Are you sure you want to remove this movie?';

?>
<div class='movie_container'>
  <h2><?= $title; ?></h2>
  <div>
    <ul>
      <li><a href='/movies/<?= $id; ?>/edit'>Edit</a></li>
      <li><a href='/movies/<?= $id; ?>/remove' onclick='return confirm("<?= $confirm_msg; ?>");'>Remove</a></li>
    </ul>
  </div>
  <img src="<?= $pic; ?>" alt="<?= $title; ?>" />
  <div>
    <h3>Description:</h3>
    <div><?= $description; ?></div>

    <h3>Rating:</h3>
    <h3>Actors in the movie:</h3>
  </div>
</div>
