<table cellspacing="0" cellpadding="0" align="center" width="100%">
	<tr>
		<td class="Heading1">Spins URL Rotator</td>
	</tr>
	<tr>
		<td class="Intro pageinfo"></td>
	</tr>
	<tr>
		<td>
			{template="message"}
		</td>
	</tr>
	<tr>
		<td class="body">
			
			<input type="button" name="AddListButton" value="Add URL" style="width:150px" class="SmallButton" onclick="javascript: document.location='index.php?Page=Addons&Addon=spins&Action=addurl';">
			<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
					<tr class="Heading3">
						<td width="28" nowrap align="center">
							
						</td>
						<td width="1%" nowrap="nowrap"><img src="images/blank.gif" width="44" height="1" /></td>
						<td width="50%" nowrap="nowrap">
							URL
						</td>
						<td width="19%" nowrap="nowrap">
							Count
						</td>
						<td width="30%" nowrap="nowrap">
							%%LNG_Action%%
						</td>
					</tr>
					{foreach from=$result item=item}
					<tr class="GridRow">
						<td nowrap align="center">							
						</td>
						<td nowrap="nowrap">
							<img src="images/m_newsletters.gif" />
						</td>
						<td nowrap="nowrap">
							{$item.url}
						</td>
						<td nowrap="nowrap">
							{$item.s}
						</td>
						<td nowrap="nowrap">
							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=spins&Action=editurl&id={$item.uid}">Edit</a>
							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=spins&Action=deleteurl&id={$item.uid}" onclick="return confirm('Are you sure you want to delete this URL?');">Delete</a>
						</td>
					</tr>
					{/foreach}
				</table>
		</td>
	</tr>
</table>
