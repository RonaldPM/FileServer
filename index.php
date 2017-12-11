<html>
	<head>
		<link rel='stylesheet' href='src/css/main.css'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<link rel='stylesheet' href='src/css/responsive.css' media='screen and (max-width:900px)'>
	<head>
	<body>
		<div class='topNav'>
			<div class='aboutTxt'>
				V0.1 Beta
			</div>
			<div class='infoTxt right'>
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
				    <input type='submit' value='Upload'>
				</form>
			</div>
			<br />
			<a href='type.php?typ=1'>
				<div class='typeBox' style='background:#039BE5;'><div class='typeTxt'>Images</div></div>
			</a>
			<a href='type.php?typ=2'>
				<div class='typeBox' style='background:#00838F;'><div class='typeTxt'>Videos</div></div>
			</a>
			<a href='type.php?typ=3'>
				<div class='typeBox' style='background:#FF6F00;'><div class='typeTxt'>Audios</div></div>
			</a>
			<a href='type.php?typ=4'>
				<div class='typeBox' style='background:#00C853;'><div class='typeTxt'>Others</div></div>
			</a>
		</div>
	</body>
<html>