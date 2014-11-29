<?php $this->load_template("sections/header"); ?>

<div class='container'>

  <a href='/movies'><h3>Go to all movies</h3></a>

  <?php if(count($this->page->movie) == 0) { ?>
  <div style='color: #c00;'>Movie not found</div>
  <?php
    } else {
      foreach($this->page->movie as $movie) {
        require("full.php");
      }
    }
  ?>

</div>

<?php $this->load_template("sections/footer"); ?>
