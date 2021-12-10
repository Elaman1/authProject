<?php

require_once "basicFunctions.php";
require_once "../classes/auth_class.php";
session_start();

$email = $_POST['Email'] ?? null;
$password = isset($_POST['Password']) ? md5($_POST['Password']) : null;

// Если вводил email и пароль
if ($email !== null && $password !== null) {
    $loggin_in = new Auth();
    $result = $loggin_in->correctUser($email, $password);
    if ($result != false) {
        $_SESSION['loggin_in'] = true;
        $_SESSION['userID'] = $result;
        if (!isset($pageName) || $pageName != "users") {
            redirectTo('users');
        }
    }
}
// Если не зашел
if ((!isset($_SESSION['loggin_in']) ||  $_SESSION['loggin_in'] != true) && (!isset($pageName) || $pageName != "page_login")) {
    // Если до этого вызывался другое сообщение вызываем
    if (!isset($_SESSION['messages'])) {
        $_SESSION['messages'] = array("type" => "error", "text" => "Вы не вошли в систему", "class" => "alert-danger");
    }
    redirectTo('page_login');
}








