<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Book Library</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="public/css/main.css">
	<?php 
    if (isset($_GET['controller']) && $_GET['controller'] == 'Auth' && isset($_GET['action']) && $_GET['action'] == 'login') {
        echo '<link rel="stylesheet" href="public/css/login.css">';
    }?>

	<?php
	if (isset($_GET['controller']) && $_GET['controller'] == 'Auth' && isset($_GET['action']) && $_GET['action'] == 'register') {
        echo '<link rel="stylesheet" href="public/css/register.css">';
    }?>
	
	<?php
	if(isset($_GET['controller']) && $_GET['controller'] == 'Home' && isset($_GET['action']) && $_GET['action'] == 'index') {
        echo '<link rel="stylesheet" href="public/css/home-index.css">';
    }?>
	
	<link rel="stylesheet" href="public/css/font-awesome.min.css">
</head>
<body>

	<?php 
		if (!(isset($_GET['controller']) && $_GET['controller'] == 'Auth')) {
        	include_once __DIR__ . "/home/header.php";
    }?>


    <?php require_once "route.php"; ?>

	<script src="https://kit.fontawesome.com/300afa901c.js" crossorigin="anonymous"></script>
	
	<script src="public/js/handleChoseCalendar.js" defer></script>
	<script src="public/js/handleShowListCity.js" defer></script>
	<script src="public/js/handleShowPass.js" defer></script>
</body>
</html>