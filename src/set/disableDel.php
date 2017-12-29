<?php
	if(isset($_GET['able'])== true){
		$able = $_GET['able'];
		if($able="disable"){
			unlink("disableDel.dat");
			$myfile = fopen("disableDel.dat", "w") or die("Unable to open file!");
			$txt = 1;
			fwrite($myfile, $txt);
			fclose($myfile);
			header("Location: ../../stat.php");
		}
	}
	else{
		header("Location: ../../stat.php");
	}
?>