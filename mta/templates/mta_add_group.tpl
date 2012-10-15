{template="css"}

<form name="frmListEditor" id="frmListEditor" method="post" action="index.php?Page=Addons&Addon=mta&Action=add_group">
<input type="hidden" name="mta_group_do" value="{$do}">
<input type="hidden" name="mta_group_uid" value="{$value.mta_group_uid}">
	<table cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="Heading1">
				<a id="HomeStartTitle" href="index.php?Page=Addons&Addon=mta&Action=Manager">%%LNG_Addon_mta_manager%%</a> > %%LNG_Addon_mta_create_new_group%%
			</td>
		</tr>
		<tr>
			<td class="body pageinfo">
				<p>
					intro
				</p>
			</td>
		</tr>
		<tr>
			<td>
				%%GLOBAL_Message%%
			</td>
		</tr>
		<tr>
			<td>
				<input class="FormButton SubmitButton" type="submit" value="%%LNG_Save%%">
				<input class="FormButton CancelButton" type="button" value="%%LNG_Cancel%%" onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=manager';" />
				<br />&nbsp;
				<table border="0" cellspacing="0" cellpadding="2" width="100%" class="Panel">
					<tr>
						<td colspan="2" class="Heading2">
							&nbsp;&nbsp;%%LNG_Addon_mta_group_details%%
						</td>
					</tr>
					<tr>
						<td class="FieldLabel">
							{template="Required"}
							%%LNG_Addon_mta_group_name%%:&nbsp;
						</td>
						<td>
							<input value="{$value.mta_group_name}" class="Field250 form_text" type="text" name="mta_group_name">&nbsp;%%LNG_HLP_Addon_mta_group_name%%
						</td>
					</tr>
					<tr>
						<td class="FieldLabel">
							{template="Required"}
							%%LNG_Addon_mta_title_rotation%%:&nbsp;
						</td>
						<td>
							<select	name="mta_group_rotation">
								<option {if $value.mta_group_rotation==1}selected="selected"{/if} value="1">Random</option>
								<option {if $value.mta_group_rotation==2}selected="selected"{/if} value="2">Cycle</option>
							</select>&nbsp;&nbsp;&nbsp;&nbsp;%%LNG_HLP_Addon_mta_title_rotation%%
						</td>
					</tr>

					<tr>
						<td class="EmptyRow" colspan="2">
							&nbsp;
						</td>
					</tr>


					
					

				</table>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="PanelPlain">
					<tr>
						<td width="200" class="FieldLabel">&nbsp;</td>
						<td valign="top" height="30">
							<input class="FormButton SubmitButton" type="submit" value="%%LNG_Save%%" />
							<input onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=manager';" class="FormButton CancelButton" type="button" value="%%LNG_Cancel%%" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
