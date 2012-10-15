{template="css"}					
<table width="100%" cellspacing="0" cellpadding="0" class="DashboardPanel">
				<tr>
					<td class="PanelContent" valign="top" style="height:auto;">
						<div id="GraphPanel">
							<div class="PanelHeaderBox1 IndexPage_GettingStarted_Header" style="padding:0px 0px 10px 5px;">
								<div id="HomeStartTitle"  style="border-bottom:1px solid #eee;">%%LNG_Addon_mta_group_title%%</div>
							</div>
							<div>
								<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
                					<tr class="Heading3">
                						<td width="1%" nowrap="nowrap" style="border-left:1px solid #DDD;"><img src="images/blank.gif" width="10" height="1" /></td>
                						<td width="40%" nowrap="nowrap">%%LNG_Name%%</td>
                						<td width="15%" nowrap="nowrap">%%LNG_Addon_mta_title_rotation%%</td>
                						<td width="10%" nowrap="nowrap">%%LNG_Addon_mta_title_mtas%%</td>
                						<td width="10%" nowrap="nowrap">%%LNG_Addon_mta_title_users%%</td>
                						<td width="24%" nowrap="nowrap" style="border-right:1px solid #DDD;"></td>
                					</tr>
                					{foreach key=key item=item from=$groups}
                					<tr class="GridRow {if ($key % 2)==0}GridRowWhite{else}{/if}">
                						<td nowrap="nowrap"  style="border-left:1px solid #DDD;padding:8px;"><img src="images/m_newsletters.gif" /></td>
                						<td nowrap="nowrap">{$item.name}</td>
                						<td nowrap="nowrap">{$item.rotation}</td>
                						<td nowrap="nowrap">{$item.mtas}</td>
                						<td nowrap="nowrap">{$item.users}</td>
                						<td nowrap="nowrap" style="border-right:1px solid #DDD;">
                						{if $item.uid==0}
                							
                						{else}
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=mta&Action=group&id={$item.uid}">Details</a>
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=mta&Action=add_group&id={$item.uid}">Edit</a>
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=mta&Action=export_group&id={$item.uid}">Export</a>
                							&nbsp;&nbsp;<a style="color:red;" href="index.php?Page=Addons&Addon=mta&Action=delete_group&id={$item.uid}" onclick="return confirm('Are you sure you want to delete this group?');">Delete</a>
                						{/if}
                						</td>
                					</tr>
                					{/foreach}
                				</table>
							</div>
						</div>
					</td>
				</tr>
</table>

