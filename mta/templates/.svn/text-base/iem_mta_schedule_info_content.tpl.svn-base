
<td style="background-color: #fff;
	border-left: 1px solid #EEE;
	border-right: 1px solid #EEE;
	border-bottom:1px solid #CCC;
	line-height: 20px;">
<style>
table.iem_schedule_info
{
	border-collapse:collapse;
}
table.iem_schedule_info tr td
{
	padding-top:1px;
	padding-bottom:1px;
}
table.iem_schedule_info tr.isi_title td
{
	text-align:center;
	background-color:#F9F9F9;
    border-top: 1px solid #DDDDDD;
}
table.iem_schedule_info tr.isi_title_bold td
{
	font-weight:bold;
	font-size:7pt;
}
table.iem_schedule_info tr.isi_value td
{
	background-color:#FFF;
	border-bottom:0px solid #EEE;
	border-left:1px solid #EEE;
	border-right:1px solid #EEE;
	text-align:center;
	font-size:7pt;
	overflow:hidden;
}
table.iem_schedule_infono tr.isi_valueno td
{
	background-color:#EEE;
	text-align:left;
	font-size:7pt;
	border-bottom:0px solid #FFF;
}
</style>


<table style="table-layout:fixed;" class="iem_schedule_info" cellspacing="0" cellpadding="0" width="100%" align="center">
<tr class="isi_title isi_title_bold">
	<td style="width:33%;border-left: 1px solid #DDD;">
	Emails
	</td>
	<td style="width:33%;">
	Success
	</td>
	<td style="width:34%; border-right: 1px solid #DDD;">
	Failure
	</td>
</tr>
<tr class="isi_value">
	<td>
	<span style="color:#666;font-weight:bold;">{$job_details.SendSize}</span>
	</td>
	<td>
	<span style="color:green;">{$job_details.EmailResults.success}</span>
	</td>
	<td>
	<span style="color:red;">
		{if $job_details.EmailResults.failure>0}
		<a style="font-size:7pt;color:red;" href="#" onclick='sending_errors_modal_open("index.php?Page=Addons&Addon=mta&Action=sending_errors&jobid=%%GLOBAL_JobID%%&popup=1","Sending Errors",600,300);return false;'>
			{$job_details.EmailResults.failure}
		</a>
		{else}
			{$job_details.EmailResults.failure}
		{/if}
	</span>
	</td>
</tr>
<tr class="isi_title isi_title_bold">
	<td colspan="3" style="text-align:left;width:33%;border-left: 1px solid #DDD;border-right: 1px solid #DDD;">
	%%LNG_Addon_mta_use_mta%%:
	</td>
</tr>
<tr class="isi_value">
	{if $job_details.mta}
	<td colspan="3" style="text-align:left;border-left:3px solid green;" nowrap="nowrap">
		{foreach key=key item=item from=$job_details.mta.data}
			[%%LNG_Addon_mta_group%% <b>{$item.group.name}</b>, <b>{$item.mtas|count}</b> %%LNG_Addon_mta_accounts%%]<br>
		{/foreach}
	</td>
	{else}
	<td colspan="3" style="text-align:center;" nowrap="nowrap">
		-- %%LNG_Addon_mta_default_application_settings%% --
	</td>
	{/if}
</tr>
<tr class="isi_title isi_title_bold">
	<td colspan="3" style="text-align:left;width:33%;border-left: 1px solid #DDD;border-right: 1px solid #DDD;">
	%%LNG_Addon_mta_title_mail_from%%:
	</td>
</tr>
<tr class="isi_value">
	<td colspan="3" style="text-align:right;" nowrap="nowrap">
	{$job_details.SendFromEmail}
	</td>
</tr>
<tr class="isi_title isi_title_bold">
	<td colspan="3" style="text-align:left;width:33%;border-left: 1px solid #DDD;border-right: 1px solid #DDD;">
	%%LNG_Addon_mta_title_mail_reply%%:
	</td>
</tr>
<tr class="isi_value">
	<td colspan="3" style="text-align:right;" wrap="nowrap">
	{$job_details.ReplyToEmail}
	</td>
</tr>
<tr class="isi_title isi_title_bold">
	<td colspan="3" style="text-align:left;width:33%;border-left: 1px solid #DDD;border-right: 1px solid #DDD;">
	%%LNG_Addon_mta_title_mail_bounce%%:
	</td>
</tr>
<tr class="isi_value">
	<td colspan="3" style="text-align:right;border-bottom:3px solid #DDD;" wrap="nowrap">
	{$job_details.BounceEmail}
	</td>
</tr>
	
</table>

</td>