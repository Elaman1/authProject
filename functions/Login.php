<?php

require_once dirname(__FILE__) . "/BasicFunctions.php";
require_once dirname(__FILE__) . "/../classes/Auth/Login_class.php";
session_start();

$email = $_POST['Email'] ?? null;
$password = isset($_POST['Password']) ? md5($_POST['Password']) : null;
$logginIn = $_SESSION['loggin_in'] ?? false;
$pageNames = $pageName ?? false;

// Если вводил email и пароль
if ($email !== null && $password !== null) {
    $loginClass = new Login();
    $result = $loginClass->logIn($email, $password);

    // Если ввел правильно
    if ($result != false) {
        $_SESSION['loggin_in'] = true;
        $_SESSION['user'] = $result; // UserArray

        if ($pageNames != "users") {
            redirectTo('users');
        }
    }
}

// Если не зашел
if ($logginIn == false && $pageNames != "page_login") {

    // Если до этого не вызывался другое сообщение вызываем
    if (!isset($_SESSION['messages'])) {
        sessionMessage("error", "Вы не вошли в систему");
    }
    redirectTo('page_login');
}








