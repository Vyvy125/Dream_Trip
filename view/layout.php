<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <title>Book Library</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="public/css/main.css">
	<?php
		$controller = $_GET['controller'] ?? 'Home';
		$action     = $_GET['action'] ?? 'index';

		$cssFile = 'public/css/' . strtolower($controller) . '-' . strtolower($action) . '.css';
		?>
		<?php if (file_exists($cssFile)): ?>
			<link rel="stylesheet" href="<?= htmlspecialchars($cssFile) ?>">
	<?php endif; ?>
	
	<link rel="stylesheet" href="public/css/font-awesome.min.css">
</head>
<body>

	<?php 
		if (!(isset($_GET['controller']) && $_GET['controller'] == 'Auth')) {
        	include_once __DIR__ . "/home/header.php";
    }?>


    <?php require_once "route.php"; ?>

	<?php 
		if (!(isset($_GET['controller']) && $_GET['controller'] == 'Auth')) {
        	include_once __DIR__ . "/home/footer.php";
    }?>

	<script src="https://kit.fontawesome.com/300afa901c.js" crossorigin="anonymous"></script>

	<script src="public/js/main.js" defer></script>
	<script src="public/js/handleTestimonialsCarousel.js" defer></script>
	<script src="public/js/handleDestinationsCarousel.js" defer></script>
	<script src="public/js/handleChoseCalendar.js" defer></script>
	<script src="public/js/handleShowListCity.js" defer></script>
	<script src="public/js/handleShowPass.js" defer></script>
</body>
</html>