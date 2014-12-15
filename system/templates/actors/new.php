<?php $this->load_template("sections/header"); ?>

<?php

  $fields = ['name', 'picture_url'];
  $vals = [];
  $type = 'add';

  if(isset($this->page->actor)) $type = 'edit';

  foreach ($fields as $field) {
    $vals[$field] = '';
    if(isset($_POST[$field])) $vals[$field] = $_POST[$field];
    else if(isset($this->page->actor)) $vals[$field] = $this->page->actor[$field];
  }

  $options = "";
  foreach ($this->page->movies as $movie) {
    $options .= "<option value=".$movie['movie_id'].">".$movie['title']."</option>";
  }
?>

<div class='container'>

  <h1><?php if($type == 'edit') { ?>Edit<?php } else { ?>Add <?php } ?> actor</h1>

  <?php if(isset($this->page->error)) { ?>
  <div class="alert alert-danger" role="alert">
    <?= $this->page->error; ?>
  </div>
  <?php } ?>

  <form method="POST" role="form" action="">
  <div class="form-group">
    <input type='hidden' class="form-control" name='type' value='<?= $type; ?>' />
    <div>
      <label>Name: </label>
      <input type='text' class="form-control" name='name' value='<?= $vals['name']; ?>' />
    </div>
    <div>
      <label>Picture url: </label>
      <input type="text" class="form-control" name="picture_url" value='<?= $vals['picture_url']; ?>' />
    </div>
    <div>
      <label>Played in: </label>
      <select name='movies[]' class="form-control" multiple="true" size="5"><?= $options; ?></select>
    </div>
    <div>
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
	</div>
  </form>

</div>

<?php $this->load_template("sections/footer"); ?>
