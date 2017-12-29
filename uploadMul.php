<?php
if(isset($_POST['submit'])){
    //Get the content of memCap.dat file which contains the maximus strage
    //limit which is set by the admin
    $capFile = fopen("src/set/memCap.dat", "r") or die("Unable to open file!");
    $cap = fread($capFile,filesize("src/set/memCap.dat"));
    fclose($capFile);

    //Get the current folder size
    function folderSize ($dir){
        $size = 0;
        foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : folderSize($each);
        }
        return $size;
    }
    $dirSize = (folderSize("uploads/")/1024)/1024/1024;
    $precision = 2;
    $dirSize = substr(number_format($dirSize, $precision+1, '.', ''), 0, -1);

    //Get the total file size of files being uploaded (in GB)
    $uploadSize = 0;
    if(count($_FILES['upload']['name']) > 0){
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
            $fSize = $_FILES['upload']['size'][$i]/1024/1024/1024;
            $uploadSize = $uploadSize + $fSize;
        }
    }
    else{
        //Redirect to home page
        header('Location: index.php');
    }

    //Add current folder size and the size of the file being uploaded
    //The size is in GB to match with storage cap set by admin
    $totSize = $uploadSize + $dirSize;

    //If the total size is less than the cap set
    //Files can be uploaded
    if($totSize<=$cap){
        //Upload the files
        //Get each files
        $failUpload = 0;
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {

            $file_name = $_FILES['upload']['name'][$i];
            $file_tmp = $_FILES['upload']['tmp_name'][$i];
            $file_size = $_FILES['upload']['size'][$i];
            $file_error = $_FILES['upload']['error'][$i];
            $file_dir = "uploads/oth/";
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $file_error = 0;
                if($file_error === 0) {
                    if($file_ext == "png" || $file_ext == "jpg" ||$file_ext == "jpeg" ||$file_ext == "gif" ||$file_ext == "bmp"){
                        $file_dir = "uploads/img/";
                    }
                    elseif ($file_ext == "mp4" ||$file_ext == "avi" ||$file_ext == "mkv" ||$file_ext == "mpeg" ||$file_ext == "mov") {
                        $file_dir = "uploads/vid/";
                    }
                    elseif ($file_ext == "mp3" ||$file_ext == "flac") {
                        $file_dir = "uploads/aud/";
                    }
                    $file_destination = $file_dir . $file_name;
                    if(move_uploaded_file($file_tmp, $file_destination)) {
                        continue;
                    }
                    else
                        $failUpload++;
                }
        }
        //Redirect to home page
        if($failUpload>0)
            header('Location: index.php?e=$failUpload');
        else{
            header('Location: index.php');
        }
        //header('Location: index.php');
    }
    //Storage cap exceeded. Error message is shown
    else{
         echo "Storage limit exceeded! Delete some files or increase the storage limit from dashboard.";
    }
}
?>
