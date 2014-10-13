<?php

  class Main {

    function __construct() {
      global $C;

      $pages = $this->_parse_input();
      $load = $this->_load_page($pages);

      $class_name = $this->_load_page_class($load);
      new $class_name($pages);
    }

    private function _parse_input() {
      $request = $_SERVER['REQUEST_URI'];
      // Remove query string
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

      if(page_class_exists($page)) return $page;
      else return "index";
    }

    /**
     * Load page class file
     */
    private function _load_page_class($class_name) {
      global $C;
      if(!page_class_exists($class_name)) $class_name = "unknown";

      $this->load_file_once($C->PAGE_CLASS, $class_name);
      return ucfirst($class_name);
    }

    protected function load_file_once($path, $file) {
      if(php_file_exists($path, $file)) {
        require_once($path.strtolower($file).'.php');
      }
    }

  }

?>
