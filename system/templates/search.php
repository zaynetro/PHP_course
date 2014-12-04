<?php $this->load_template("sections/header"); ?>

<?php
  $query = $this->page->query;
  $movies = $this->page->movies;
  $actors = $this->page->actors;
?>

<div class='container'>

  <h1>You searched for: '<?= $query; ?>'</h1>

  <h2>Found movies</h2>
  <ul>
    <?php foreach ($movies as $movie) { ?>
    <li><a href='/movies/<?= $movie['movie_id']; ?>'><?= $movie['title']; ?></a></li>
    <?php } ?>
  </ul>

  <h2>Found actors</h2>
  <ul>
    <?php foreach ($actors as $actor) { ?>
    <li><a href='/actors/<?= $actor['actor_id']; ?>'><?= $actor['name']; ?></a></li>
    <?php } ?>
  </ul>

</div>

<?php $this->load_template("sections/footer"); ?>
