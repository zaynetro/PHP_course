<?php

  /**
   * Automatically load all system classes
   */
  function __autoload($class_name) {
    global $C;
    if(system_class_exists($class_name)) {
      require_once($C->SYSTEM_CLASS.strtolower($class_name).'.php');
    }
  }

  /**
   * Check if file exists
   */
  function php_file_exists($path, $file) {
    return file_exists($path.strtolower($file).".php");
  }

  /**
   * Check if system class file exists
   */
  function system_class_exists($class_name) {
    global $C;
    return php_file_exists($C->SYSTEM_CLASS, $class_name);
  }

  /**
   * Check if page class file exists
   */
  function page_class_exists($class_name) {
    global $C;
    return php_file_exists($C->PAGE_CLASS, $class_name);
  }

  /**
   * Check if template file exists
   */
  function template_exists($template_name) {
    global $C;
    return php_file_exists($C->TEMPLATES, $class_name);
  }

?>
