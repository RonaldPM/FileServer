
	function makeFileList() {
		var input = document.getElementById("upload");
		var ul = document.getElementById("fileList");
		while (ul.hasChildNodes()) {
			ul.removeChild(ul.firstChild);
		}
		var count=0;
		for (var i = 0; i < input.files.length; i++) {
			var li = document.createElement("li");
			li.innerHTML = input.files[i].name;
			ul.appendChild(li);
			count+=1;
		}
		if(!ul.hasChildNodes()) {
			var li = document.createElement("li");
			li.innerHTML = 'No Files Selected';
			ul.appendChild(li);
		}
		document.uploadForm.inputBox.value=(count+" files selected");
		count=0;
	}

function showuploadBox(){
	document.getElementById('inContainer').className="inContainer_later shadow";
	document.getElementById('body').style.background="#e0e0e0";
	document.getElementById('lcarte').style.display="block";
	document.getElementById('uploadLaunchButton').style.opacity="0";
}

function hideuploadBox(){
	document.getElementById('inContainer').className="inContainer";
	document.getElementById('body').style.background="#fff";
	document.getElementById('lcarte').style.display="none";
	document.getElementById('uploadLaunchButton').style.opacity="1";
}

function showstartnewBox(){
	document.getElementById('instartContainer').className="inContainer_later shadow";
	document.getElementById('body').style.background="#e0e0e0";
	document.getElementById('lcartestart').style.display="block";
	document.getElementById('startnewLaunchButton').style.opacity="0";
	document.getElementById('asd').focus();
}

function hidestartnewBox(){
	document.getElementById('instartContainer').className="inContainer";
	document.getElementById('body').style.background="#fff";
	document.getElementById('lcartestart').style.display="none";
	document.getElementById('startnewLaunchButton').style.opacity="1";
}

function clickOnBrowse(){
	document.getElementById('upload').click();
}

function switchChange(){
	var loc=document.getElementById('headDivToggleValue');
	if(loc.value=='1'){
		document.getElementById('headDiv').className+=" head_later";
		loc.value="0";
	}
	else{
		document.getElementById('headDiv').className="head shadowLight";
		loc.value="1";
	}
}
