<?php $this->load_template("sections/header"); ?>

<div class='container'>

  <h1>Admin stats</h1>

  <ul>
    <li>
      <b>Server time: </b>
      <span><?= $this->page->server_time; ?></span>
    </li>
  </ul>

  <h1>Add forms</h1>

  <ul>
    <li><a href='/movies/add'>Add movie</a></li>
    <li><a href='/actors/add'>Add actor</a></li>
  </ul>
</div>

<?php $this->load_template("sections/footer"); ?>
