<?php $this->load_template("header"); ?>

<div class='container'>

  <h2>Admin stats</h2>

  <ul>
    <li>
      <b>Server time: </b>
      <span><?= $this->page->server_time; ?></span>
    </li>
  </ul>
</div>

<?php $this->load_template("footer"); ?>
