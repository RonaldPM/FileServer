<!DOCTYPE html>
<html>
<link rel="shortcut icon" type="image/png" href="https://material.io/icons/static/images/icons-180x180.png">
<meta name="theme-color" content="#111">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<head>
  <title>FileServer</title>
  <link rel="stylesheet" href="src/css/stat.css">
  <script type="text/javascript" src="src/script/script.js"></script>
</head>
<body>
<body id="body">
		<div class='main'>
			<a href="index.php" class="whiteLink"><div id="uploadLaunchButton" class="shadowLight">Back</div></a>
      <div class="leftPart">
        <div class="matterHolder shadow">
          <font class="title-in">FileServer</font><br><br>
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

  				echo "Total file size on disk : ".$dirSize. "<br/<br/>";
  				//echo "<br />Server IP : $ip";
  				echo "
  					<br>
  					<font size='3'>Set a storage cap :</font>
  					<br><br>
  					<form action='src/set/setCap.php' method='GET'>
  						<input type='text' id='cap' name='cap' class='textInp shadowLight' placeholder='Enter limit in GB'>
  						<input type='submit' class='setButton shadowLight' value='Set limit'>
  					</form>
  				";

  				$ip=$_SERVER['REMOTE_ADDR'];
  				if($ip=="127.0.0.1"){
  					$capFile = fopen("src/set/disableDel.dat", "r") or die("Unable to open file!");
  				    $delStat = fread($capFile,filesize("src/set/disableDel.dat"));
  				    fclose($capFile);
  				    if($delStat==0){
                echo "
                </div>
                <div class='deleteOption shadow'>
            				<form action='src/set/disableDel.php' method='GET'>
            					<b>Disable file delete option : </b><br><br>
            					<input type='checkbox' name='able' value='disable'>Disable
            					<br /><br />
            					<input type='submit' class='setRuleBtn disable shadow' value='Set rule'>
            				</form>
                </div>
                <div class='deleteOption shadow' style='background:#fff;'>";
  					}
  					elseif($delStat==1){
  						echo "
  							</div>
                <div class='deleteOption shadow'>
    							<form action='src/set/enableDel.php' method='GET'>
    								<b>Enable file delete option : </b>
    								<br /><br />
    								<input type='checkbox' name='enable' value='enable'>Enable
    								<br /><br />
    								<input type='submit' class='setRuleBtn enable shadow' value='Set rule'>
    							</form>
                </div>
                <div class='deleteOption shadow' style='background:#fff;'>
  						";
  					}
  				}
  				else{
  					echo "
  						<br />
  						Your device IP : $ip <br><Br>
  					";
  				}
  				echo "
  					<a style='color:#777;font-size:15px;' href='changelog.html'>View Changelogs</a>
  				";
  			?>
      </div>
    </div>
    <div class="rightPart">
      <div class='deleteOption shadow' style="background:url('src/img/update.gif') center/cover;padding:0px;">
        <div class="inRightPart"></div>
      </div>
      <div class="deleteOption shadow">
        Software Version : V1.2.3<br>
        <a style="line-height:1.6;" href="https://github.com/RonaldPM/FileServer">Check for Updates</a>
      </div
    </div>
		</div>
	</body>
</html>
