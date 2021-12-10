<?php

// Страница на подобии выхода, если перейти сюда то выходишь из аккаунта
session_start();
if (isset($_SESSION['loggin_in'])) {
    unset($_SESSION['loggin_in']);
    unset($_SESSION['messages']);
    unset($_SESSION['userID']);
}
header('Location: authProject/page_login.php');