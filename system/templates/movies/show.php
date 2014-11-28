<?php $this->load_template("header"); ?>

<div class='container'>

  <a href='/movies'><h3>Go to all movies</h3></a>

  <?php
    foreach($this->movies as $movie) {
      require("movie_container.php");
    }
  ?>

</div>

<?php $this->load_template("footer"); ?>
