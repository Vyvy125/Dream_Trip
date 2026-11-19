<?php
    require_once "controller/{$controller}.php";
    switch($controller) {
        case "Home":
            $controller = new Home();
            break;
        case "Auth":
            $controller = new Auth();
            break;
    }
    $controller->{$action}();
?>