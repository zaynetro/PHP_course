<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $this->get_title() ?></title>
  </head>
  <body>
    <header>
      <a href='/'>Home</a>
      <?php if($this->u->logged) { ?>
      <a href='/logout'>Log out</a>
      <?php } else { ?>
      <a href='/login'>Log in</a>
      <a href='/signup'>Sign up</a>
      <?php } ?>
    </header>
