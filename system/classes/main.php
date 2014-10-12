<?php

	class Main {

		function __construct() {
			global $C;
			
			$pages = $this->_parse_input();
			$load = $this->_load_page($pages);
			if($load) {
				$this->_load_page_class($load);
				$load = ucfirst($load);
				new $load($pages);
			} else {
				echo "Error in loading page";
				exit;
			}

		}
		
		private function _parse_input() {
			$request = $_SERVER['REQUEST_URI'];
			list($request) = explode('?', $request);
			// User array_filter to remove empty elements from array		
			$request = array_filter(explode('/', $request));

			return array_values($request);
		}
		
		/**
		 * Determine which page to load
		 */
		private function _load_page($pages) {
			global $C;
			
			if(is_null($pages)) return false;

			if(count($pages) == 0) return "index";
			
			if(is_array($pages)) $page = strtolower($pages[0]);
			else $page = strtolower($pages);

			if($this->_file_exists($page)) return $page;
			else return "index";
		}
		
		/**
		 * Check if file exists
		 */
		private function _file_exists($class_name) {
			global $C;
			return file_exists($C->PAGE_CLASS."class_".$class_name.".php");
		}
			
		/**
		 * Load page class file
		 */
		private function _load_page_class($class_name) {
			global $C;
			if($this->_file_exists($class_name)) require_once($C->PAGE_CLASS.$class_name.".php");
			else {
				// Handle: No file found
			}
		}

	}
	
?>
