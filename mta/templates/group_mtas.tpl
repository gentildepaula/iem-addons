<table width="100%" cellspacing="0" cellpadding="0" class="DashboardPanel">
				<tr>
					<td class="PanelContent" valign="top" style="height:auto;">
						<div id="GraphPanel">
							<div class="PanelHeaderBox1 IndexPage_GettingStarted_Header" style="padding:0px 0px 10px 5px;">
								<div id="HomeStartTitle"  style="border-bottom:1px solid #eee;">%%LNG_Addon_mta_accounts%%</div>
							</div>
							<div>
							{if count($mtas)==0}
							%%LNG_Addon_mta_you_dont_have_mta_on_this_group%%
							{else}
								<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text GroupMtas" id="SubscriberListManageList">
									<tbody>
                					<tr class="Heading3 Heading3Center">
                					    <td width="1%" nowrap="nowrap"><img src="images/blank.gif" width="10" height="1" /></td>
                						<td width="1%" nowrap="nowrap"><img src="images/blank.gif" width="10" height="1" /></td>
                						<td width="15%" nowrap="nowrap">%%LNG_Name%%</td>
                						<td width="15%" nowrap="nowrap">%%LNG_Hostname%%</td>
                						<td width="15%" nowrap="nowrap">%%LNG_Username%%</td>
                						<td width="10%" nowrap="nowrap">%%LNG_Password%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Port%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Addon_mta_title_sent%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Addon_mta_title_bounced%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Addon_mta_title_failed%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Addon_mta_title_reputation%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Addon_mta_title_blacklist%%</td>
                						<td width="5%" nowrap="nowrap">%%LNG_Addon_mta_title_status%%</td>
                						<td width="18%" nowrap="nowrap"></td>
                					</tr>
                					</tbody>
                					{foreach key=key item=item from=$mtas}
                					<tbody>
                					<tr class="GridRow {if ($key % 2)==0}GridRowWhite{else}{/if}">
                						<td nowrap="nowrap" style="border-left:1px solid #DDD;"><input type="checkbox" name="mass_mta[]" value="{$item.uid}"></td>
                						<td nowrap="nowrap" style="border-left:1px solid #DDD;"><img src="images/m_newsletters.gif" /></td>
                						<td nowrap="nowrap">
                							<a href="#" onclick="mta_group_details(this,'mta_group_details_{$item.uid}','{$item.uid}');return false;"><img src="images/plus.gif" /></a>&nbsp;&nbsp;{$item.name}
                						</td>
                						<td nowrap="nowrap" class="mgs1" ondblclick="mta_modify_do('hostname',{$item.uid},this);return false;">
                							<span id="span_{$item.uid}_hostname">{$item.hostname}</span>
                							<input onkeypress="mta_keypress(event,'hostname',{$item.uid},this);" onblur="mta_modify_do_blur('hostname',{$item.uid},this);" style="display:none;" id="input_{$item.uid}_hostname" class="form_text hideinputajax" type="text" value="{$item.hostname}">
                						</td>
                						<td nowrap="nowrap" class="mgs1" ondblclick="mta_modify_do('username',{$item.uid},this);return false;">
                							<span id="span_{$item.uid}_username">{$item.username}</span>
                							<input onkeypress="mta_keypress(event,'username',{$item.uid},this);" onblur="mta_modify_do_blur('username',{$item.uid},this);" style="display:none;" id="input_{$item.uid}_username" class="form_text hideinputajax" type="text" value="{$item.username}">
                						</td>
                						<td nowrap="nowrap" class="mgs1" ondblclick="mta_modify_do('password',{$item.uid},this);return false;">
                							<span id="span_{$item.uid}_password">{$item.password}</span>
                							<input onkeypress="mta_keypress(event,'password',{$item.uid},this);" onblur="mta_modify_do_blur('password',{$item.uid},this);" style="display:none;" id="input_{$item.uid}_password" class="form_text hideinputajax" type="text" value="{$item.password}">
                						</td>
                						<td nowrap="nowrap" class="mgs1" ondblclick="mta_modify_do('port',{$item.uid},this);return false;">
                							<span id="span_{$item.uid}_port">{$item.port}</span>
                							<input onkeypress="mta_keypress(event,'port',{$item.uid},this);" onblur="mta_modify_do_blur('port',{$item.uid},this);" style="display:none;" id="input_{$item.uid}_port" class="form_text hideinputajax" type="text" value="{$item.port}">
                						</td>
                						<td nowrap="nowrap" class="mgs1" style="color:green;">{$item.sent}</td>
                						<td nowrap="nowrap" class="mgs1" style="{if $item.bounced>0}color:#006699;{else}color:#666;{/if}">{$item.bounced}</td>
                						<td nowrap="nowrap" class="mgs1" style="{if $item.failed>0}color:orange;{else}color:#666;{/if}">{$item.failed}</td>
                						<td nowrap="nowrap" class="mgs1" style="border-left:5px solid {if $item.reputation==0}gray{elseif $item.reputation>80}green;{else}#ED8484{/if};color:black;border-bottom:0px solid #FFF;">{$item.reputation}</td>
                						<td nowrap="nowrap" class="mgs1" style="{if $item.blacklist>0}color:red;{else}{/if}">
                						{if $item.blacklist>0}
                							<a alt="mnmnmn" class="tooltipblacklist" style="color:red;" href="#" onclick="tb_show('', 'index.php?Page=Addons&Addon=mta&Action=ajax&do=mta_blacklist&id={$item.uid}&Ajax=1&keepThis=true&height=400&width=600&modal=true', '');return false;">
                								{$item.blacklist}
                							</a>
                							<div style="display:none">
                							{if count($item.blacklist_data)==0}
                								There is no new data for current Date. Try again in few minutes.
                							{else}
	                							{foreach key=bkey item=bitem from=$item.blacklist_data}
	                								{$bitem.name} (<span style="color:#666;">{$bitem.url}</span>)<br>
	                							{/foreach}
                							{/if}
                							</div>
                						{else}
                							{$item.blacklist}
                						{/if}
                						</td>
                						<td nowrap="nowrap" class="mgs2">
                						{if $item.status==1}
                						<span style="color:green;font-weight:bold;">ACTIVE</span>
                						{elseif $item.status==2}
                						<span style="color:gray;font-weight:bold;">INACTIVE</span>
                						{elseif $item.status==0}
                						<span style="color:red;font-weight:bold;">ERROR</span>
                						{else}
                						N/A
                						{/if}
                						</td>
                						<td nowrap="nowrap" class="mgs1" style="border-right:1px solid #DDD;">
                						{if $item.uid==0}
                							
             
                						{else}
                							<!-- &nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=mta&Action=group&id={$item.uid}">View</a>-->
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=mta&Action=add_mta&group_id={$group.mta_group_uid}&id={$item.uid}">%%LNG_edit%%</a>
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=mta&Action=delete_mta&group_id={$group.mta_group_uid}&id={$item.uid}" onclick="return confirm('%%LNG_Addon_mta_sure_delete_mta%%');">%%LNG_delete%%</a>
                						{/if}
                						</td>
                					</tr>
                					</tbody>
                					<tbody id="mta_group_details_{$item.uid}" style="display:none;">
                					<tr>
                						<td style="border-bottom:1px solid #EDECEC;{if ($gcmtas-1)==$key}border-bottom:0px solid #FFF;{else}{/if}">
                						</td>
                						<td colspan="13" style="padding:0px;border-right:1px solid #DDD;border-left:1px solid #DDD;">
	                						{template="group_mtas_details"}
                						</td>
                					</tr>
                					</tbody>
                					{/foreach}
                				</table>
                				<div style="padding:10px;padding-right:0px;text-align:right;">
                					<a href="index.php?Page=Addons&Addon=mta&Action=export_group&id={$group.mta_group_uid}"><img alt="Export" src="images/contacts_export.gif"></a>
                				</div>
                			{/if}
							</div>
						</div>
					</td>
				</tr>
</table>