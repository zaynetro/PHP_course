<?php $this->load_template("header"); ?>

<div class='container'>

  <h1>Actors</h1>
  <?php
    foreach($this->actors as $actor) {
      require("actor_container.php");
    }
  ?>
</div>

<?php $this->load_template("footer"); ?>
