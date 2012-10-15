<table width="100%" cellspacing="0" cellpadding="0" class="DashboardPanel">
				<tr>
					<td class="PanelContent" valign="top" style="height:auto;">
						<div id="GraphPanel">
							<div class="PanelHeaderBox1 IndexPage_GettingStarted_Header" style="padding:0px 0px 10px 5px;">
								<div id="HomeStartTitle"  style="border-bottom:1px solid #eee;">%%LNG_Addon_mta_bulk_add%%</div>
							</div>
							<div>
<form name="frmListEditor" id="frmListEditor" method="post" action="index.php?Page=Addons&Addon=mta&Action=add_mta_bulk">
{if $groups}
Group:
<select name="mta_group_uid">
{foreach key=key item=item from=$groups}
<option {if $item.uid==0}selected="selected"{else}{/if} value="{$item.uid}">{$item.name}</option>
{/foreach}
</select>
<br>
{else}
<input type="hidden" name="mta_group_uid" value="{$group.mta_group_uid}">
{/if}
<textarea name="bulk" style="width:100%;height:170px;border:1px solid #CCC;overflow:scroll;">
</textarea>
<br>
Format:
<br>
<pre>
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
</pre>
<br>
<input class="FormButton SubmitButton" type="submit" value="%%LNG_Save%%" />
<input type="submit" name="test_smtp" value="%%LNG_TestSMTPSettings%%" class="FormButton" style="width: 120px;" />
</form>
							</div>
						</div>
					</td>
				</tr>
</table>