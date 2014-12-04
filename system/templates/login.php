<?php $this->load_template("sections/header"); ?>

<div class='container'>

  <?php if($this->page->error) { ?>
  <div style='color: #c00'><?= $this->page->error; ?></div>
  <?php } ?>

  <form class='form-signin' role="form" method='POST' action=''>
  <h2 class='form-signin-heading'>Please Sign In</h2>
      <label>Username:</label>
      <input type='text' name='username' class="form-control" />
      <label>Password:</label>
      <input type='password' name='password' class="form-control"  />
      <button style="margin-top: 20px;" class='btn btn-lg btn-primary btn-block' type='submit'>Log In</button>
  </form>
</div>

<?php $this->load_template("sections/footer"); ?>
