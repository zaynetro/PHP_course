<?php $this->load_template("header"); ?>

<div class='container'>

  <a href='/actors'><h3>Go to all actors</h3></a>

  <?php if(count($this->page->actor) == 0) { ?>
  <div style='color: #c00;'>Actor not found</div>
  <?php
    } else {
      foreach($this->page->actor as $actor) {
        require("full.php");
      }
    }
  ?>
</div>

<?php $this->load_template("footer"); ?>
