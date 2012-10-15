<style>
table.backupmain {
	
}
table.backupmain td{
	padding:5px;
}
table.backup1 {
	border:1px solid #E0ECFF;
}

table.backup1 td.b1 {
	text-align: right;
	vertical-align: top;
	width:25%;
}

table.backup1 td.b2 {
	border-left: 3px solid #E0ECFF;
	width:75%;
}
.bb_2
{
	background-color:#DDF4D0;
}
.bb_3
{
	background-color:#EEE;
}
.bb_4
{
	background-color:#FFCCAD;
}
.bb_5
{
	background-color:#EFDBFF;
}
.tooltip_body
{
    background-repeat: no-repeat;
    font-weight: bold;
    padding: 2px 4px 4px 23px;
}
</style>
<table cellspacing="0" cellpadding="5" align="center" width="100%">
	<tr>
		<td class="Heading1">Backup System</td>
	</tr>
	<tr>
		<td>{template="message"}</td>
	</tr>
	<tr>
		<td class="body">
		<table align="center" border="0" cellspacing="0" cellpadding="0" width="1100" class="backupmain">
			<tr>
				<td style="width: 50%; vertical-align: top;">
				<div class="toolTipBox">
					<div class="tooltip_body" style="background-image: url(images/mnu_contact_button.gif);">
						Subscribers
					</div>	
				</div>
				<form method="POST"
					action="index.php?Page=Addons&Addon=backup&Action=export&Ajax=1">
				<input type="hidden" name="type" value="subscribers" />
				<table border="0" cellspacing="0" cellpadding="5" width="100%"
					class="backup1">
					<tr>
						<td class="b1">Users:</td>
						<td class="b2"><select name="users[]" multiple="multiple"
							style="height: 150px; width: 100%;">
							{foreach from=$users item=item}
							<option value="{$item.user.userid}" selected="selected">{$item.user.username}
							- ({$item.info.subscribers_f} active contacts)</option>
							{/foreach}
						</select></td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Active:</td>
						<td><input type="checkbox" name="active"></td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Openners:</td>
						<td><input type="checkbox" name="openners" checked="checked">
						&nbsp;
						<select name="o_u" style="width:100px;">
							<option value="all">All</option>
							<option value="unique">Unique</option>
						</select>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Clickers:</td>
						<td><input type="checkbox" name="clickers" checked="checked">
						&nbsp;
						<select name="c_u" style="width:100px;">
							<option value="all">All</option>
							<option value="unique">Unique</option>
						</select>
						</td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Unsubscribed:</td>
						<td><input type="checkbox" name="unsubscribed" checked="checked"></td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">&nbsp;</td>
						<td><br>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="save"
							value="%%LNG_Addon_backup_export%%"></td>
					</tr>
				</table>
				</form>
				</td>
				<td style="width: 50%; vertical-align: top;">
				<div class="toolTipBox bb_2">
					<div class="tooltip_body" style="background-image: url(images/mnu_contactlist_button.gif);">
						Contact Lists
					</div>	
				</div>
				<form method="POST"
					action="index.php?Page=Addons&Addon=backup&Action=export&Ajax=1">
				<input type="hidden" name="type" value="lists" />
				<table border="0" cellspacing="0" cellpadding="5" width="100%"
					class="backup1">
					<tr>
						<td class="b1">Users:</td>
						<td class="b2"><select name="list[]" multiple="multiple"
							style="height: 150px; width: 100%;">
							{foreach from=$users_lists item=item}
							<optgroup label="{$item.user.username}">
								{foreach from=$item.lists item=litem}
								<option value="{$litem.listid}">{$litem.name} -
								({$litem.subscribecount_f} active contacts)</option>
								{/foreach}
							</optgroup>
							{/foreach}
						</select></td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Active:</td>
						<td><input type="checkbox" name="active"></td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Unsubscribed:</td>
						<td><input type="checkbox" name="unsubscribed"></td>
					</tr>
					<tr>
						<td style="text-align: right; vertical-align: top;">Custom
						Fields:</td>
						<td><input type="checkbox" name="custom"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="save"
							value="%%LNG_Addon_backup_export%%"></td>
					</tr>
				</table>
			</form>
			
				
				</td>
			</tr>




			<tr>
				<td style="vertical-align: top;">
				<div class="toolTipBox bb_3">
					<div class="tooltip_body" style="background-image: url(images/mnu_newsletter_button.gif);">
						Email Campaigns
					</div>	
				</div>
				<form method="POST"
					action="index.php?Page=Addons&Addon=backup&Action=export&Ajax=1">
				<input type="hidden" name="type" value="campaigns" />
				<table border="0" cellspacing="0" cellpadding="5" width="100%"
					class="backup1">
					<tr>
						<td class="b1">Users:</td>
						<td class="b2"><select name="campaigns[]"
							multiple="multiple" style="height: 150px; width: 100%;">
							{foreach from=$users_campaigns item=item}
							<optgroup label="{$item.user.username}">
								{foreach from=$item.campaigns item=litem}
								<option value="{$litem.newsletterid}">{$litem.name} (
								{$litem.subject} )</option>
								{/foreach}
							</optgroup>
							{/foreach}
						</select></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="save"
							value="%%LNG_Addon_backup_export%%"></td>
					</tr>
				</table>
				</form>
				</td>
				<td style="width: 50%; vertical-align: top;">
    				<div class="toolTipBox bb_5">
    					<div class="tooltip_body" style="background-image: url(images/mnu_newsletter_button.gif);">
    						Forms
    					</div>	
    				</div>
    				<form method="POST"
    					action="index.php?Page=Addons&Addon=backup&Action=export&Ajax=1">
    				<input type="hidden" name="type" value="forms" />
    				<table border="0" cellspacing="0" cellpadding="5" width="100%"
    					class="backup1">
    					<tr>
    						<td class="b1">Users:</td>
    						<td class="b2"><select name="forms[]"
    							multiple="multiple" style="height: 150px; width: 100%;">
    							{foreach from=$users_forms item=item}
    							<optgroup label="{$item.user.username}">
    								{foreach from=$item.forms item=litem}
    								<option value="{$litem.formid}">{$litem.name}</option>
    								{/foreach}
    							</optgroup>
    							{/foreach}
    						</select></td>
    					</tr>
    					<tr>
    						<td></td>
    						<td><input type="submit" name="save"
    							value="%%LNG_Addon_backup_export%%"></td>
    					</tr>
    				</table>
    				</form>
				</td>
			</tr>
			<tr>
				<td colspan="2">
						<div class="toolTipBox bb_4">
							<div class="tooltip_body" style="background-image: url(images/mnu_statistics_button.gif);">
								Statistics
							</div>	
						</div>
						<form method="POST"
							action="index.php?Page=Addons&Addon=backup&Action=export&Ajax=1">
						<input type="hidden" name="type" value="statistics" />
						<table border="0" cellspacing="0" cellpadding="5" width="100%"
							class="backup1">
							<tr>
								<td class="b1">Users:</td>
								<td class="b2"><select name="stats[]" multiple="multiple"
									style="height: 150px; width: 100%;">
									{foreach from=$users_stats item=item}
									<optgroup label="{$item.user.username}">
										{foreach from=$item.stats item=litem}
										<option value="{$litem.statid}">{$litem.name} - ({$litem.sendsize_f} recipients) - Subject: {$litem.subject}</option>
										{/foreach}
									</optgroup>
									{/foreach}
								</select></td>
							</tr>
							<tr>
								<td style="text-align: right; vertical-align: top;">Openners:</td>
								<td><input type="checkbox" name="opens" checked="checked"></td>
							</tr>
							<tr>
								<td style="text-align: right; vertical-align: top;">Subscribers:</td>
								<td><input type="checkbox" name="active" checked="checked"></td>
							</tr>
							<tr>
								<td style="text-align: right; vertical-align: top;">Bounced:</td>
								<td><input type="checkbox" name="bounced"></td>
							</tr>
							<tr>
								<td style="text-align: right; vertical-align: top;">Unsubscribed:</td>
								<td><input type="checkbox" name="unsubscribed"></td>
							</tr>
							<tr>
								<td style="text-align: right; vertical-align: top;">Clicks:</td>
								<td><input type="checkbox" name="clicks"></td>
							</tr>
							<tr>
								<td style="text-align: right; vertical-align: top;">Custom
								Fields:</td>
								<td><input type="checkbox" name="custom"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="save"
									value="%%LNG_Addon_backup_export%%"></td>
							</tr>
						</table>
						</form>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>