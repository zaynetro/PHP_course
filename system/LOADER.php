<?php

	session_start();

	chdir(dirname(__FILE__));

	require_once("./conf_system.php");
	require_once("./conf_db.php");
	require_once("./load_classes.php");

	new Main();
	
?>
