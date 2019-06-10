<?php
session_start();

// вывод отладочной информация
error_reporting(-1);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
define('APPPATH', ROOT.'/app');
define('LIBPATH', ROOT.'/libs');
define('VIEWPATH', APPPATH.'/view');


// подключаем БД
include_once(APPPATH.'/config/config.php');
include_once(LIBPATH.'/mysql.php');
include_once(LIBPATH.'/app.php');

$app = new App;
