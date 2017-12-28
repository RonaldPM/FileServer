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

				echo "<b>Software version :</b> V1.2.3 <font size='0.2' color='#00C853'><a href='https://github.com/RonaldPM/FileServer'>Check for updates</a></font><br/><br/>";
				echo "<b>Total file size on disk :</b> ".$dirSize. "<br/<br/>";
				//echo "<br />Server IP : $ip";
				echo "
					<br />
					<b>Set a storage cap : </b>
					<br /><br />
					<form action='src/set/setCap.php' method='GET'>
						<input type='text' id='cap' name='cap' class='textInp' placeholder='Enter limit in GB'>
						<input type='submit' class='uploadBtn' value='Set limit' style='height:25px;'>
					</form>
				";

				$ip=$_SERVER['REMOTE_ADDR'];
				if($ip=="::1"){
					$capFile = fopen("src/set/disableDel.dat", "r") or die("Unable to open file!");
				    $delStat = fread($capFile,filesize("src/set/disableDel.dat"));
				    fclose($capFile);
				    if($delStat==0){
						echo "
							<br />
							<form action='src/set/disableDel.php' method='GET'>
								<b>Disable file delete option : </b>
								<br /><br />
								<input type='checkbox' name='able' value='disable'>Disable
								<br /><br />
								<input type='submit' class='uploadBtn' value='Set rule' style='height:25px;'>
							</form>
						";
					}
					elseif($delStat==1){
						echo "
							<br />
							<form action='src/set/enableDel.php' method='GET'>
								<b>Enable file delete option : </b>
								<br /><br />
								<input type='checkbox' name='enable' value='enable'>Enable
								<br /><br />
								<input type='submit' class='uploadBtn' value='Set rule' style='height:25px;'>
							</form>
						";
					}
				}
				else{
					echo "
						<br />
						<b>Your device IP : </b> $ip
					";
				}
				echo "
					<br /><br />
					<b><a href='changelog.html'>View changelogs</a></b>
				";
			?>
		</div>
	</body>
</html>