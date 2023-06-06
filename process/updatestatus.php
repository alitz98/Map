<?php

include  "C:/laragon/www/Map/bootstrap/init.php";


if(is_null(($_POST['loc'])) or !is_numeric($_POST['loc'])){

    die( "invalid data");
}


$locationid=$_POST['loc'];

echo updatestatus($locationid);


