<script type="text/javascript" src="addons/mta/third/highcharts/js/highcharts.js"></script>
<script type="text/javascript" src="addons/mta/third/highcharts/js/modules/exporting.js"></script>
<script type="text/javascript" src="addons/mta/third/jquery.tooltip/jquery.tooltip.js"></script>
<link rel="stylesheet" href="addons/mta/third/jquery.tooltip/jquery.tooltip.css" type="text/css"/>
  
<script type="text/javascript">
$(function(){
	$("a.tooltipblacklist").tooltip({
		delay:0,
	    bodyHandler: function() {
	        return $(this).next().html();
	    }, 
	    showURL: false 
	});
});
var loaded_mta_stat=[];
var mta_group_details = function(el, sid, mta_uid)
{
	var displayed=$("#" + sid).css("display");
	if(displayed=="none")
	{
		load_mta_stat(mta_uid);
		$("#" + sid).fadeIn(function(){
			$("img",el).attr("src","images/minus.gif")
		});
	}
	else
	{
		$("#" + sid).fadeOut(function(){
			$("img",el).attr("src","images/plus.gif")
		});
	}
	
}
var mta_details_do = function(what,mta,data)
{
	if(what=="test")
	{
		console_put(mta,"[mta-test] Testing...");
		var data = $.extend({'do':"mta_test"},make_form_to_object('#mail_test_'+mta));
		$.post('index.php?Page=Addons&Addon=mta&Action=ajax&ajax=1',data, function(response) {
			var r = $.evalJSON(response);
			console_put(mta,"[mta-test] "+r.msg);
		});
		//console.info(data);
	}
	else if(what=="save")
	{
		console_put(mta,"[mta-modify] Saving...");
		var data = $.extend({'do':"mta_modify"},make_form_to_object('#mail_test_'+mta));
		$.post('index.php?Page=Addons&Addon=mta&Action=ajax&ajax=1',data, function(response) {
			var r = $.evalJSON(response);
			console_put(mta,"[mta-modify] "+r.msg);
		});
	}
	else if(what=="savefield")
	{
		console_put(mta,"[mta-modify] Saving...");
		var data = $.extend({'do':"mta_modify","uid":mta},data);
		$.post('index.php?Page=Addons&Addon=mta&Action=ajax&ajax=1',data, function(response) {
			var r = $.evalJSON(response);
			console_put(mta,"[mta-modify] "+r.msg);
		});
	}
}
var mta_modify_do_lock={};
var mta_modify_do = function(field,mta,el)
{
	if(mta_modify_do_lock['mta'+mta]==true)
	{
		return false;
	}
	mta_modify_do_lock['mta'+mta]=true;
	$("#span_"+mta+"_"+field).css("display","none");
	$("#input_"+mta+"_"+field).css("display","").focus();
}
var mta_modify_do_blur = function(field,mta,el)
{
	var t = $("#input_"+mta+"_"+field).val();
	var data = {};
	data[field]=t;
	if($("#span_"+mta+"_"+field).text()!=t)
	{
		mta_details_do("savefield",mta,data);
	}
	$("#span_"+mta+"_"+field).html(t);
	$("#input_"+mta+"_"+field).css("display","none");
	$("#span_"+mta+"_"+field).css("display","");
	mta_modify_do_lock['mta'+mta]=false;
}
var mta_keypress = function(e,field,mta,el) {
	var tecla = (document.all) ? e.keyCode : e.which;
	if (tecla==13){
		mta_modify_do_blur(field,mta,el);
	}
}
var console_put = function(id,value)
{
	var ov = $("#console_"+id).val();
	var a = new Date();
	var h = a.getHours();
	h = (h<10)?"0"+h:h;
	var m = a. getMinutes();
	m = (m<10)?"0"+m:m;
	var s = a.getSeconds();
	s = (s<10)?"0"+s:s;
	$("#console_"+id).val(h+":"+m+":"+s+" "+value+"\n\n"+ov);
}
var make_form_to_object = function(form)
{
	var data = $(form).serializeArray();
	var datapost={};
	jQuery.each(data, function(i, field){
        datapost[field.name]=field.value;
     });
    return datapost;
}
var load_mta_stat = function(uid)
{
	$.post('index.php?Page=Addons&Addon=mta&Action=ajax&ajax=1',{'do':"mta_stat",mta:uid}, function(response) {
		  var data = $.evalJSON(response);
		  draw_chart_ssb(data,uid);
		  draw_chart_rb(data,uid);
	});
}
var draw_chart_rb = function(data,mta)
{
	var mta_info_reputation = new Highcharts.Chart({
		exporting:{enabled:false},
		chart: {
			renderTo: 'mta_info_reputation_'+mta,
			defaultSeriesType: 'spline'
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'MTA Reputation',
			x: -20 //center
		},
		subtitle: {
			text: 'Showing last '+data['reputation'].length+' days',
			x: -20
		},
		plotOptions: {
            series: {
                marker: {
                    radius: 3
                }
            }
        },
		xAxis: {
			categories: data['time'],
			tickWidth: 10,
			gridLineColor:"#EEE",
			gridLineWidth: 1,
			labels: {
				align: 'left',
				x: 3,
				y: -3
			},
			labels: {
				style: {
					color: '#000',
					fontWeight: 'normal',
					font: '7pt Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
				}
			}
		},
		yAxis: {
			gridLineColor:"#EEE",
			title: false,
			plotLines: [{
				value: 0,
				width: 1,
				color: '#C0D0E0'
			}]
		},
		tooltip: {
			borderRadius:2,
			borderWidth:1,
	        crosshairs: true,
	        shared:true,
			kformatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +': '+ this.y +' ';
			}
		},
		legend: {
			backgroundColor: '#FFFFFF',
			shadow:true
		},
		series: [{
			name: 'Reputation',
			data: data['reputation']
		}, {
			name: 'Blacklist',
			data: data['blacklist']
		}, {
			name: 'WhiteList',
			data: data['whitelist']
		},
		{
			name: 'Volume',
			data: data['reputation_volume']
		},{
			name: 'Complaints',
			data: data['reputation_complaint']
		},{
			name: 'Unknown Users',
			data: data['reputation_unknown']
		},{
			name: 'Filtered',
			data: data['reputation_filtered']
		}
		]
	});
}
var draw_chart_ssb = function(data,mta)
{
	var chart_mta_info = new Highcharts.Chart({
		exporting:{enabled:false},
		chart: {
			renderTo: 'mta_info_chart_'+mta,
			defaultSeriesType: 'line'
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'MTA Statistics',
			x: -20 //center
		},
		subtitle: {
			text: 'Showing last '+data['sent'].length+' days',
			x: -20
		},
		xAxis: {
			categories: data['time'],
			tickWidth: 10,
			gridLineColor:"#EEE",
			gridLineWidth: 1,
			//gridLineDashStyle:"dash",
			labels: {
				align: 'left',
				x: 3,
				y: -3
			},
			labels: {
				style: {
					color: '#000',
					fontWeight: 'normal',
					font: '7pt Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
				}
			}
		},
		yAxis: {
			gridLineColor:"#EEE",
			//gridLineDashStyle:"dash",
			title: {
				text: 'Emails'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#C0D0E0'
			}]
		},
		tooltip: {
			borderRadius:2,
			borderWidth:1,
	        crosshairs: true,
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +': '+ this.y +' Emails';
			}
		},
		legend: {
			backgroundColor: '#FFFFFF',
			shadow:true
		},
		series: [{
			name: 'Bounced',
			data: data['bounced']
		}, {
			name: 'Failed',
			data: data['failed']
		}, {
			name: 'Success',
			data: data['sent']
		}
		]
	});
};
</script>