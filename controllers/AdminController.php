<?php

class AdminController extends AbstractController {
  private $db;
  public function __construct() {
    $this->db = MysqlDbProvider::getConnection('localhost', 'feedback', 'root', '');
  }
  public function login($args) {
    if($data = $this->getPostData()) {
      User::setDb($this->db);
      if($this->passVerify($data['pass'], User::find('login', $data['login'])->getPass())) {
        $_SESSION['login'] = $data['login'];
        header('location: /index.php');
      }
      else {
        echo 'Неправильный логин или пароль';
      }
    }
    $this->renderTemplate('views/admin/Login.php');
  }
  public function register($args) {
    if($data = $this->getPostData()) {
      User::setDb($this->db);
      if(!User::find('login', $data['login'])->getId()) {
        $user = new User($this->db, $data['login'], $this->passHash($data['pass']));
        $user->save();
      }
    }
    $this->renderTemplate('views/admin/Register.php');
  }
  public function logout($args) {
    session_destroy();
    header('location: /index.php');
  }
  protected function passHash($pass) {
    return password_hash($pass, PASSWORD_DEFAULT);
  }
  protected function passVerify($pass1, $pass2) {
    return password_verify($pass1, $pass2);
  }
}

 ?>
