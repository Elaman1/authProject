<?php
require_once "connection_class.php";
require_once "../functions/basicFunctions.php";

class Auth {

    public $db;

    public function __construct() {
        $connection = new Connection;
        $this->db = $connection->db;
        session_start();
    }

    public function correctUser($email, $password) {
        // Проверка на корректность Пользователя если есть
        $sql = "select * from Users where Email = '{$email}' and Password = '{$password}'";
        $val = $this->db->query($sql)->fetch();
        if ($val != '') {
            if ($val['role'] == 1) {
                $_SESSION['isAdmin'] = true;
            }
            sessionMessage("success", "Вы залогинились");
            return $val['ID'];
        } else {
            sessionMessage("success", "Логин или пароль неправильный");
            return false;

        }
    }

    public function issetEmail($email) {
        $res = false;
        $sql = "select * from Users where Email = '{$email}'";
        $val = $this->db->query($sql)->fetch();
        if ($val != '') {
            sessionMessage("error", "Такой email существует");
            $res = true;
        }

        return $res;
    }

    public function addNewUsers($email, $password) {
        if (!$this->issetEmail($email)) {
            $query = "insert into Users (Email, Status, Password) Values ('{$email}', 1, '{$password}')";
            $db = $this->db->prepare($query);

            if ($db->execute()) {
                sessionMessage("success", "Регистрация прошла успешно");
            } else {
                sessionMessage("success", "Успешно обновлено");
            }
        }
    }
}