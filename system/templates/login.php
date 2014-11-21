<?php $this->load_template("header"); ?>
Log In!

<div class='container'>

  <h2>Log In</h2>
  <form method='POST' action=''>
    <div class='row'>
      <label>Username: </label>
      <input type='text' name='username' />
    </div>
    <div class='row'>
      <label>Password: </label>
      <input type='password' name='password' />
    </div>
    <div class='row'>
      <input type='submit' value='Log In' />
    </div>
  </form>
</div>

<?php $this->load_template("footer"); ?>
