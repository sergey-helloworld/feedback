<?php
/**
 *
 */
class FeedController extends AbstractController
{
  private $db;
  public function __construct()
  {
    $this->db = MysqlDbProvider::getConnection('localhost', 'feedback', 'root', '');
  }

  public function all($args)
  {
    Message::setDb($this->db);
    $this->renderTemplate('views/feed/List.php', Message::findAll());
  }

  public function view($args)
  {

  }

  public function add($args)
  {
    if($data = $this->getPostData()){
      try {
          $image = new FileDownloadHandler('image');
      }
      catch(Exception $e) {
        echo $e->getMessage();
      }
      if($image->isValidFileType(array('image/jpeg', 'image/png', 'image/gif')) && $image->isValidFileSize(10485760)) {
        $image->move('images', RandomGenerator::randomString(20));
        $message = new Message($this->db, $data['name'], $data['email'], $data['message'], $image->getFileName());
        $message->save();
        header('location: /index.php');
      }
      else {
        echo 'Тип файла не является jpeg, png или gif, или его размер превышает 10МБ';
      }
    }
    //$this->renderTemplate('views/feed/Add.php');
  }

  public function edit($args) {
    if($data = $this->getPostData()) {
      if($_SESSION['login']) {
        Message::setDb($this->db);
        $message = Message::find($data['id']);
        $message->setMessage($data['message']);
        $message->setIsEdit(true);
        $message->save();
      }
      else {
        echo 'У Вас нет прав на выполнение данной операции';
      }
    }
  }

  public function setstate($args)
  {
    if($data = $this->getPostData()) {
      if($_SESSION['login']) {
        Message::setDb($this->db);
        $message = Message::find($data['id']);
        $message->setIdState($data['id_state']);
        $message->save();
      }
      else {
        echo 'У Вас нет прав на выполнение данной операции';
      }
    }
  }
}


 ?>
