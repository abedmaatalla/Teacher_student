<?php
session_start();

require 'vendor/autoload.php';

require 'containers.php';

//$app = new Slim\App($container);

require 'Middlewares.php';

require 'routes.php';
