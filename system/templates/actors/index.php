<?php $this->load_template("header"); ?>

<div class='container'>

  <h1>Actors</h1>
  <?php
    foreach($this->page->actors as $actor) {
      require("short.php");
    }
  ?>
</div>

<?php $this->load_template("footer"); ?>
