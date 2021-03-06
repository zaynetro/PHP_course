<?php

  class Page {

    protected $u;
    protected $db;
    protected $page;
    protected $template;

    function __construct() {

      $this->_db_connect();
      $this->u = new U($this->db);

      if($this->db->not_working) {
        echo "Oops!<br>Error with connection to db<br>We will repair it soon";
        exit;
      }

      $this->page = new stdClass;
      $this->page->title = "Page title";
      $this->page->error = null;

      $this->template = get_class($this);
    }

    function __destruct() {
      $this->load();
    }

    private function _db_connect() {
      global $C;
      $this->db = new DB($C->DB_HOST, $C->DB_USER, $C->DB_PASS, $C->DB_NAME);
    }

    protected function load_template($template = NULL) {
      global $C;
      if(!$template) $template = $this->template;
      $this->load_file_once($C->TEMPLATES, $template);
    }

    protected function load_file_once($path, $file) {
      if(php_file_exists($path, $file)) {
        require_once($path.strtolower($file).'.php');
      }
    }

    protected function load() {
      $this->form_header();
      $this->load_template();
    }

    protected function form_header() {
      header('Content-Type: text/html; charset=utf-8');
    }

    protected function get_title() {
      global $C;
      return $this->page->title.' &mdash; '.$C->SITENAME;
    }

  }

?>
