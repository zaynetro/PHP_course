<?php $this->load_template("sections/header"); ?>

<?php

  $fields = ['title', 'description', 'poster_url', 'year'];
  $vals = [];
  $type = 'add';

  if(isset($this->page->movie)) $type = 'edit';

  foreach ($fields as $field) {
    $vals[$field] = '';
    if(isset($_POST[$field])) $vals[$field] = $_POST[$field];
    else if(isset($this->page->movie)) $vals[$field] = $this->page->movie[$field];
  }

?>

<div class='container'>

  <h1><?php if($type == 'edit') { ?>Edit<?php } else { ?>Add <?php } ?> movie</h1>

  <div class="alert alert-danger" role="alert">
    <?= $this->page->error; ?>
  </div>

  <form method="POST" role="form" action="">
  <div class="form-group">
    <input type='hidden' name='type' class="form-control" value='<?= $type; ?>' />
    <div>
      <label>Title: </label>
      <input type='text' name='title' class="form-control" value='<?= $vals['title']; ?>' />
    </div>
    <div>
      <label>Description: </label>
      <textarea name='description' class="form-control"><?= $vals['description']; ?></textarea>
    </div>
    <div>
      <label>Poster url: </label>
      <input type="text" name="poster_url" class="form-control" value='<?= $vals['poster_url']; ?>' />
    </div>
    <div>
      <label>Year: </label>
      <input type='text' name='year' class="form-control" value='<?= $vals['year']; ?>' />
    </div>
    <div>
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
	</div>
  </form>

</div>

<?php $this->load_template("sections/footer"); ?>
