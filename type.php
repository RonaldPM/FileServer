<?php
	
	function folderSize ($dir)
	{
	    $size = 0;
	    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
	        $size += is_file($each) ? filesize($each) : folderSize($each);
	    }
	    return $size;
	}

	$capFile = fopen("src/set/disableDel.dat", "r") or die("Unable to open file!");
    $delStat = fread($capFile,filesize("src/set/disableDel.dat"));
    fclose($capFile);

	$typ = $_GET['typ'];
	if($typ==1){
		$dir = "uploads/img/";
		$pTitle = "Images";
	}
	elseif($typ==2){
		$dir = "uploads/vid/";
		$pTitle = "Videos";
	}
	elseif($typ==3){
		$dir = "uploads/aud/";
		$pTitle = "Audio";
	}
	elseif($typ==4){
		$dir = "uploads/oth/";
		$pTitle = "Others";
	}
	else{

	}
	$files = scandir($dir);
	$fileCount = count($files);
	$dirSize = (folderSize($dir)/1024)/1024;
	if($dirSize<1024){
		$precision = 2;
		$dirSize = substr(number_format($dirSize, $precision+1, '.', ''), 0, -1);
		$dirSize= $dirSize." MB";
	}
	else{
		$precision = 2;
		$dirSize = $dirSize/1024;
		$dirSize = substr(number_format($dirSize, $precision+1, '.', ''), 0, -1);
		$dirSize= $dirSize." GB";
	}

	echo "
		<html>
		<head>
			<link rel='stylesheet' href='src/css/main.css'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<link rel='stylesheet' href='spine/css/responsive.css' media='screen and (max-width:900px)'>
			<title>$pTitle</title>
		<head>
		<body>
			<div class='topNav'>
				<div class='aboutTxt homeLogo'>
					<a href='index.php'><img src='src/img/home.png' width='25px'></a>
				</div>
				<div class='infoTxt right'>
					$dirSize
				</div>
			</div>
			<br />
			<div class='mainBody'>
	";
	if($fileCount>3){
		for($i=2;$i<$fileCount;$i++){
			$fileLoc = $dir.$files[$i];
				if($files[$i]!=".notempty"){
					echo "
					<a href='$fileLoc'>
						<div class='fileName'>
						";
							//The thumbnail
							if($typ==1){
								echo "
									<img src='$fileLoc' width='40px' height='40px' style='float:left;'>
								";
								$loc = "uploads/img/";
							}
							if($typ==2){
								echo "
									<img src='src/img/vid.png' width='35px' height='35px' style='float:left; margin-top:2px;'>
								";
								$loc = "uploads/vid/";
							}
							if($typ==3){
								echo "
									<img src='src/img/aud.png' width='35px' height='35px' style='float:left; margin-top:2px;'>
								";
								$loc = "uploads/aud/";
							}
							if($typ==4){
								echo "
									<img src='src/img/oth.png' width='35px' height='35px' style='float:left; margin-top:2px;'>
								";
								$loc = "uploads/oth/";
							}

						echo"
							<div class='nameTxt'>
								";
								//To add a padding if thumbnail is displayed
								if($typ==1||$typ==2||$typ==3||$typ==4){
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								}
								$fileAddr = $loc.$files[$i];
								$files[$i] = substr($files[$i], 0, 32);
								echo "
								$files[$i]
							</div>
							";
							if($delStat==0){
								echo "
									<a href='del.php?id=$fileAddr&t=$typ'>
										<img src='src/img/del.png' width='25px' height='25px' title='Delete File' class='delBtn'>
									</a>
								";
							}
							echo "
						</div>
					<a/>";
				}
		}
	}
	else{
		//The folder is empty
		echo "<div style='font-family:Tahoma;'>Folder is empty</div>";
	}
	echo "
			</div>
		</body>
		</html>

	";
?>