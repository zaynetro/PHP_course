<?php

  $id = $movie['movie_id'];
  $title = $movie['title'];
  $pic = $movie['poster_url'];
  $description = $movie['description'];
  $rating = $movie['rating'];
  $actors = $movie['actors'];
  $confirm_msg = 'Are you sure you want to remove this movie?';

  $review_val = '';
  if(isset($_POST['review'])) $review_val = $_POST['review'];

  $reviews = $movie['reviews'];

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
  <div class="about">
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

  <div>
    <h3>Reviews</h3>

    <?php if(isset($this->page->review_error)) { ?>
    <div style="color: #c00"><?= $this->page->review_error; ?></div>
    <?php } ?>

    <?php if($this->u->logged) { ?>
    <div>
      <form method='POST' action=''>
      <input type='hidden' name='type' value='review' />
        <div>
          <input type='text' name='review' value='<?= $review_val; ?>' />
        </div>
        <div>
          <input type='submit' value='Add' />
        </div>
      </form>
    </div>
    <?php } ?>

    <?php foreach($reviews as $review) { ?>
    <hr />
    <div>
      <div><?= $review['review']; ?></div>
      <div>Created at <?= $review['created_at']; ?></div>
    </div>
    <?php } ?>
  </div>
</div>
