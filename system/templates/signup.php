<?php $this->load_template("sections/header"); ?>

<div class='container'>

  <?php if($this->page->error) { ?>
  <div class="alert alert-danger" role="alert">
    <?= $this->page->error; ?>
  </div>
  <?php } ?>
  <form class='form-signin' role='form' method='POST' action=''>
  <h2 class='form-signin-heading'>Sign Up</h2>
      <label>Username: </label>
      <input type='text' class="form-control" name='username' value='<?php if(isset($_POST["username"])) echo $_POST["username"]; ?>' />
      <label>Password: </label>
      <input type='password' class="form-control" name='password' />
      <label>Repeat password: </label>
      <input type='password' class="form-control"  name='repeatpassword' />
      <button style="margin-top: 20px;" class='btn btn-lg btn-primary btn-block' type='submit'>Sign Up</button>
  </form>
</div>

<?php $this->load_template("sections/footer"); ?>
