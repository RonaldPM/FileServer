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
                  echo $dirDepth[$j];
                  if($j!=sizeof($dirDepth)-1)
                    echo '&#8674;';
                }
              echo '
              </div>
              ';
              $f=explode('.',$project);
              $printList=array('txt','php','html','md','js','css','py','c','sh','cpp','java','asp','bat','h','jar');
              if(in_array(pathinfo('uploads/projectFolders/'.$project)['extension'],$printList)){
                $data=nl2br(htmlentities(file_get_contents("uploads/projectFolders/".$project)));
                  echo '<a class="inherit" href="download.php?i=uploads/projectFolders/'.$project.'">
                    <div class="downloadBtn shadow addF">download</div>
                  </a>';
                echo '<div class="shadow fileListHolder addF" background:#fff;>';
                echo '<pre>'.$data.'</pre>
                      </div>';
              }
              else{
                $files=explode('/',$project);
                print_r($files);
                echo $files[sizeof($files)-1];
                header("Content-disposition: attachment;filename=".str_replace(" ","-",$files[sizeof($files)-1]));
                echo readfile('uploads/projectFolders/'.$project);
              }
              echo '
            </div>
            ';
          ?>
        </div>
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
