<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $this->get_title() ?></title>
    <link rel="stylesheet" type="text/css" href="/i/styles/template.css" />
  </head>
  <body>
    <header>
      <a href='/'>Home</a>
      <a href='/movies'>Movies</a>
      <a href='/actors'>Actors</a>

      <?php if ($this->u->is_admin) { ?>
      <a href='/admin'>Admin</a>
      <?php } if($this->u->logged) { ?>
      <a href='/logout'>Log out</a>
      <?php } else { ?>
      <a href='/login'>Log in</a>
      <a href='/signup'>Sign up</a>
      <?php } ?>

      <form method='GET' action='/search'>
        <input type='text' name='q' placeholder='Search..' />
        <input type='submit' value='Search' />
      </form>
    </header>
