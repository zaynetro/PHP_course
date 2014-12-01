<?php $this->load_template("sections/header"); ?>

<?php
  $movies = $this->page->movies;
  $actors = $this->page->actors;
  $reviews = $this->page->reviews;
?>

<div class='container'>

  <h1>Welcome to our movie database!</h1>

  <h2>Last added movies</h2>
  <ul>
    <?php foreach ($movies as $movie) { ?>
    <li><a href='/movies/<?= $movie['movie_id']; ?>'><?= $movie['title']; ?></a></li>
    <?php } ?>
  </ul>

  <h2>Last added actors</h2>
  <ul>
    <?php foreach ($actors as $actor) { ?>
    <li><a href='/actors/<?= $actor['actor_id']; ?>'><?= $actor['name']; ?></a></li>
    <?php } ?>
  </ul>

  <h2>Last reviews</h2>
  <ul>
    <?php foreach($reviews as $review) { ?>
    <li><?= $this->short_review_with_link($review['review'], $review['movie_id']); ?></li>
    <?php } ?>
  </ul>

</div>

<?php $this->load_template("sections/footer"); ?>
