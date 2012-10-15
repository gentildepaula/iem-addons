<table width="99%" cellspacing="0" cellpadding="0" class="DashboardPanel" style="background-color:#FFF;">
<tr>
	<td class="PanelContent" valign="top" style="height:auto;">
		<div style="max-height:500px;overflow:auto;">
		{if count($mtas.groups)==0}
		%%LNG_SmtpDefaultSettings%%
		{else}
			<table border="0" cellspacing="0" cellpadding="5" width="100%" class="Text GroupMtas" id="SubscriberListManageList" style="background-color:#FFF;">
			
			<tr class="GridRowWhite">
					<td style="width:4%;">
					</td>
					<td style="width:1%;border-left:1px solid #DDD;border-top:1px solid #EEE;">
					<input onchange="enable_mtas_checkbox(this,'iem_send_mta_row');return false;" type="checkbox" name="nomta" value="0" checked="checked">
					</td>
					<td style="width:95%;border-right:1px solid #DDD;border-top:1px solid #EEE;" colspan="4">
						<b>%%LNG_SmtpDefaultSettings%%</b>
					</td>
			</tr>
			<tr class="GridRow iem_send_mta_row">
				<td style="border-left:1px solid #DDD;border-right:1px solid #DDD;border-top:1px solid #DDD;" colspan="6">
				%%LNG_Addon_mta_group_title%%
				&nbsp;
				&nbsp;|
				&nbsp;
				<input disabled="disabled" type="checkbox" name="mta_mail_from" vakue="1"> %%LNG_Addon_mta_title_use_mail_from%%
				&nbsp;
				<input disabled="disabled" type="checkbox" name="mta_mail_reply" vakue="1"> %%LNG_Addon_mta_title_use_mail_reply%%
				&nbsp;
				<input disabled="disabled" type="checkbox" name="mta_mail_bounce" vakue="1"> %%LNG_Addon_mta_title_use_mail_bounce%%
				</td>
			</tr>
			{foreach from=$mtas.groups item=item key=key}
				<tr class="GridRowWhite iem_send_mta_row">
					<td style="width:4%;">
					</td>
					<td style="width:1%;border-left:1px solid #DDD;border-bottom:1px solid #EEE;">
					<input disabled="disabled" class="iem_send_campaign_group_{$item.uid}_master" onchange="iem_sh_gmtas_plus(this,'iem_send_campaign_group_{$item.uid}','{$item.uid}');return false;" type="checkbox" name="mta[]" value="g_{$item.uid}">
					</td>
					<td colspan="4" style="width:95%;border-right:1px solid #DDD;border-bottom:1px solid #EEE;">
						<a href="#" onclick="iem_sh_gmtas(this,'iem_send_campaign_group_{$item.uid}','{$item.uid}');return false;"><img src="images/plus.gif" /></a>&nbsp;&nbsp;
                		{$item.name} ({$item.mtas} Accounts)
					</td>
				</tr>
				{foreach item=_item key=_key from=$item.mtas_data}
					<tr class="iem_send_campaign_group_{$item.uid} iem_send_mta_row" style="display:none;">
						<td style="width:4%;" colspan="2">
						</td>
						<td style="width:21%;border-left:1px solid #DDD;border-bottom:1px solid #EEE;">
								<input disabled="disabled"  onchange="iem_sh_gmtas_master(this,'iem_send_campaign_group_{$item.uid}_master');return false;" type="checkbox" name="mta[]" value="s_{$_item.uid}">&nbsp;&nbsp;{$_item.name}
								<div></div>
						</td>
						<td style="width:15%;border-left:1px solid #DDD;border-right:1px solid #DDD;border-bottom:1px solid #EEE;">
							%%LNG_Hostname%%: <span style="color:#666;">{$_item.hostname}</span>  
						</td>
						<td style="width:15%;border-left:1px solid #DDD;border-right:1px solid #DDD;border-bottom:1px solid #EEE;">
							%%LNG_Addon_mta_title_reputation%%: <span style="color:#666;">
							{if $_item.reputation==0}
								N/A
							{else}
								{$_item.reputation}
							{/if}
							</span>
						</td>
						<td style="width:45%;border-left:1px solid #DDD;border-right:1px solid #DDD;border-bottom:1px solid #EEE;" class="iem_detail_hover iem_send_campaign_blacklist_tooltip">
							Sent: <span style="color:green;">{$_item.sent}</span>, Failed: <span style="color:red;">{$_item.failed}</span>
						</td>
					</tr>
				{/foreach}
			{/foreach}
			</table>
			<br>
			{/if}
		</div>
	</td>
</tr>
</table>