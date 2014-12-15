<?php

  $id = $actor['actor_id'];
  $name = $actor['name'];
  $pic = $actor['picture_url'];
  $movies = $actor['movies'];
  $confirm_msg = 'Are you sure you want to remove this actor?';

?>
<div class='actor_container'>
  <h2><?= $name; ?></h2>
  <?php if($this->u->is_admin) { ?>
  <div class="btn-group" role="group">
    <a href='/actors/<?= $id; ?>/edit' class='btn btn-sm btn-warning'>Edit</a>
    <a href='/actors/<?= $id; ?>/remove' class='btn btn-sm btn-danger' onclick='return confirm("<?= $confirm_msg; ?>");'>Remove</a>
  </div>
  <div style='height: 10px'></div>
  <?php } ?>
  <img src="<?= $pic; ?>" alt="<?= $name; ?>">
  <div class="about">
    <h3>Played in movies:</h3>
    <ul>
      <?php foreach ($movies as $movie) { ?>
      <li><a href='/movies/<?= $movie['movie_id']; ?>'><?= $movie['title']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>
