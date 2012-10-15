<script src="includes/js/jquery.js"></script>
<script src="includes/js/jquery/form.js"></script>
<script src="includes/js/jquery/thickbox.js"></script>
<link rel="stylesheet" type="text/css" href="includes/styles/thickbox.css" />
<script>
	$(function() {
		$(document.frmListEditor).submit(function(event) {
			try {

				var fieldNames = ["fbl_name", "fbl_hostname", "fbl_username", "fbl_password", "fbl_port"];
				var emptyToks = ["Enter FBL Name", "FBL Email Server Name", "FBL Email User Name", "FBL Email Server Password", "FBL Email Server Port"];
				var form = this;
				var fields = jQuery.map(fieldNames, function(el, i) {
					return form.elements[el];
				});

				var error = false;
				jQuery.each(fields, function(i, el){
					if (el.value == '') {
						error = emptyToks[i];
						el.focus();
						return false;
					}
				});

				if (error) {
					alert(error);
					return false;
				}
				return true;

			} catch(e) {
				alert('Unable to validate');
				return false;
			}
		});
	});
</script>
<form name="frmListEditor" id="frmListEditor" method="post" action="index.php?Page=Addons&Addon=fbl&Action=add">
<input type="hidden" name="fbl_do" value="{$do}">
{if $do=="update"}
<input type="hidden" name="fbl_uid" value="{$value.uid}">
{/if}
	<table cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="Heading1">
				Add FBL Mail
			</td>
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
			<td>
				<table border="0" cellspacing="0" cellpadding="2" width="100%" class="Panel">
<tr>
<td class="Heading2" colspan="2">
	&nbsp;&nbsp;Feedback Loop Details</td>
</tr>					
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Required"}
		FBL Name:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg} <input type="text" name="fbl_name" class="Field250 form_text bounceSettings" value="{$value.name}">&nbsp;
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Required"}
		FBL Email Server Name:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg} <input type="text" name="fbl_hostname" class="Field250 form_text bounceSettings" value="{$value.hostname}">&nbsp;
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Required"}
		FBL Email User Name:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg} <input type="text" name="fbl_username" class="Field250 form_text bounceSettings" value="{$value.username}">&nbsp;
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Required"}
		FBL Email Password:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg} <input type="text" name="fbl_password" class="Field250 form_text bounceSettings" value="{$value.password}">&nbsp;
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Required"}
		FBL Email Server Port:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg} <input type="text" name="fbl_port" class="Field30 form_text bounceSettings" value="{$value.port}">&nbsp;
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Not_Required"}
		Feedback Loop Type:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg}
		<select name="fbl_method">
			<option value="1" {if $value.method==1}selected="selected"{/if}>Normal</option>
			<option value="2" {if $value.method==2}selected="selected"{/if}>Email</option>
			<option value="3" {if $value.method==3}selected="selected"{/if}>Unsubscribe Link</option>
		</select>
		
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Not_Required"}
		Account Type:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg}
		<select name="fbl_type">
			<option value="1" selected="selected">IMAP Account</option>
		</select>
		
	</td>
</tr>
<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
	<td class="FieldLabel">
		{template="Required"}
		Advanced Options:&nbsp;
	</td>
	<td style="{$style}">
		{$blankimg} <input type="text" name="fbl_advanced" class="Field250 form_text bounceSettings" value="{$value.advanced}">&nbsp;
	</td>
</tr>



				</table>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="PanelPlain">
					<tr>
						<td width="200" class="FieldLabel">&nbsp;</td>
						<td valign="top" height="30">
							<input class="FormButton" type="submit" value="%%LNG_Save%%" />
							<input class="FormButton" type="submit" value="Test" name="fbl_test" />
							<input onclick="javascript: document.location='index.php?Page=Addons&Addon=fbl';" class="FormButton" type="button" value="%%LNG_Cancel%%" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
