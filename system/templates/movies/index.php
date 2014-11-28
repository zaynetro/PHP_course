<?php $this->load_template("header"); ?>

<div class='container'>

  <h1>Movies</h1>
  <?php
    foreach($this->movies as $movie) {
      require("movie_container.php");
    }
  ?>
</div>

<?php $this->load_template("footer"); ?>
