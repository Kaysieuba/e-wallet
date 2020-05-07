<?php
require_once 'core/init.php';

if ($user->logout()) {
  redirectTo('index.php');
}
redirectTo('index.php');
