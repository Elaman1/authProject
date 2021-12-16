<?php

require_once dirname(__FILE__) . "/../classes/UserDB_class.php";

$users = (new UserDB())->getAllUsers();