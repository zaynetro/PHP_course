<?php $this->load_template("header"); ?>

<div class='container'>

  <h1>Add actor</h1>

  <div style='color: #c00'>
    <?= $this->page->error; ?>
  </div>

  <form method="POST" action="">
    <div>
      <label>Name: </label>
      <input type='text' name='name' value='<?php if(isset($_POST["name"])) echo $_POST["name"]; ?>' />
    </div>
    <div>
      <label>Picture url: </label>
      <input type="text" name="picture_url" value='<?php if(isset($_POST["picture_url"])) echo $_POST["picture_url"]; ?>' />
    </div>
    <div>
      <input type="submit" value="Add" />
    </div>
  </form>

</div>

<?php $this->load_template("footer"); ?>
