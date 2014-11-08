<?php

  class DB {

    private $conn;
    public $not_working;
    private $log;

    function __construct($host, $user, $pass, $dbname) {
      global $C;

      try {
        $this->conn = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
          $this->not_working = true;
          file_put_contents($C->DB_LOG, $e->getMessage(), FILE_APPEND);
      }

    }

    public function query($query, $values) {
      try {
        $sth = $this->conn->prepare($query);
        $sth->execute($values);
        return $sth->fetchAll();
      } catch(PDOException $e) {
          file_put_contents($C->DB_LOG, $e->getMessage(), FILE_APPEND);
          return false;
      }
    }
  }
?>
