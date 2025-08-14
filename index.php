<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once './Config/config.php';
require_once './Core/connection.php';
require_once './Helpers/jwt_helper.php';
require_once './Helpers/helper.php';
require_once './Core/router.php';

router($connection);
