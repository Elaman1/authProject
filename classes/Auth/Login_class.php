<?php

require_once dirname(__FILE__) . "/../../functions/BasicFunctions.php";
require_once dirname(__FILE__) . "/../UserDB_class.php";
require_once dirname(__FILE__) . "/../UpdateUserDB_class.php";
require_once dirname(__FILE__) . "/../ParentClasses/ValidationSQL_class.php";

class Login extends ValidationSQL {

    private $users;

    public function __construct() {
        $this->users = new UserDB();
        session_start();
    }

    public function logIn($email, $password) {
        $email = $this->validating($email);
        $user = $this->users->getUser($email, $password);

        if (!empty($user)) {
            if ($user['role'] == 1) { // Доступ админа
                $_SESSION['isAdmin'] = true;
            }
            sessionMessage("success", "Вы залогинились");
            return $user;
        }

        sessionMessage("error", "Логин или пароль неправильный");
        return false;
    }

}