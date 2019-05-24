<?php

class Message {
  static private $db;
  private $id;
  private $name;
  private $email;
  private $message;
  private $isEdit;
  private $insDate;
  private $image;
  private $idState;

  public function __construct($db, $name, $email, $message, $image, $insDate = null,$isEdit = 0, $idState = 1, $id = null) {
    $this->id = $id;
    Message::$db = $db;
    $this->name = $name;
    $this->email = $email;
    $this->message = $message;
    $this->isEdit = $isEdit;
    $this->insDate = $insDate;
    $this->image = $image;
    $this->idState = $idState;
  }

  public static function setDb($db) {
    Message::$db = $db;
  }

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getMessage() {
    return $this->message;
  }

  public function getIsEdit() {
    return $this->isEdit;
  }

  public function setIsEdit($isEdit) {
    $this->isEdit = true;
  }

  public function setMessage($message) {
    $this->message = $message;
  }

  public function getInsDate() {
    return $this->insDate;
  }

  public function getImage() {
    return $this->image;
  }

  public function getIdState() {
    return $this->idState;
  }

  public function setIdState($idState) {
    $this->idState = $idState;
  }

  public function save() {
    if($this->id) {
      $stmt = Message::$db->prepare('update messages set name = ?, email = ?, message = ?, image = ?, is_edit= ?, id_state = ? where id = ?');
      $stmt->execute(array($this->name, $this->email, $this->message, $this->image, $this->isEdit, $this->idState, $this->id));
      return $this->id;
    }
    else {
      $stmt = Message::$db->prepare('insert into messages values (default, ? , ? ,? ,?, ?, ? ,now() )');
      $stmt->execute(array($this->name, $this->email, $this->message, $this->image, $this->isEdit, $this->idState ));
      return Message::$db->lastInsertId();
    }
  }

  static public function find($id) {
    $stmt = Message::$db->prepare('select * from messages where id=?');
    $stmt->execute(array($id));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    return new Message(Message::$db, $record['name'], $record['email'], $record['message'], $record['image'], $record['ins_date'], $record['is_edit'], $record['id_state'] ,$record['id']);
  }

  static public function findAll() {
    $result = array();
    $records = array();
    $records =  Message::$db->query('select * from messages')->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $key => $value) {
      $result [] = new Message(Message::$db, $value['name'], $value['email'], $value['message'], $value['image'], $value['ins_date'], $value['is_edit'], $value['id_state'], $value['id']);
    }
    return $result;
  }
}

 ?>
