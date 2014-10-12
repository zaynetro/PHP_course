<?php

	class DB {

		private $conn;
		public $not_working;
		private $log;

		function __construct($host, $user, $pass, $dbname) {
			try {
				$this->conn = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
    			$this->not_working = true;
    			return false;
			}

		}
	}
?>
