<html>
	<head>
		<link rel='stylesheet' href='src/css/main.css'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<link rel='stylesheet' href='src/css/responsive.css' media='screen and (max-width:900px)'>
		<title>File Server | Home</title>
	<head>
	<body>
		<div class='topNav'>
			<div class='aboutTxt'>
				File Server v1.1
			</div>
			<a href='stat.php'>
				<div class='statLogo right'>
					<img src='src/img/stat.png' width='40px' title='Server Status' alt='Server Status'>
				</div>
			</a>
			<div class='infoTxt' title='Storage used'>
				<?php
					function folderSize ($dir){
					    $size = 0;
					    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
					        $size += is_file($each) ? filesize($each) : folderSize($each);
					    }
					    return $size;
					}
					$dirSize = (folderSize("uploads/")/1024)/1024;
					$precision = 2;
					$dirSize = substr(number_format($dirSize, $precision+1, '.', ''), 0, -1);
					echo $dirSize. "MB";
				?>
			</div>
		</div>
		<br />
		<div class='mainBody'>
			<div class='uploadBox'>
				<form action='upload.php' method='post' enctype='multipart/form-data'>
				    <input type='file' name='file'>
				    <input type='submit' value='Upload' class='uploadBtn'>
				</form>
			</div>
			<br />
			<a href='type.php?typ=1'>
				<div class='typeBox card' style='background:#D32F2F;'><div class='typeTxt'>Images</div></div>
			</a>
			<a href='type.php?typ=2'>
				<div class='typeBox card' style='background:#6A1B9A;'><div class='typeTxt'>Videos</div></div>
			</a>
			<a href='type.php?typ=3'>
				<div class='typeBox card' style='background:#1565C0;'><div class='typeTxt'>Audios</div></div>
			</a>
			<a href='type.php?typ=4'>
				<div class='typeBox card' style='background:#FFB300;'><div class='typeTxt'>Others</div></div>
			</a>
		</div>
	</body>
<html>