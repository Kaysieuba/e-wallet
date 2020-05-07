<?php
//functionto __autoload classes
function myautoload($classname){
  $classname = strtolower($classname);

  require_once APP_ROOT . 'core/class/' . $classname . '.class.php' ;

}
spl_autoload_register('myautoload');
