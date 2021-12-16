<?php

require_once dirname(__FILE__) . "/../functions/BasicFunctions.php";
require_once dirname(__FILE__) . "/Connection_class.php";
require_once dirname(__FILE__) . "/ParentClasses/ValidationSQL_class.php";

class UserDB extends ValidationSQL { // Выборка из БД Users и все что связанное с ним
    private $db;

    public function __construct() {
        session_start();
        $connection = new Connection;
        $this->db = $connection->getDB();
    }

    public function getAllUsers() {
        $sql = "select u.ID, u.Email, u.Status, u.role, ui.Name, ui.Workspace, ui.Phone, ui.Address, ui.Img_url, us.VK, us.Telegram, us.Instagram
                    from Users u
                    left join UsersInfo ui on ui.User_ID = u.ID
                    left join UsersSocials us on us.User_ID = u.ID
                ";

        return $this->db->query($sql)->fetchAll();

    }

    public function getUserInfo($id) {
        $id = (int)$this->validating($id);
        $sql = "select u.ID, ui.Name, ui.Workspace, ui.Phone, ui.Address, ui.Img_url
            from Users u
            left join UsersInfo ui on ui.User_ID = u.ID
            where u.ID = {$id}";

        return $this->db->query($sql)->fetch();

    }

    public function getUser($email, $password = null) {
        $email = $this->validating($email);

        $addSql = "";
        if ($password != null) {
            $addSql = "and Password = '{$password}'";
        }
        $sql = "select * from Users where Email = '{$email}' {$addSql}";
        return $this->db->query($sql)->fetch();

    }

    public function getAllStatusUser() {
        $sql = "select * from UserStatus";
        return $this->db->query($sql)->fetchAll();
    }


}