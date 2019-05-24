<?php

class MysqlDbProvider
{
  static function getConnection($host, $dbName, $user, $pass)
  {
    return new PDO("mysql:dbname=$dbName;host=$host;charset=utf8", $user, $pass,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
  }
}

 ?>
