<?php
	session_start();
	require_once('connect.php');

	if (!isset($_SESSION['username'])) {
		header ('Location: index.php');
		exit();
	}else{}
?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet" type="text/css" href="style.css">
		<title>Contact</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://kit.fontawesome.com/00341d3c98.js" crossorigin="anonymous"></script>
	<body>
		<?php require_once('header.php'); ?>
				<h1>Contact</h1>
				<?php require_once('footer.php'); ?>
	</body>
</html>
