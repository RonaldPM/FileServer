<form action="upload.php" enctype="multipart/form-data" method="post">
    <input id='upload' name="upload[]" type="file" multiple="multiple" onChange="makeFileList();"/>
    <Br><input type="submit" name="submit" value="Submit">
</form>
<ul id="fileList">
  No Files Selected
</ul>
<script type="text/javascript">
	function makeFileList() {
		var input = document.getElementById("upload");
		var ul = document.getElementById("fileList");
		while (ul.hasChildNodes()) {
			ul.removeChild(ul.firstChild);
		}
		for (var i = 0; i < input.files.length; i++) {
			var li = document.createElement("li");
			li.innerHTML = input.files[i].name;
			ul.appendChild(li);
		}
		if(!ul.hasChildNodes()) {
			var li = document.createElement("li");
			li.innerHTML = 'No Files Selected';
			ul.appendChild(li);
		}
	}
</script>
