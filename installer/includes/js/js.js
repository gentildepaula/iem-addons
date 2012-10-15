var installer_tmp={modaln:0};
var sending_errors_modal_open=function(url,title,width,height)
{
	installer_tmp.modaln=installer_tmp.modaln+1;
	var act_modal='modaln_'+installer_tmp.modaln;
	var act_iframe='iframemodaln_'+installer_tmp.modaln;
	return $("<div id='"+act_modal+"'><iframe id='"+act_iframe+"' style='width:100%;height:100%;border:0px solid black;' src='"+url+"'></iframe></div>").dialog({
		close: function(event, ui) {$(this).dialog('destroy');$("#"+act_modal).remove();},
		title:title,
		modal:true,
		width: width,
		height: height,
		buttons: {"Close": function() { $(this).dialog("close"); },"Reload": function() 
			{ $('#'+act_iframe).each(function() {
			 this.contentWindow.location.reload(true);
			})
		}}
	}).dialog("open");
};