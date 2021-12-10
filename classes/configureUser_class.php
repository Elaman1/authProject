<?php
require_once "connection_class.php";
require_once "../functions/basicFunctions.php";



class ConfigureUser {
    public $db;

    public function __construct() {
        session_start();
        $connection = new Connection;
        $this->db = $connection->db;
    }


    // Users page ===================
    public function getUsersForUsers() {
        $sql = "select u.ID, u.Email, u.Status, u.role, ui.Name, ui.Workspace, ui.Phone, ui.Address, ui.Img_url, us.VK, us.Telegram, us.Instagram
                    from Users u
                    left join UsersInfo ui on ui.User_ID = u.ID
                    left join UsersSocials us on us.User_ID = u.ID
                ";

        return $this->db->query($sql)->fetchAll();

    }



    // Edit page =====================
    public function getUserForEdit($id) {
        $sql = "select u.ID, ui.Name, ui.Workspace, ui.Phone, ui.Address, ui.Img_url
            from Users u
            left join UsersInfo ui on ui.User_ID = u.ID
            where u.ID = {$id}";

        return $this->db->query($sql)->fetch();

    }

    public function updateUserForEdit($id, $prop) {
        // Проверка есть ли Инфо у пользователя
        $sql1 = "select ID from UsersInfo where User_ID = {$id}";
        $que = $this->db->query($sql1)->fetch();

        if ($que == false || $que == null) {
            $sql2 = "insert into UsersInfo 
            (Name, Workspace, Phone, Address, User_ID) 
            values ('{$prop['Name']}', '{$prop['Workspace']}', '{$prop['Phone']}', '{$prop['Address']}', {$id})";

            $prep = $this->db->prepare($sql2);
            if ($prep->execute()) {
                sessionMessage("success", "Успешно обновлено");
                return "success";
            }
            sessionMessage("error", "Произошла ошибка при добавлении");
            return false;
        }

        $sql = "update UsersInfo ui set ui.Name = '{$prop['Name']}', ui.Workspace = '{$prop['Workspace']}', ui.Phone = '{$prop['Phone']}', ui.Address = '{$prop['Address']}'
            where ui.User_ID = {$id}";
        $va = $this->db->prepare($sql);
        if ($va->execute()) {
            sessionMessage("success", "Успешно обновлено");
            return "success";

        } else {
            sessionMessage("error", "Произошла ошибка при обновлении");
            return false;
        }
    }

    // Security page
    public function getUserForSecurity($userID) {
        $sql = "select Email, ID from Users where ID = {$userID}";
        return $this->db->query($sql)->fetch();
    }

    public function updateUserForSecurity($id, $prop) {
        $sql1 = "select ID from Users where ID = {$id} and Email = '{$prop['Email']}'";
        $var1 = $this->db->query($sql1)->fetch();
        if ($var1 == null || $var1 == '') {
            sessionMessage("error", "Email не совпадает с прошлым Email");
            return false;
        }

        $password = md5($prop['Password']);
        $sql = "update Users set Password = '{$password}' where Email = '{$prop['Email']}'";
        $var = $this->db->prepare($sql);
        if ($var->execute()) {
            sessionMessage("success", "Успешно обновлено");
            return "success";
        }
        sessionMessage("error", "Произошла ошибка при обновлении");
        return false;
    }
}