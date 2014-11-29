<?php $this->load_template("header"); ?>

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

  <div style='color: #c00'>
    <?= $this->page->error; ?>
  </div>

  <form method="POST" action="">
    <input type='hidden' name='type' value='<?= $type; ?>' />
    <div>
      <label>Title: </label>
      <input type='text' name='title' value='<?= $vals['title']; ?>' />
    </div>
    <div>
      <label>Description: </label>
      <textarea name='description'><?= $vals['description']; ?></textarea>
    </div>
    <div>
      <label>Poster url: </label>
      <input type="text" name="poster_url" value='<?= $vals['poster_url']; ?>' />
    </div>
    <div>
      <label>Year: </label>
      <input type='text' name='year' value='<?= $vals['year']; ?>' />
    </div>
    <div>
      <input type="submit" value="Add" />
    </div>
  </form>

</div>

<?php $this->load_template("footer"); ?>
