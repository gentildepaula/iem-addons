#START_BLOCK_TRIGGER#
function ShowTab(T) {
	try{
		if(!document.getElementById("div" + T))
		{
			return false;
		}
	}
	catch(e){}
	for(var i=1;i<50;i++){
		try {
			document.getElementById("div" + i).style.display = "none";
			document.getElementById("tab" + i).className = "";
		} catch (e) {
		}
	}

	document.getElementById("div" + T).style.display = "";
	document.getElementById("tab" + T).className = "active";

	if (typeof onShowTab == 'function') {
		onShowTab(T);
	}
}
#END_BLOCK_TRIGGER#
#START_BLOCK_JQUERY#
<link type="text/css" href="addons/installer/third/jquery-ui/css/smoothness/jquery-ui-1.7.3.custom.css" rel="stylesheet" />
<script type="text/javascript" src="addons/installer/third/jquery-ui/js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="addons/installer/includes/js/js.js"></script>
#END_BLOCK_JQUERY#
