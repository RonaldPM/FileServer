<!DOCTYPE html>
<html>
<meta name="theme-color" content="#111">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<head>
  <title>FileServer</title>
  <link rel="stylesheet" href="src/css/index.css">
  <script type="text/javascript" src="src/script/script.js"></script>
</head>
<body id="body">
  <div class="topbar shadowDeep">
    FileServer
    <div class="rightPanel">
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
          echo $dirSize." MB";
        }
        else{
          $precision = 2;
          $dirSize = $dirSize/1024;
          $dirSize = substr(number_format($dirSize, $precision+1, '.', ''), 0, -1);
          echo $dirSize." GB";
        }
      ?>
      <a href="stat.php">
        <div class="statIconHolder shadowDeep"><img src="src/img/stat.png" alt="Server Status" class="statImg"></div>
      </a>
    </div>
  </div>
  <div class="main">
    <div class="uploadHolder">
      <div id="uploadLaunchButton" class="shadowDeep" onclick="showuploadBox()">Upload</div>
      <!--uploadBox-->
      <div class="inContainer" id="inContainer">
        <div style="display:none;" id="lcarte">
          <div class="closeBtn shadow" onclick="hideuploadBox()"></div>
          <br>Select items to upload..<br><br>
          <form action="uploadMul.php" enctype="multipart/form-data" method="post" name="uploadForm">
              <input type="text" name="inputBox" class="uploadSelector shadow" onclick="clickOnBrowse()">
                <div class="uploadSelectorSideDiv shadow" onclick="clickOnBrowse()">Browze	</div>
              <input id='upload' name="upload[]" type="file" multiple="multiple" onChange="makeFileList();" style="display:none;"/>
              <div class="submitBtnHolder"><input type="submit" class="uploadBtn shadow" name="submit" value="Submit">
          </form>
              <ul id="fileList">
      				  No Files Selected
      				</ul>
            </div>
        </div>
      </div>
    </div>
    <!--items------------>
    <a href='type.php?typ=1'>
    <div class="pieceHolder shadow">
      <div class="pieceHolder-image" style="background:url('src/img/images.jpg') center/cover"></div>
      <div class="pieceHolder-text">Images</div>
    </div>
    </a>
    <a href='type.php?typ=2'>
    <div class="pieceHolder shadow">
      <div class="pieceHolder-image" style="background:url('src/img/videos.png') center/cover"></div>
      <div class="pieceHolder-text">Videos</div>
    </div>
    </a>
    <a href='type.php?typ=3'>
    <div class="pieceHolder shadow">
      <div class="pieceHolder-image" style="background:url('src/img/audios.jpg') center/cover"></div>
      <div class="pieceHolder-text">Audios</div>
    </div>
    </a>
    <a href='type.php?typ=4'>
    <div class="pieceHolder shadow">
      <div class="pieceHolder-image" style="background:url('src/img/others.png') center/cover"></div>
      <div class="pieceHolder-text">Others</div>
    </div>
    </a>
  </div>
</body>
</html>
