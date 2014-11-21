<?php $this->load_template("header"); ?>

<div class='container'>

  <h2>Sign up</h2>

  <?php if($this->page->error) { ?>
  <div style='color: #c00'><?= $this->page->error; ?></div>
  <?php } ?>
  <form method='POST' action=''>
    <div class='row'>
      <label>Username: </label>
      <input type='text' name='username' value='<?= $_POST["username"]; ?>' />
    </div>
    <div class='row'>
      <label>Password: </label>
      <input type='password' name='password' />
    </div>
    <div class='row'>
      <label>Repeat password: </label>
      <input type='password' name='repeatpassword' />
    </div>
    <div class='row'>
      <input type='submit' value='Sign up' />
    </div>
  </form>
</div>

<?php $this->load_template("footer"); ?>