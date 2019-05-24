<?php

/**
 *
 */
abstract class AbstractController
{
  private $postData;
  private $getData;

  public function handleRoute($args)
  {
    //$this->handleRequest($args);
    $this->handleAction($args);
  }
  protected function handleAction($args)
  {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->postData = Validator::cleanArray($_POST);
    }
    elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
      $this->getData = Validator::cleanArray($_GET);
    }
    $action = $args[0];
    array_splice($args, 0, 1);
    $this->{$action}($args);
  }
  protected function renderTemplate($template, $args = null)
  {
    include($template);
  }
  protected function getPostData()
  {
    return $this->postData;
  }
  protected function getGetData()
  {
    return $this->getData;
  }
}


 ?>
