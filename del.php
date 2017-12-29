<?php
	$loc = $_GET['id'];
	$typ = $_GET['t'];
	unlink($loc);
	header("Location: type.php?typ=$typ");
?>
