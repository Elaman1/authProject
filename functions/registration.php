<?php

require_once "basicFunctions.php";
require_once "../classes/auth_class.php";

$email = $_POST['Email'];
$password = md5($_POST['Password']);

function CheckEmailAndAdd($email, $password) {
    $res = false;
    $registr = new Auth();
    if (!$registr->issetEmail($email)) {
        $registr->addNewUsers($email, $password);
        $res = true;
    }
    return $res;
}

if (CheckEmailAndAdd($email, $password)) {
    redirectTo('page_login');
} else {
    redirectTo('page_register');
}