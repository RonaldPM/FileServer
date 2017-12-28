<?php
if(isset($_POST['submit'])){
    if(count($_FILES['upload']['name']) > 0){
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
            echo $tmpFilePath."\n";
            if($tmpFilePath != ""){
                $shortname = $_FILES['upload']['name'][$i];
                $filePath = "uploaded/".$_FILES['upload']['name'][$i];
                if(move_uploaded_file($tmpFilePath, $filePath))
                    $files[] = $shortname;
            }
        }
    }
    echo "<h1>Uploaded:</h1>";
    if(is_array($files)){
        echo "<ul>";
        foreach($files as $file){
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }
}
?>
