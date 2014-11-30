<?php

  $id = $movie['movie_id'];
  $title = $movie['title'];
  $pic = $movie['poster_url'];
  $description = $movie['description'];
  $rating = $movie['rating'];
  $actors = $movie['actors'];
  $confirm_msg = 'Are you sure you want to remove this movie?';

?>
<div class='movie_container'>
  <h2><?= $title; ?></h2>
  <?php if($this->u->is_admin) { ?>
  <div>
    <ul>
      <li><a href='/movies/<?= $id; ?>/edit'>Edit</a></li>
      <li><a href='/movies/<?= $id; ?>/remove' onclick='return confirm("<?= $confirm_msg; ?>");'>Remove</a></li>
    </ul>
  </div>
  <?php } ?>
  <img src="<?= $pic; ?>" alt="<?= $title; ?>" />
  <div>
    <h3>Description:</h3>
    <div><?= $description; ?></div>

    <h3>Rating</h3>
    <div>
      <?php if($this->u->logged) { ?>
      <a href='/movies/<?= $id; ?>/dislike'>-</a>
      <?php } ?>
      <span><?= $rating; ?></span>
      <?php if($this->u->logged) { ?>
      <a href='/movies/<?= $id; ?>/like'>+</a>
      <?php } ?>
    </div>


    <h3>Actors in the movie:</h3>
    <ul>
      <?php foreach ($actors as $actor) { ?>
      <li><a href='/actors/<?= $actor['actor_id']; ?>'><?= $actor['name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
