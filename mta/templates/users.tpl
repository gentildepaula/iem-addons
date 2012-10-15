<table width="100%" cellspacing="0" cellpadding="0" class="DashboardPanel">
				<tr>
					<td class="PanelContent" valign="top" style="height:auto;">
						<div id="GraphPanel">
							<div class="PanelHeaderBox1 IndexPage_GettingStarted_Header" style="padding:0px 0px 10px 5px;">
								<div id="HomeStartTitle"  style="border-bottom:1px solid #eee;">%%LNG_Users%%</div>
							</div>
							<div>
<form name="frmListEditor" id="frmListEditor" method="post" action="index.php?Page=Addons&Addon=mta&Action=process">
<input type="hidden" name="do" value="group_assign_user"/>
<input type="hidden" name="data[group_uid]" value="{$group.mta_group_uid}"/>
<table border="0" cellspacing="0" cellpadding="5" width="100%" class="Text GroupMtas" id="SubscriberListManageList">
{foreach item=item key=key from=$usergroups}
<tr class="GridRow">
	<td style="border-left:1px solid #DDD;border-right:1px solid #DDD;border-top:1px solid #DDD;" colspan="3">
	{$item.groupname}
	</td>
	{foreach item=itemu ke=keyu from=$item.users}
	<tr class="GridRow GridRowWhite">
		<td style="width:4%;">
		</td>
		<td style="width:1%;border-left:1px solid #DDD;">
		<input {if $itemu.mta_user_in_group==1}checked="checked"{else}{/if} type="checkbox" name="data[users][]" value="{$itemu.userid}">
		</td>
		<td style="width:95%;border-right:1px solid #DDD;">
			{$itemu.username}
		</td>
	</tr>
	{/foreach}
</tr>
{/foreach}
</table>
<br>
<input class="FormButton SubmitButton" type="submit" value="%%LNG_Save%%" />
</form>
							</div>
						</div>
					</td>
				</tr>
</table>