<?php

class User {
  private static $db;
  private $id;
  private $login;
  private $pass;

  public function __construct($db, $login, $pass, $id = null) {
    User::$db = $db;
    $this->login = $login;
    $this->pass = $pass;
    $this->id = $id;
  }

  public static function setDb($db) {
    User::$db = $db;
  }

  public function getId() {
    return $this->id;
  }

  public function getLogin() {
    return $this->login;
  }

  public function getPass() {
    return $this->pass;
  }

  public function save() {
    if($this->id) {
      $stmt = User::$db->prepare('update users set login = ?, pass = ? where id = ?');
      $stmt->execute(array($this->login, $this->pass, $this->id));
    }
    else {
      $stmt = User::$db->prepare('insert into users values (default, ? , ? )');
      $stmt->execute(array($this->login, $this->pass));
    }
  }

  static public function find($field = 'id', $value) {
    $stmt = User::$db->prepare('select * from users where '.$field.'=?');
    $stmt->execute(array($value));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return new User(User::$db, $record['login'], $record['pass'], $record['id']);
  }

  static public function findAll() {
    $result = array();
    $records = array();
    $records =  User::$db->query('select * from users')->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $key => $value) {
      $result [] = new User(User::$db, $record['login'], $record['pass'], $record['id']);
    }
    return $result;
  }
}

 ?>
