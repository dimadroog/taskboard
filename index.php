<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once 'AppController.php';
$app = new AppController();
$app->dispatch();
?>