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
	echo '
	<!DOCTYPE html>
	<html>
	<meta name="theme-color" content="#111">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<head>
	  <title>'.$pTitle.'</title>
	  <link rel="stylesheet" href="src/css/type.css">
	  <script type="text/javascript" src="src/script/script.js"></script>
	</head>
	<body>
	<body id="body">
		<div class="topbar shadowDeep">
			<a href="index.php" class="whiteLink">Back</a>
			<div class="rightPanel">'.$dirSize.'</div>
		</div>
		<div class="main">
	';
	if($fileCount>3){
		for($i=2;$i<$fileCount;$i++){
			$fileLoc = $dir.$files[$i];
				if($files[$i]!=".notempty"){
					echo "
					<a href='$fileLoc'>
						<div class='fileName shadowLight'>
						";
							//The thumbnail
							if($typ==1){
								echo "
									<div class='thumbnailHolder'><img src='$fileLoc' class='thumbnail'></div>
								";
								$loc = "uploads/img/";
							}
							if($typ==2){
								echo "
									<div class='thumbnailHolder lessPadding'><img src='src/img/vid.png' class='thumbnail'></div>
								";
								$loc = "uploads/vid/";
							}
							if($typ==3){
								echo "
									<div class='thumbnailHolder lessPadding'><img src='src/img/aud.png' class='thumbnail'></div>
								";
								$loc = "uploads/aud/";
							}
							if($typ==4){
								echo "
									<div class='thumbnailHolder lessPadding'><img src='src/img/oth.png' class='thumbnail'></div>
								";
								$loc = "uploads/oth/";
							}

						echo"
							<div class='nameTxt'>
								";
								$fileAddr = $loc.$files[$i];
								$files[$i] = substr($files[$i], 0, 32);
								echo "
								$files[$i]
							</div>
							";
							if($delStat==0){
								echo "
									<a href='del.php?id=$fileAddr&t=$typ'>
										<img src='src/img/delete.png' title='Delete File' class='delBtn'>
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
		echo "<div style='font-family:arial;color:#555;font-size:18px;'>Folder is empty</div>";
	}
	echo "
			</div>
		</body>
		</html>

	";
?>
