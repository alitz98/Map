<?php


function isLoggedIn(){

    return isset($_SESSION['login']);
}


function login($user,$pass){

    global $admin;

    if(array_key_exists($user,$admin) and $admin[$user]==$pass){

        $_SESSION['login']=1;
        return true;

    }

    return false;
}

function logOut(){

    unset($_SESSION['login']);
}