<?php

// Здесь храниться часто используемые функции
function redirectTo($url, $get = null) {
    header( 'Location: /authProject/public/' . $url .'.php'. $get);
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

function viewSessionMessage() {
    if (isset($_SESSION['messages'])) {
        echo ('
                <div class="alert ' . $_SESSION['messages']['class'] . ' text-dark" role="alert">
                    ' . $_SESSION['messages']['text'] . '
                </div>
            ');
        unset($_SESSION['messages']);

    }
}