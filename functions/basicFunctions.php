<?php

// Здесь храниться часто используемые функции
function redirectTo($url, $get = null) {
    header( 'Location: /authProject/' . $url .'.php'. $get);
}

function dd($var) {
    print_r($var);
    die;
}

function sessionMessage($type, $text) {
    session_start();
    $class = $type == "error" ? "alert-danger" : "alert-success";
    $_SESSION['messages'] = [
        "type" => $type, 
        "text" => $text, 
        "class" => $class
    ];
}