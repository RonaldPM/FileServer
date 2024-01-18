<?php
  if(isset($_GET['i']) && $_GET['i']!=""){
    $url=$_GET['i'];
    $fname=explode('/',$url);
    header("Content-disposition: attachment;filename=".$fname[2]);
    echo readfile($url);
  }
  else{
    header('Location:.');
  }
?>
