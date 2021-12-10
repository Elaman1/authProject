<?php

require_once "basicFunctions.php";
require_once "../classes/configureUser_class.php";


// Проверка get запроса
if (!isset($_GET['userID']) || !is_int((int)$_GET['userID']) || (int)$_GET['userID'] == 0) {
    $_SESSION['messages'] = array("type" => "error", "text" => "Выберите пользователя", "class" => "alert-danger");
    redirectTo('users');
}

if (isset($pageName)) {

    // Страница edit
    if ($pageName == "edit") {
        // Получение пользователя
        $userID = $_GET['userID'];
        $var = new ConfigureUser();
        $userInfo = $var->getUserForEdit($userID);


        // Если отправили обновление Post
        if (isset($_POST['Name'])) {
            $result = $var->updateUserForEdit($userID, $_POST);
            redirectTo('users');
        }

    }

    // Страница security
    if ($pageName == "security") {
        // Получение пользователя
        $userID = $_GET['userID'];
        $var = new ConfigureUser();
        $userSecurity = $var->getUserForSecurity($userID);


        // Если отправили новый пароль
        if (isset($_POST['Email'])) {
            if ($_POST['Password'] !== $_POST['Password2']) {
                $_SESSION['messages'] = array("type" => "error", "text" => "Пароли не совподают", "class" => "alert-danger");
            } else {
                $var->updateUserForSecurity($userID, $_POST);
            }

        }

    }

}





