<html>
	<head>
		<link rel='stylesheet' href='src/css/main.css'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<link rel='stylesheet' href='src/css/responsive.css' media='screen and (max-width:900px)'>
		<title>File Server | Status</title>
	<head>
	<body>
		<div class='topNav'>
			<div class='aboutTxt'>
				<a href='index.php'><img src='src/img/home.png' width='25px'></a>
			</div>
		</div>
		<br />
		<div class='mainBody paddLeft'>
			<?php
				function folderSize ($dir){
				    $size = 0;
				    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
				        $size += is_file($each) ? filesize($each) : folderSize($each);
				    }
				    return $size;
				}
				$dirSize = (folderSize("uploads/")/1024)/1024;
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

				echo "<b>Software version :</b> V1.2.2 <font size='0.2' color='#00C853'><a href='https://github.com/RonaldPM/FileServer'>Check for updates</a></font><br/><br/>";
				echo "<b>Total file size on disk :</b> ".$dirSize. "<br/<br/>";
				//echo "<br />Server IP : $ip";
				echo "
					<br />
					<b>Set a storage cap : </b>
					<br /><br />
					<form action='setCap.php' method='GET'>
						<input type='text' id='cap' name='cap' class='textInp' placeholder='Enter limit in GB'>
						<input type='submit' class='uploadBtn' value='Set limit' style='height:25px;'>
					</form>
					<br />
					<b><a href='changelog.html'>View changelogs</a></b>
				";
			?>
		</div>
	</body>
</html>