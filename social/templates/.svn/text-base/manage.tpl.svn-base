<table cellspacing="0" cellpadding="0" align="center" width="100%">
	<tr>
		<td class="Heading1">Redes Sociales Templates</td>
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
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="1100" class="Text" id="SubscriberListManageList">
					<tr>
						<td style="width:35%;vertical-align:top;">
							<fieldset style="border: 1px solid #789CC8;border-radius: 6px 6px 6px 6px;">
								<legend><b>Templates</b></legend>
								<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
                					<tr class="Heading3">
                						<td width="1%" nowrap="nowrap"><img src="images/blank.gif" width="10" height="1" /></td>
                						<td width="50%" nowrap="nowrap">%%LNG_Name%%</td>
                						<td width="20%" nowrap="nowrap">%%LNG_Addon_social_users%%</td>
                						<td width="29%" nowrap="nowrap">%%LNG_Action%%</td>
                					</tr>
                					{foreach from=$shares item=item}
                					<tr class="GridRow">
                						<td nowrap="nowrap"><img src="images/m_newsletters.gif" /></td>
                						<td nowrap="nowrap">{$item.name}</td>
                						<td nowrap="nowrap">{$item.users}</td>
                						<td nowrap="nowrap">
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=social&Action=edit&id={$item.uid}">Edit</a>
                							&nbsp;&nbsp;<a href="index.php?Page=Addons&Addon=social&Action=delete&id={$item.uid}" onclick="return confirm('Are you sure you want to delete this feedback loop?');">Delete</a>
                						</td>
                					</tr>
                					{/foreach}
                				</table>
							</fieldset>
						</td>
						<td style="width:65%;vertical-align:top;">
							<fieldset style="border: 1px solid #789CC8;border-radius: 6px 6px 6px 6px;">
								<legend><b>%%LNG_Addon_social_new%%</b></legend>
								<form method="post" action="index.php?Page=Addons&Addon=social&Action=edit">
								<input type="hidden" name="share_id" value="0" />
								<table border="0" cellspacing="0" cellpadding="5" width="100%" class="Text">
									<tr>
										<td style="width:10%;text-align:right;">Name:</td>
										<td style="width:90%;"><input style="width:50%;" type="text" name="share_name"></td>
									</tr>
									<tr>
										<td style="text-align:right;vertical-align:top;">HTML:</td>
										<td>{$new_share}</td>
									</tr>
									<tr>
										<td style="text-align:right;vertical-align:top;">Users:</td>
										<td>
											<select name="share_users[]" multiple="multiple" style="height:150px;width:50%;">
												<option value="0">-- Ninguno -- </option>
												{foreach from=$users item=item}
												<option value="{$item.userid}">{$item.username}</option>
												{/foreach}
											</select>
										</td>
									</tr>
									<tr>
										<td></td>
										<td><input type="submit" name="save" value="%%LNG_Addon_social_save%%"></td>
									</tr>
								</table>
								</form>
							</fieldset>
						</td>
					</tr>
			</table>
		</td>
	</tr>
</table>