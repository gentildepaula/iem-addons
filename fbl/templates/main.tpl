<table cellspacing="0" cellpadding="0" align="center" width="100%">
	<tr>
		<td class="Heading1">Feedback Loops</td>
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
			
			<input type="button" name="AddListButton" value="Add FBL Mail" style="width:150px" class="SmallButton" onclick="javascript: document.location='index.php?Page=Addons&Addon=fbl&Action=add';">
			<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
					<tr class="Heading3">
						<td width="28" nowrap align="center">
							
						</td>
						<td width="1%" nowrap="nowrap"><img src="images/blank.gif" width="44" height="1" /></td>
						<td width="20%" nowrap="nowrap">
							Name
						</td>
						<td width="15%" nowrap="nowrap">
							Hostname
						</td>
						<td width="10%" nowrap="nowrap">
							Username
						</td>
						<td width="5%" nowrap="nowrap">
							Port
						</td>
						<td width="10%" nowrap="nowrap">
							Complaints
						</td>
						<td width="10%" nowrap="nowrap">
							Type
						</td>
						<td width="10%" nowrap="nowrap">
							Method
						</td>
						<td width="10%" nowrap="nowrap">
							Status
						</td>
						<td width="10%" nowrap="nowrap">
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
							{$item.name}
						</td>
						<td nowrap="nowrap">
							{$item.hostname}
						</td>
						<td nowrap="nowrap">
							{$item.username}
						</td>
						<td nowrap="nowrap">
							{$item.port}
						</td>
						<td nowrap="nowrap">
							{$item.complaints}
						</td>
						<td nowrap="nowrap">
							{$item.type}
						</td>
						<td nowrap="nowrap">
							{$item.method_label}
						</td>
						<td nowrap="nowrap">
							{if $item.status==false}
								<span style="color:green;font-weight:bold;">Connected!</span>
							{else}
								<span style="color:red;">{$item.status}</span>
							{/if}
						</td>
						<td nowrap="nowrap">
							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=fbl&Action=process&id={$item.uid}">Process</a>
							&nbsp;&nbsp;<span style="color:#CCC;">Flush</span>
							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=fbl&Action=edit&id={$item.uid}">Edit</a>
							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=fbl&Action=delete&id={$item.uid}" onclick="return confirm('Are you sure you want to delete this feedback loop?');">Delete</a>
						</td>
					</tr>
					{/foreach}
				</table>
		</td>
	</tr>
</table>
