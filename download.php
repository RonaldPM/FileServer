<?php
  if(isset($_GET['i']) && $_GET['i']!=""){
    $url=$_GET['i'];
    $fname=explode('/',$url);
    header("Content-disposition: attachment;filename=".str_replace(" ","-",$fname[sizeof($fname)-1]));
    echo readfile($url);
  }
  else{
    header('Location:.');
  }
?>
