<?php

	class Page {

		protected $db;
		protected $page;
		protected $t_loaded;
		function __construct() {

			$this->db_connect();

			if($this->db->not_working) {
				echo "Oops!<br>Error with connection to db<br>We will repair it soon";
				exit;
			}
			
			$this->page = new stdClass;
			$this->t_loaded = false;
		}

		function __destruct() {
			$this->load();
		}

		private function db_connect() {
			global $C;

			$this->db = new DB($C->DB_HOST, $C->DB_USER, $C->DB_PASS, $C->DB_NAME);
		}

		protected function load_template($template = NULL) {
			global $C;
			if($this->t_loaded) return;
			
			if($template) require_once($C->TEMPLATES.$template.".php");
			else require_once($C->TEMPLATES.strtolower(get_class($this)).".php");
		}

		protected function load() {
			$this->form_header();
			$this->load_template();
		}

		protected function form_header() {
			header('Content-Type: text/html; charset=utf-8');
		}

	}

?>
