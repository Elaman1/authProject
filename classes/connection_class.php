<?php
const ACCESSDENIED = true;
require_once "../config/database.php";

class Connection {
    public $db;

    public function __construct()
    {
        try {
            $conn = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME."", DBUSER, DBPASSWORD);
            $this->db = $conn;
        } catch (PDOException $pe) {
            die("Could not connect to the database ".DBNAME." :" . $pe->getMessage());
        }
    }
}
