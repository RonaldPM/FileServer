<?php
	if(isset($_GET['enable'])== true){
		$able = $_GET['enable'];
		if($able="enable"){
			unlink("disableDel.dat");
			$myfile = fopen("disableDel.dat", "w") or die("Unable to open file!");
			$txt = 0;
			fwrite($myfile, $txt);
			fclose($myfile);
			header("Location: ../../stat.php");
		}
	}
	else{
		header("Location: ../../stat.php");
	}
?>