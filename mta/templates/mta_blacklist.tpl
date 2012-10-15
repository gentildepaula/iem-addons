<style>
#TB_ajaxContent.TB_modal {
    padding: 15px;
}
</style>
<div style="border:1px solid #EEE;margin-right:28px;padding:5px;">
	<div style="text-align:right;">
		<a href="#" onclick="tb_remove();return false;">%%LNG_PopupCloseWindow%%</a>
	</div>
	<div>
	</div>
</div>
<div style="border:0px solid #EEE;margin-right:28px;padding:5px;margin-top:2px;">
Blacklist Details for: <b>{$mta.data.hostname}</b>
<table border="0" cellspacing="0" cellpadding="5" class="Text" id="SubscriberListManageList" style="width:99%; margin-top: 7px;">
    					<tr>
    						<td  style="width:40%;text-align:center;border-bottom:2px solid #CCC;">
    							<b>DNSBL</b>
    						</td>
    						<td  style="width:30%;text-align:center;border-bottom:2px solid #CCC;">
    							<b>QUERY</b>
    						</td>
    						<td  style="width:30%;text-align:center;border-bottom:2px solid #CCC;">
    							<b>URL</b>
    						</td>
    					</tr>
    					{foreach key=key item=item from=$dnsbl}
    					<tr class="GridRow">
    						<td>{$item.name}</td>
							<td>{$item.dns}</td>
							<td><a target="_blank" href="{$item.url}">{$item.url}</a></td>
    					</tr>
    					{/foreach}
</table>
</div>