<?php
error_reporting(0);
if(isset($_GET['loc']) && !isset($_POST['projectName'])){
	$p='uploads/projectFolders/'.$_GET['loc'].'/'.$_GET['id'];
	echo $_GET['p'];
	if($_GET['p']=="dir"){
		function delete_files($target) {
		    if(is_dir($target)){
		        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

		        foreach( $files as $file )
		        {
		            delete_files( $file );
		        }

		        rmdir( $target );
		    } elseif(is_file($target)) {
		        unlink( $target );
		    }
		}
		delete_files($p);
	}
	else
		unlink($p);
	header("Location: lis-dir.php?i=".$_GET['loc']);
}
else if(isset($_POST['projectName'])){
	function delete_files($target) {
			if(is_dir($target)){
					$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

					foreach( $files as $file )
					{
							delete_files( $file );
					}
					rmdir( $target );
			}
			elseif(is_file($target)) {
					unlink( $target );
			}
	}
	delete_files('uploads/projectFolders/'.$_POST['projectName']);
	header('Location:.?STATUS=Project : '.$_POST['projectName'].' -> deleted');
}
else{
	$loc = $_GET['id'];
	$typ = $_GET['t'];
	unlink($loc);
	header("Location: type.php?typ=$typ");
}
?>
