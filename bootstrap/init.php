<?php

session_start();

include "config.php";
include "C:/laragon/www/Map/bootstrap/constants.php";
include  BASE_PATH . "/vendor/autoload.php";

try {

    $pdo=new PDO("mysql:dbname={$database_config->dbname};host={$database_config->host}",$database_config->user,$database_config->pass);
    
} catch (PDOException $e ) {
    
    echo "connection failed". $e->getMessage();
}





include  BASE_PATH."/bootstrap/helper.php";
include  BASE_PATH."/libs/lib-location.php";
include  BASE_PATH."/libs/lib-user.php";
