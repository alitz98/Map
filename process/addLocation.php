<?php

include  "C:/laragon/www/Map/bootstrap/init.php";



if(addLocation($_POST)){

    echo " با موفقیت ثبت گردید";
}else{

    echo "مشکلی پیش امده است";
}