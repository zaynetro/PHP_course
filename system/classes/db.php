<?php

  class DB {

    private $conn;
    public $not_working;
    private $log;

    function __construct($host, $user, $pass, $dbname) {
      global $C;

      $this->log = $C->DB_LOG;

      if(!file_exists($this->log)) {
        $this->_log("Init log file");
      }

      try {
        $this->conn = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        $this->not_working = true;
        $this->_log($e->getMessage());
      }

    }

    public function query($query, $values) {
      try {
        $sth = $this->conn->prepare($query);
        $sth->execute($values);
        return $sth->fetchAll();
      } catch(PDOException $e) {
        $this->_log($e->getMessage());
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
        if($sth->rowCount() > 0) return $this->conn->lastInsertId();
      } catch(PDOException $e) {
        $this->_log($e->getMessage());
      }

      return null;
    }

    private function _log($msg) {
      $msg = date("F j, Y, g:i a").": ".$msg."\n";
      file_put_contents($this->log, $msg, FILE_APPEND);
    }
  }
?>
