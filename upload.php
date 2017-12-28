<?php  
if(isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $capFile = fopen("src/set/memCap.dat", "r") or die("Unable to open file!");
    $cap = fread($capFile,filesize("src/set/memCap.dat"));
    fclose($capFile);

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

    if(($dirSize+($file['size']/1024/1024/1024))>$cap){
        echo "Storage limit exceeded! Delete some files or increase the storage limit from dashboard.";

    }                   
    else{
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
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
                    header('Location: index.php');
                }
                else
                	echo "Upload failed";
        	}
    }
}
?>