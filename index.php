<?php

include 'src/Router.php';
include 'src/AbstractController.php';
include 'src/MysqlDbProvider.php';
include 'controllers/FeedController.php';
include 'src/Validator.php';
include 'models/Message.php';
include 'models/User.php';
include 'controllers/AdminController.php';
include 'src/FileDownloadHandler.php';
include 'src/RandomGenerator.php';

session_start();

$r = new Router();
$r->addRoute(new FeedController());
$r->addRoute(new AdminController());

if(isset($_SERVER['PATH_INFO'])) {
	$r->redirect($_SERVER['PATH_INFO']);
}
else {
	$r->redirect('/feed/all');
}

 ?>
