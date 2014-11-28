<?php $this->load_template("header"); ?>

<div class='container'>

  <h1>Movies</h1>
  <?php
    foreach($this->page->movies as $movie) {
      require("short.php");
    }
  ?>
</div>

<?php $this->load_template("footer"); ?>
