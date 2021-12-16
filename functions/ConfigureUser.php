<?php

require_once dirname(__FILE__) . "/BasicFunctions.php";
require_once dirname(__FILE__) . "/../classes/UserDB_class.php";
require_once dirname(__FILE__) . "/../classes/UpdateUserDB_class.php";


// Проверка get запроса
if (!isset($_GET['userID']) || (int)$_GET['userID'] == 0) {
    sessionMessage("error", "Выберите пользователя");
    redirectTo('users');
}

if (isset($pageName)) {
    // Получение пользователя
    $userID = (int)$_GET['userID'];
    $confUser = new UpdateUserDB(); //Configuration User
    $userDB = new UserDB();

    if ($pageName == "edit") {
        $userInfo = $userDB->getUserInfo($userID);

        // Если отправили обновление Post
        if (isset($_POST['Name'])) {

            if (empty($userInfo['Address'])) {
                $confUser->addNewUserInfo($userID, $_POST);
                redirectTo('users');
            }

            $confUser->updateUserInfo($userID, $_POST);
            redirectTo('users');
        }

    }

    if ($pageName == "security") {
        $userSecurity = $_SESSION['user'];

        // Если отправили новый пароль
        if (isset($_POST['Email'])) {

            if ($_POST['Password'] !== $_POST['Password2']) {
                sessionMessage("error", "Пароли не совпадают");
            } else {
                if ($_POST['Email'] != $_SESSION['user']['Email']) {
                    sessionMessage("error", "Email не совпадают");
                    return;
                }

                $_POST['Password'] = md5($_POST['Password']);
                $confUser->updateUserPassword($userID, $_POST);
            }

        }

    }

    if ($pageName == "status") {
        $user = $userDB->getUser($_SESSION['user']['Email']);
        $userStatus = $user['Status'];
        $allStatus = $userDB->getAllStatusUser();

        // Если хотим обновить
        if (isset($_POST['status'])) {
            $result = $confUser->updateUserStatus($userID, $_POST['status']);
            if ($result == "success") {
                sessionMessage("success", "Успешно обновлено");
                redirectTo('users');
            }
            sessionMessage("error", "Произошла ошибка");
        }
    }

}





