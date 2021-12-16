<?php

require_once dirname(__FILE__) . "/../functions/BasicFunctions.php";
require_once dirname(__FILE__) . "/Connection_class.php";
require_once dirname(__FILE__) . "/ParentClasses/ValidationSQL_class.php";

class UpdateUserDB extends ValidationSQL { // Изменения в БД и все что связанное с ним
    private $db;

    public function __construct() {
        session_start();
        $connection = new Connection;
        $this->db = $connection->getDB();
    }

    public function addNewUserInfo($id, $prop) {
        $id = (int)$this->validating($id);
        $prop = $this->validating($prop);

        $sql = "insert into UsersInfo 
            (Name, Workspace, Phone, Address, User_ID) 
            values ('{$prop['Name']}', '{$prop['Workspace']}', '{$prop['Phone']}', '{$prop['Address']}', {$id})";

        $prep = $this->db->prepare($sql);
        if ($prep->execute()) {
            sessionMessage("success", "Успешно обновлено");
            return "success";
        }
        sessionMessage("error", "Произошла ошибка при добавлении");
        return false;
    }

    public function updateUserInfo($id, $prop) {
        $id = (int)$this->validating($id);
        $prop = $this->validating($prop);
        $sql = "update UsersInfo ui set ui.Name = '{$prop['Name']}', ui.Workspace = '{$prop['Workspace']}', ui.Phone = '{$prop['Phone']}', ui.Address = '{$prop['Address']}'
            where ui.User_ID = {$id}";
        $va = $this->db->prepare($sql);
        if ($va->execute()) {
            sessionMessage("success", "Успешно обновлено");
            return "success";

        }
        sessionMessage("error", "Произошла ошибка при обновлении");
        return false;
    }

    public function updateUserPassword($id, $prop) {
        $id = (int)$this->validating($id);
        $prop = $this->validating($prop);
        $sql = "update Users set Password = '{$prop['Password']}' where ID = {$id}";
        $var = $this->db->prepare($sql);
        if ($var->execute()) {
            sessionMessage("success", "Успешно обновлено");
            return "success";
        }
        sessionMessage("error", "Произошла ошибка при обновлении");
        return false;
    }

    public function updateUserStatus($idUser, $statusID) {
        $sql = "update Users set Status = {$statusID} where ID = {$idUser}";
        $prep = $this->db->prepare($sql);
        if ($prep->execute()) {
            sessionMessage("success", "Успешно обновлено");
            return "success";
        }
        sessionMessage("error", "Произошла ошибка при обновлении");
        return false;
    }

}