<?php
require_once("../vendor/autoload.php");
// use ModernPHPException\ModernPHPException;
define("ROOT",dirname(__DIR__).DIRECTORY_SEPARATOR);
define("APP",ROOT.'app'.DIRECTORY_SEPARATOR);
define("MODEL",ROOT.'app'.DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define("DATABASE",ROOT.'app'.DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR);
define("CORE",ROOT.'app'.DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define("VIEWS", ROOT.'app'.DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define("CONTROLLER",ROOT.'app'.DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
define("UTILS",ROOT.'app'.DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR);
define('BASE_URL','/admin/app/'); 
$modules = [ROOT,APP,VIEWS,MODEL,DATABASE,CORE,CONTROLLER,BASE_URL];
set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR,$modules));
spl_autoload_register('spl_autoload');
// (new ModernPHPException())->start();
new App;
