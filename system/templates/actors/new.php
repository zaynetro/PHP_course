<?php $this->load_template("header"); ?>

<?php

  $fields = ['name', 'picture_url'];
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

  <h1><?php if($type == 'edit') { ?>Edit<?php } else { ?>Add <?php } ?> actor</h1>

  <div style='color: #c00'>
    <?= $this->page->error; ?>
  </div>

  <form method="POST" action="">
    <input type='hidden' name='type' value='<?= $type; ?>' />
    <div>
      <label>Name: </label>
      <input type='text' name='name' value='<?= $vals['name']; ?>' />
    </div>
    <div>
      <label>Picture url: </label>
      <input type="text" name="picture_url" value='<?= $vals['picture_url']; ?>' />
    </div>
    <div>
      <input type="submit" value="Add" />
    </div>

  </form>

</div>

<?php $this->load_template("footer"); ?>
