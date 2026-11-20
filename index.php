<?php
session_start();

require_once "config/db.php";
require_once "model/master.php";

if (isset($_GET["controller"], $_GET["action"])) {
    $controller = $_GET["controller"];
    $action = $_GET["action"];
} else {
    $controller = "Home";
    $action = "index";
}


if (in_array($action, ["handlelogin", "handleRegister"], true)) {
    require_once "view/route.php";
    exit();
}

require_once "view/layout.php";