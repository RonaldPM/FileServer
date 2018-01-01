<?php
  error_reporting(0);
  if(!isset($_GET['i']) || $_GET['i']==""){
    header("Location:.");
  }
  else{
    if($_GET['i']=="."){
      header("Location:.");
      exit();
    }
    if(file_exists('uploads/projectFolders/'.$_GET['i'])){
        $project=$_GET['i'];
        $dirDepth=explode('/',$project);
        if(sizeof($dirDepth)==1)
          $back=".";
        else{
          $back="";
          $back.=$dirDepth[0];
          for($j=1;$j<sizeof($dirDepth)-1;$j++)
            $back=$back.'/'.$dirDepth[$j];
        }
      ?>
      <!DOCTYPE html>
      <html>
      <meta name="theme-color" content="#111">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <head>
        <title><?php echo explode('/',$project)[0]; ?></title>
        <link rel="stylesheet" href="src/css/lis-dir.css">
      </head>
      <body id="body" style="background:#f1f1f1;">
        <div class="main">
          <?php
          echo '
            <a href="lis-dir.php?i='.$back.'" class="whiteLink"><div id="uploadLaunchButton" class="shadowLight">Back</div></a>
            <div class="dev-projectSecHolder">
              <div class="dev-heading">';
                for($j=0;$j<sizeof($dirDepth);$j++){
                  $loc="";
                  for($k=0;$k<=$j;$k++){
                    if($k==0)
                      $loc=$dirDepth[$k];
                    else
                      $loc=$loc.'/'.$dirDepth[$k];
                  }
                  echo '<a class="inherit"href="lis-dir.php?i='.$loc.'">'.$dirDepth[$j].'</a>';
                  if($j!=sizeof($dirDepth)-1)
                    echo '&#8674;';
                }
              echo '
              </div>';
              $files=scandir('uploads/projectFolders/'.$project);
              if(count($files)==2)
                echo'This place is empty';
              echo '
              <div class="fileListHolder shadow">';
                for($i=2;$i<count($files);$i++){
                  if(scandir('uploads/projectFolders/'.$project.'/'.$files[$i])){
                    echo '
                    <a href="lis-dir.php?i='.$project.'/'.$files[$i].'">
                    <div class="eachElement folder">
                      <img src="src/img/folder.png" class="folder-icon">
                      <div class="text-follows">'.($files[$i]).'</div>
                      <a href="del.php?id='.$files[$i].'&loc='.$project.'&p=dir">
                        <img src="src/img/delete.png" style="float:right;height:20px;width:20px;">
                      </a>
                    </div>
                    </a>';
                  }
                  else{
                    echo '
                    <a href="fil-dir.php?i='.$project.'/'.$files[$i].'">
                    <div class="eachElement file">
                      <img src="src/img/file.png" class="folder-icon">
                      <div class="text-follows">'.$files[$i].'</div>
                      <a href="del.php?id='.$files[$i].'&loc='.$project.'&p=file">
                        <img src="src/img/delete.png" style="float:right;height:20px;width:20px;">
                      </a>
                    </div>
                    </a>';
                  }
                }
              echo'
              </div>
              <div class="fileListHolder uploadHolder">
                <form action="src/set/startProj.php" method="post">
                  <input type="text" name="loc" value="'.$project.'" style="display:none;">
                  <div class="text">Add new dir</div>
                  <div class="browser"><input name="projectName" type="text" class="textInp" placeholder="name(s separated by comas)"/></div>
                  <div class="submit"><input type="submit" value="Create" name="submit" class="upload"></div>
                </form>
                    <div class="itemSeparator"></div>
                <form action="uploadMul.php" enctype="multipart/form-data" method="post">
                  <input type="text" name="loc" value="'.$project.'" style="display:none;">
                  <div class="text">Upload files</div>
                  <div class="browser"><input name="upload[]" type="file" multiple="multiple"/></div>
                  <div class="submit"><input type="submit" value="upload" name="submit" class="upload"></div>
                </form>
              </div>
            </div>
            ';
          ?>
        </div>
        <?php
          if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=="::1"){
            echo '
              <div class="main">
              ';
              if($back=="."){
                echo'
                  <form action="del.php" method="post">
                  <input type="text" value="'.$project.'" name="projectName" style="display:none;">
                  <input type="submit" class="deleteProjectButton shadow" value="Delete this project">
                  </form>
                ';
              }
              echo '
              </div>';
            }
        ?>
      <div class="freeSpace"></div>
      </body>
      </html>
      <?php
    }
    else{
      ?>
      <!DOCTYPE html>
      <html>
      <meta name="theme-color" content="#111">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <head>
        <title>FileServer : Error</title>
        <link rel="stylesheet" href="src/css/lis-dir.css">
      </head>
      <body id="body" style="background:#f1f1f1;">
        <div class="main">
          <div class="noFileHolder shadow">Oops. The location does not seem to exist</div>
          <div class="noFileHelp shadow">Let&apos;s go back <a href=".">home</a></div>
        </div>
      </body>
      </html>
      <?php
    }
  }
?>
