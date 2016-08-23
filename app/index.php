<?php
include_once("controllers/Controller.php");

$controller = new Controller();
$controller->invoke($_GET['method'], $_GET);
