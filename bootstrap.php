<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use App\System\DatabaseConnector;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbConnection = new DatabaseConnector;
$dbConnection = $dbConnection->getConnection();
