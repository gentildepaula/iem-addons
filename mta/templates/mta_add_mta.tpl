{template="css"}
<form name="frmListEditor" id="frmListEditor" method="post" action="index.php?Page=Addons&Addon=mta&Action=add_mta&group_id={$group.mta_group_uid}&id={$value.uid}">
<input type="hidden" name="mta_do" value="{$do}">
<input type="hidden" name="mta_group_uid" value="{$group.mta_group_uid}">
<input type="hidden" name="uid" value="{$value.uid}">
	<table cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="Heading1">
				<a id="HomeStartTitle" href="index.php?Page=Addons&Addon=mta&Action=Manager">%%LNG_Addon_mta_manager%%</a> > <a id="HomeStartTitle" href="index.php?Page=Addons&Addon=mta&Action=group&id={$group.mta_group_uid}">%%LNG_Addon_mta_group%% {$group.mta_group_name}</a> > 
				{if $do=="add"}
				%%LNG_Addon_mta_create_new_mta%%
				{else}
				{$value.name}
				
				{/if}
			</td>
		</tr>
		<tr>
			<td class="body pageinfo">
				<p>
					Create or Edit your MTA
				</p>
			</td>
		</tr>
		<tr>
			<td>
				{template="message"}
			</td>
		</tr>
		<tr>
			<td>
				<input class="FormButton SubmitButton" type="submit" value="%%LNG_Save%%">
				<input type="submit" name="test_smtp" value="%%LNG_TestSMTPSettings%%" class="FormButton" style="width: 120px;" />
				<input class="FormButton CancelButton" type="button" value="%%LNG_Cancel%%" onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=group&id={$group.mta_group_uid}';" />
				<br />&nbsp;
				<table border="0" cellspacing="0" cellpadding="2" width="100%" class="Panel">
					<tr>
						<td colspan="2" class="Heading2">
							&nbsp;&nbsp;%%LNG_Addon_mta_mta_details%%
						</td>
					</tr>
					<tr>
						<td class="FieldLabel">
							{template="Not_Required"}
							%%LNG_Addon_mta_group%%&nbsp;
						</td>
						<td>
							{$group.mta_group_name}
						</td>
					</tr>
					<tr>
						<td class="FieldLabel">
							{template="Required"}
							%%LNG_Addon_mta_mta_name%%:&nbsp;
						</td>
						<td>
							<input value="{$value.name}" class="Field250 form_text" type="text" name="name">&nbsp;%%LNG_HLP_Addon_mta_group_name%%
						</td>
					</tr>
					<tr>
							<td colspan="2" class="Heading2">
								&nbsp;&nbsp;%%LNG_SmtpServerIntro%%
							</td>
						</tr>

						<tr class="SMTPOptions" style="display: %%GLOBAL_DisplaySMTP%%">
							<td class="FieldLabel">
								{template="Required"}
								%%LNG_SmtpServerName%%:
							</td>
							<td>
								<input type="text" name="hostname" id="hostname" value="{$value.hostname}" class="Field250 smtpSettings"> %%LNG_HLP_SmtpServerName%%
							</td>
						</tr>
						<tr class="SMTPOptions" style="display: %%GLOBAL_DisplaySMTP%%">
							<td class="FieldLabel">
								{template="Not_Required"}
								%%LNG_SmtpServerUsername%%:
							</td>
							<td>
								<input type="text" name="username" id="username" value="{$value.username}" class="Field250 smtpSettings"> %%LNG_HLP_SmtpServerUsername%%
							</td>
						</tr>
						<tr>
							<td class="FieldLabel">
								{template="Not_Required"}
								%%LNG_SmtpServerPassword%%:
							</td>
							<td>
								<input type="password" name="password" id="password" value="{$value.password}" class="Field250 smtpSettings" autocomplete="off" /> %%LNG_HLP_SmtpServerPassword%%
							</td>
						</tr>
						<tr>
							<td class="FieldLabel">
								{template="Not_Required"}
								%%LNG_SmtpServerPort%%:
							</td>
							<td>
								<input type="text" name="port" id="port" value="{$value.port}" class="Field250 smtpSettings"> %%LNG_HLP_SmtpServerPort%%
							</td>
						</tr>
						<tr>
							<td class="FieldLabel">
								{template="Required"}
								%%LNG_Addon_mta_title_mail_test%%:
							</td>
							<td>
								<input type="text" name="mail_test" id="mail_test" value="{$value.mail_test}" class="Field250 smtpSettings"> %%LNG_HLP_TestSMTPSettings%%
							</td>
						</tr>
					<tr>
							<td colspan="2" class="Heading2">
								&nbsp;&nbsp;%%LNG_Addon_mta_title_mail_settings%%
							</td>
					</tr>
					<tr>
							<td class="FieldLabel">
								{template="Not_Required"}
								%%LNG_Addon_mta_title_mail_from%%:
							</td>
							<td>
								<input type="text" name="mail_from" id="mail_from" value="{$value.mail_from}" class="Field250">
							</td>
						</tr>
					<tr>
							<td class="FieldLabel">
								{template="Not_Required"}
								%%LNG_Addon_mta_title_mail_reply%%:
							</td>
							<td>
								<input type="text" name="mail_reply" id="mail_reply" value="{$value.mail_reply}" class="Field250">
							</td>
					</tr>
					<tr>
							<td class="FieldLabel">
								{template="Not_Required"}
								%%LNG_Addon_mta_title_mail_bounce%%:
							</td>
							<td>
								<input type="text" name="mail_bounce" id="mail_bounce" value="{$value.mail_bounce}" class="Field250">
							</td>
					</tr>
					
					
					

				</table>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="PanelPlain">
					<tr>
						<td width="200" class="FieldLabel">&nbsp;</td>
						<td valign="top" height="30">
							<input class="FormButton SubmitButton" type="submit" value="%%LNG_Save%%" />
							<input type="submit" name="test_smtp" value="%%LNG_TestSMTPSettings%%" class="FormButton" style="width: 120px;" />
							<input onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=group&id={$group.mta_group_uid}';" class="FormButton CancelButton" type="button" value="%%LNG_Cancel%%" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
