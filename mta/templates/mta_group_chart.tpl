<table width="100%" cellspacing="0" cellpadding="0" class="DashboardPanel">
				<tr>
					<td class="PanelContent" valign="top" style="height:auto;">
						<div id="GraphPanel">
							<div class="PanelHeaderBox1 IndexPage_GettingStarted_Header" style="padding:0px 0px 10px 5px;">
								<div id="HomeStartTitle"  style="border-bottom:1px solid #eee;">%%LNG_Addon_mta_title_mtas_statistics%%</div>
							</div>
							<div id="mta_group_chart">
							</div>
						</div>
					</td>
				</tr>
</table>
		<script type="text/javascript">
var chart;
var data_json= {$data_json};
var data_mta_names=[];
var data_mta_sent=[];
var data_mta_failed=[];
var data_mta_bounced=[];
for(i in data_json)
{
	data_mta_names.push(data_json[i].name);
	data_mta_sent.push(data_json[i].sent);
	data_mta_failed.push(data_json[i].failed);
	data_mta_bounced.push(data_json[i].bounced);
}
$(document).ready(function() {
	chart = new Highcharts.Chart({
		colors: ["#7C9BC9", "#FFA500", "#80AA1E", "#ED9704", "#ff0066", "#eeaaee","#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
		exporting:{enabled:false},
		chart: {
			renderTo: 'mta_group_chart',
			defaultSeriesType: 'bar'
		},
		plotOptions: {
	        series: {
	            borderWidth: 0,
	            borderColor: 'black'
	        }
	    },
		title: {
			text: false
		},
		subtitle: {
			//text: 'Source: Wikipedia.org'
		},
		xAxis: {
			gridLineColor:"#EEE",
			gridLineWidth: 1,
			categories: data_mta_names,
			title: {
				text: false
			},
			labels: {
				style: {
					color: '#666',
					fontWeight: 'normal',
					font: '8pt Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
				}
			}
		},
		yAxis: {
			tickWidth: 0,
			gridLineColor:"#EEE",
			gridLineWidth: 1,
			min: 0,
			title: {
				text: 'Emails'
			},
			labels: {
				style: {
					color: '#000',
					fontWeight: 'normal',
					font: '7pt Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
				}
			}
		},
		tooltip: {
			formatter: function() {
				return ''+
					this.series.name +': '+ this.y +' Emails';
			}
		},
		plotOptions: {
			series: {
				stacking: 'normal'
			}
		},
		legend: {
			backgroundColor: '#FFFFFF',
			shadow:true,
			reversed: true
		},
		credits: {
			enabled: false
		},
		series: [
		
		{
			name: 'Bounced',
			data: data_mta_bounced
		},
		{
			name: 'Failed',
			data: data_mta_failed
		},
		{
			name: 'Success',
			data: data_mta_sent
		}
		]
	});
});

		</script>