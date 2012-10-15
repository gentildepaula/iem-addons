<script type="text/javascript" src="addons/mta/third/jquery.tooltip/jquery.tooltip.js"></script>
<link rel="stylesheet" href="addons/mta/third/jquery.tooltip/jquery.tooltip.css" type="text/css"/>
  
<script type="text/javascript">
$(function(){
	$(".iem_send_campaign_blacklist_tooltip").tooltip({
		delay:0,
	    bodyHandler: function() {
	        return $("div",$(this)).html();
	    }, 
	    showURL: false 
	});
	$(".iem_detail_hover").hover(
			   function()
			   {
			    $(this).addClass("iem_detail_hl");
			   },
			   function()
			   {
			    $(this).removeClass("iem_detail_hl");
			   }
	)
});
var iem_sh_gmtas = function(el, sid, mta_uid)
{
	var displayed=$("." + sid).css("display");
	if(displayed=="none")
	{
		$("." + sid).fadeIn(function(){
			$("img",el).attr("src","images/minus.gif")
		});
	}
	else
	{
		$("." + sid).fadeOut(function(){
			$("img",el).attr("src","images/plus.gif")
		});
	}
};
var iem_sh_gmtas_plus = function(el, sid, mta_uid)
{
	var checked=$(el).is(":checked");
	if(checked)
	{
		$("."+sid+" input").attr("checked","checked");
	}
	else
	{
		$("."+sid+" input").attr("checked","");
	}
};
var enable_mtas_checkbox = function(el,where)
{
	var checked=$(el).is(":checked");
	if(checked)
	{
		$("."+where+" input:checkbox").attr("disabled","disabled");
	}
	else
	{
		$("."+where+" input:checkbox").attr("disabled","");
	}
}
var iem_sh_gmtas_master = function(el, sid)
{
	var checked_slave=$(el).is(":checked");
	var checked=$("."+sid).is(":checked");
	if(checked)
	{
		
	}
	else
	{
		$("."+sid).attr("checked","checked");
	}
};
</script>