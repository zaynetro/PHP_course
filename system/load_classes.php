<?php
	
	/**
	 * Automatically load all system classes
	 */
	function __autoload($class_name) {
		global $C;
		require_once($C->SYSTEM_CLASS.strtolower($class_name).'.php');
	}

?>
