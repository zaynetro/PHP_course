<?php $this->load_template("header"); ?>

<div class='container'>

  <h1>Add movie</h1>

  <div style='color: #c00'>
    <?= $this->page->error; ?>
  </div>

  <form method="POST" action="">
    <div>
      <label>Title: </label>
      <input type='text' name='title' value='<?php if(isset($_POST["title"])) echo $_POST["title"]; ?>' />
    </div>
    <div>
      <label>Description: </label>
      <textarea name='description'><?php if(isset($_POST["description"])) echo $_POST["description"]; ?></textarea>
    </div>
    <div>
      <label>Poster url: </label>
      <input type="text" name="poster_url" value='<?php if(isset($_POST["poster_url"])) echo $_POST["poster_url"]; ?>' />
    </div>
    <div>
      <label>Year: </label>
      <input type='text' name='year' value='<?php if(isset($_POST["year"])) echo $_POST["year"]; ?>' />
    </div>
    <div>
      <input type="submit" value="Add" />
    </div>
  </form>

</div>

<?php $this->load_template("footer"); ?>
