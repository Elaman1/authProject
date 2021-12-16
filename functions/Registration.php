<?php

require_once dirname(__FILE__) . "/BasicFunctions.php";
require_once dirname(__FILE__) . "/../classes/Auth/Register_class.php";
require_once dirname(__FILE__) . "/../classes/Auth/Login_class.php";

$email = $_POST['Email'];
$password = md5($_POST['Password']);

function registration($email, $password) {
    $registerClass = new Register();
    $loginClass = new Login();

    // Если проходит регистрацию сразу залогинимся
    if ($registerClass->regIn($email, $password)) {
        $loginClass->logIn($email, $password);
        return true;
    }

    return false;
}

if (registration($email, $password)) {
    redirectTo('page_login');
} else {
    redirectTo('page_register');
}