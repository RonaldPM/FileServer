<?php
	$cap = $_GET['cap'];
	if(is_numeric($cap) && $cap>=0){
		unlink("memCap.dat");
		$myfile = fopen("memCap.dat", "w") or die("Unable to open file!");
		$txt = $cap;
		fwrite($myfile, $txt);
		fclose($myfile);
		header("Location: ../../stat.php");
	}
	else{
		echo "Please enter a number (Eg. 350)";
	}
?> 