<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';


define('CARPETA_IMAGENES', __DIR__ . "/../public/imagenes/");

ActiveRecord::setDB($db);