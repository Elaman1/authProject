<?php
if (!defined(ACCESSDENIED) && ACCESSDENIED != true) {
    echo "Доступ закрыт";
    die;
}
const HOSTNAME = "localhost";
const DBNAME = "AuthProject";
const DBUSER = "root";
const DBPASSWORD = "";