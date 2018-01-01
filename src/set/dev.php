<?php
	if(isset($_POST['value'])){
		$myfile = fopen("developer.dat", "w") or die("Unable to open file!");
		fwrite($myfile, $_POST['value']);
		fclose($myfile);
		header("Location: ../../stat.php");
	}
	else{
		header("Location: ../../stat.php");
	}
?>
