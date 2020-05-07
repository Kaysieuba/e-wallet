<?php
// Start SESSION
if (!isset($_SESSION)) {
  session_start();
}

// Define errors array
$errors = array();

// Set application root
define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', dirname(dirname(__FILE__)).DS);

// Link required files to project
require_once APP_ROOT . 'core/db/connect.php';
require_once APP_ROOT . 'core/functions.php';
require_once APP_ROOT . 'core/loadclasses.php';

// Create instance/object of classes
$user = new User();
$bank = new Bank();
$transaction = new Transaction();

// Set server messages
$session = new Session();
$message = $session->message();
