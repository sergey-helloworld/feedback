<?php

class Validator {
  static public function isValid($input, $rule) {
    return $rule($input);
  }

  static public function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  static public function cleanArray($data) {
    $result = array();
    foreach ($data as $key => $value) {
      $value = trim($value);
      $value = stripslashes($value);
      $value = htmlspecialchars($value);
      $result [$key] = $value;
    }
    return $result;
  }
}

 ?>
