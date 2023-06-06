<?php

include "bootstrap/init.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

   if(!login($_POST['username'],$_POST['password'])){

    echo "نام کاربری یا رمز عبور اشتباه است";

   }
   
}

if(isset($_GET['logout']) and $_GET['logout']==1 ){

    logOut();
}


if(isLoggedIn()){

    $params=$_GET ?? [];
    $locations=getLocations($params);

    include "tpl/tpl-adm.php";

}else{

    include "tpl/tpl-adm-auth.php";
}