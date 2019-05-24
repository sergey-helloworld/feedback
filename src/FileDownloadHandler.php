<?php

class FileDownloadHandler {
  private $name;
  private $type;
  private $size;
  private $fileName;

  public function __construct($name) {
    if($error = $_FILES[$name]['error']) {
      throw new Exception('Ошибка загрузки файла: '.$error);
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $this->name = $_FILES[$name]['name'];
    $this->type = $finfo->file($_FILES[$name]['tmp_name']);
    $this->size = $_FILES[$name]['size'];
    $this->fileName = $_FILES[$name]['tmp_name'];
  }
  public function isValidFileType($types) {
    foreach ($types as $key => $value) {
      if($this->type === $value) {
        return true;
      }
    }
  }
  public function isValidFileSize($maxSize, $minSize = 0) {
    if($this->size >= $minSize && $this->size <= $maxSize) {
      return true;
    }
  }
  public function move($path, $fileName = "") {
    if(!$fileName) {
      $path = $path.'/'.$this->fileName;
    }
    else {
      $tmp = explode('.', $this->name);
      $path = $path.'/'.$fileName.'.'.end($tmp);
    }
    move_uploaded_file($this->fileName, $path);
    $this->fileName = $path;
  }
  public function getFileName() {
    return $this->fileName;
  }
}

 ?>
