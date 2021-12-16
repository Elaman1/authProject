<?php

// Страница на подобии выхода, если перейти сюда то выходишь из аккаунта
session_start();
if (isset($_SESSION['loggin_in'])) {
    unset($_SESSION);
}
header('Location: page_login.php');