<?php
  error_reporting(0);
  if(isset($_POST['projectName']) && $_POST['projectName']!="" && !(isset($_POST['loc']))){
    $pn=$_POST['projectName'];
    if(mkdir("../../uploads/projectFolders/".$pn)){
      header('Location:../../');
    }
    else{
      echo '
      <!DOCTYPE html>
      <html>
      <meta name="theme-color" content="#111">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <head>
        <title>Error</title>
      </head>
      <body>
      Some error occured while starting your project. Possible causes:<br>
      <ul>
      <li>Project name cannot contain special characters like ( / |  \\ ).</li>
      <li>A project of the same name is currently in action</li>
      </ul>
      Please correct and then continue...
      </body>
      </html>';
    }
  }
  else if(isset($_POST['projectName']) && $_POST['projectName']!="" && (isset($_POST['loc']))){
    $directories=explode(',',$_POST['projectName']);
    $count=0;
    for($i=0;$i<count($directories);$i++){
      if(mkdir("../../uploads/projectFolders/".$_POST['loc'].'/'.$directories[$i])){
        $count++;
      }
    }
    if($count==$i)
      header('Location:../../lis-dir.php?i='.$_POST['loc'].'&STATUS=Done');
    else
      header('Location:../../lis-dir.php?i='.$_POST['loc'].'&STATUS=Error&REASON-MAY-BE=sameDirExists');
  }
  else{
    header('Location:../../');
  }
?>
