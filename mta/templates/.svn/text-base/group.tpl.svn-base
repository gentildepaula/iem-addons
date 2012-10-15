{template="css"}
{template="js"}
<div>
	<input type="button" name="AddListButton" value="New MTA Group" style="width:150px;" class="SmallButton" onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=add_group';">
	<input type="button" name="AddListButton" value="Edit MTA Group" style="width:150px" class="SmallButton" onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=add_group&id={$group.mta_group_uid}';">
	&nbsp;-&nbsp;
	<input type="button" name="AddListButton" value="New MTA" style="width:150px" class="SmallButton" onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=add_mta&group_id={$group.mta_group_uid}';">

</div>
<br>
<table cellspacing="0" cellpadding="0" align="center" width="100%">
	<tr>
		<td class="Heading1">
			<a id="HomeStartTitle" href="index.php?Page=Addons&Addon=mta&Action=Manager">%%LNG_Addon_mta_manager%%</a> > {$group.mta_group_name}
		</td>
	</tr>
	<tr>
		<td class="Intro pageinfo">
		Create or edit your SMTP Groups.
		</td>
	</tr>
	<tr>
		<td>
			{template="message"}
		</td>
	</tr>
	<tr>
		<td class="body">
			<table align="center" border="0" cellspacing="5" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
					<tr>
						<td style="vertical-align:top;">
							{template="group_mtas"}
						</td>
					</tr>
			</table>
		</td>
	</tr>
		<tr>
		<td class="body">
			<table align="center" border="0" cellspacing="5" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
					<tr>
						<td style="vertical-align:top;width:60%">
							{template="mta_add_bulk_static"}
						</td>
						<td style="vertical-align:top;width:40%;">
							{template="users"}
						</td>
					</tr>
			</table>
		</td>
	</tr>
</table>