<?php

  class DB {

    private $conn;
    public $not_working;
    private $log;

    function __construct($host, $user, $pass, $dbname) {
      global $C;

      if(!file_exists($C->DB_LOG)) {
        file_put_contents($C->DB_LOG, "Init log file: ".date("F j, Y, g:i a")."\n");
      }

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
      }

      return null;
    }

    public function insert($table, $data) {
      $cols = array_keys($data);
      $vals = [];
      foreach ($cols as $item) {
        $vals[] = ':'.$item;
      }
      $cols = implode(", ", $cols);
      $vals = implode(", ", $vals);
      try {
        $sth = $this->conn->prepare("INSERT INTO {$table} ({$cols}) VALUES ($vals)");
        $sth->execute($data);
        return $sth->lastInsertId();
      } catch(PDOException $e) {
        file_put_contents($C->DB_LOG, $e->getMessage(), FILE_APPEND);
      }

      return null;
    }
  }
?>
