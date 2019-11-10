<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__DIR__));
define('CORE_DIR', dirname(__DIR__) . DS . 'core' . DS);
define('TPL_DIR', dirname(__DIR__) . DS . 'templates' . DS);

define('CTRL_NAMESPACE', 'app\\controllers\\');

require_once realpath('../vendor/autoload.php');
require_once realpath(CORE_DIR . 'Autoload.php');
