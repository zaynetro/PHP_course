<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $this->get_title() ?></title>
    <link rel="stylesheet" type="text/css" href="/i/styles/template.css" />
	<link rel="stylesheet" type="text/css" href="/i/styles/bootstrap.min.css" />
  </head>
  <body>
    <header>
	<nav class="navbar navbar-default navbar-inverse" role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li><a href='/'>Home</a></li>
      <li><a href='/movies'>Movies</a></li>
      <li><a href='/actors'>Actors</a></li>

      <?php if ($this->u->is_admin) { ?>
      <li><a href='/admin'>Admin</a></li>
      <?php } if($this->u->logged) { ?>
      <li><a href='/logout'>Log out</a></li>
      <?php } else { ?>
      <li><a href='/login'>Log in</a></li>
      <li><a href='/signup'>Sign up</a></li>
      <?php } ?>
    </header>
	</li>
    </ul>
	</div>
	</nav>
