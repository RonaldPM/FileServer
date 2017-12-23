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
				<a href='index.php'>Home</a>
			</div>
		</div>
		<br />
		<div class='mainBody'>
			<?php
				function folderSize ($dir){
				    $size = 0;
				    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
				        $size += is_file($each) ? filesize($each) : folderSize($each);
				    }
				    return $size;
				}
				function get_server_cpu_usage(){

				    $load = sys_getloadavg();
				    return $load[0];

				}

				$dirSize = (folderSize("uploads/")/1024)/1024;
				$precision = 2;
				$dirSize = substr(number_format($dirSize, $precision+1, '.', ''), 0, -1);
				$ip = $_SERVER['SERVER_ADDR'];

				echo "Software version : V1.1 <font size='0.2' color='#00C853'><a href='https://github.com/RonaldPM/FileServer'>Check for updates</a></font><br/><br/>";
				echo "Total file size on disk : ".$dirSize. "MB <br/<br/>";
				//echo "<br />Server IP : $ip";
				echo "
					<br />
					Set a storage cap : 
					<br /><br />
					<form action='setCap.php' method='GET'>
						<input type='text' id='cap' name='cap' class='textInp' placeholder='Enter limit in GB'>
						<input type='submit' class='uploadBtn' value='Set limit' style='height:25px;'>
					</form>
				";
			?>
		</div>
	</body>
</html>