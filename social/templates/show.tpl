<div style=" margin-right: 25px;">
	<div style="text-align:right;padding:5px;">
		<a href="#" onclick="tb_remove();return false;">%%LNG_PopupCloseWindow%%</a>
	</div>
	<div id="details" style="margin-top:10px;">
	<div style="text-align:left;padding:5px;">
		{$title_show}
	</div>
			<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
					<tr class="Heading3">
						<td width="1%" nowrap="nowrap"><img src="images/blank.gif" width="44" height="1" /></td>
						<td width="40%" nowrap="nowrap">
							%%LNG_EmailAddress%%
						</td>
						<td width="60%" nowrap="nowrap">
							%%LNG_Addon_social_share_time%%
						</td>
					</tr>
					{foreach key=key item=item from=$emails}
					<tr class="GridRow">
						<td style="text-align:right;"><img src="images/user.gif" /></td>
						<td nowrap="nowrap" style="padding:5px;" class="">
							&nbsp;{$item.emailaddress}
						</td>
						<td nowrap="nowrap" style="padding:5px;background-color:#FFF;">
							{$item.date}
						</td>
					</tr>
					{/foreach}
				</table>
				<br><br><br>
		</div>
	</div>
</div>