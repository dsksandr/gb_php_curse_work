<?php

use app\core\App;

require_once realpath('../vendor/autoload.php');

App::call()->run(include realpath("../config/config.php"));

