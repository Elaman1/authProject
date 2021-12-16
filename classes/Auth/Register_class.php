<?php

require_once dirname(__FILE__) . "/../Connection_class.php";
require_once dirname(__FILE__) . "/../UserDB_class.php";
require_once dirname(__FILE__) . "/../UpdateUserDB_class.php";
require_once dirname(__FILE__) . "/../../functions/BasicFunctions.php";
require_once dirname(__FILE__) . "/../ParentClasses/ValidationSQL_class.php";

class Register extends ValidationSQL {

    private $db;
    private $users;

    public function __construct() {
        $connection = new Connection;
        $this->db = $connection->getDB();
        $this->users = new UserDB();
        session_start();
    }

    public function regIn($email, $password) {
        $email = $this->validating($email);
        if (!$this->users->getUser($email)) {
            $query = "insert into Users (Email, Status, Password) values ('{$email}', 1, '{$password}')";
            $prepare = $this->db->prepare($query);

            if ($prepare->execute()) {
                sessionMessage("success", "Регистрация прошла успешно");
                return true;
            } else {
                sessionMessage("error", "Произошла ошибка");
                return false;
            }
        } else {
            sessionMessage("error", "Такой email существует");
            return false;
        }
    }

}