<?php

  $C = new stdClass;
  $C->INCPATH = dirname(__FILE__).'/';

  $C->SYSTEM_CLASS = $C->INCPATH."classes/";
  $C->PAGE_CLASS = $C->INCPATH."classes/pages/";

  $C->DB_LOG = $C->INCPATH."logs/db.log";

  $C->TEMPLATES = $C->INCPATH."templates/";

  $C->SITEURL = 'imdb.localhost';
  $C->SITENAME = 'imdb remake';

?>
