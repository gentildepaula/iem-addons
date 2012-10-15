<script src="includes/js/jquery.js"></script>
<script src="includes/js/jquery/form.js"></script>
<script src="includes/js/jquery/thickbox.js"></script>
<link rel="stylesheet" type="text/css" href="includes/styles/thickbox.css" />
<script>
	$(function() {
		$(document.frmListEditor).submit(function(event) {
			try {

				var fieldNames = ["spins_url",];
				var emptyToks = ["Enter URL"];
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
<form name="frmListEditor" id="frmListEditor" method="post" action="index.php?Page=Addons&Addon=spins&Action=addurl">
<input type="hidden" name="spins_do" value="{$do}">
{if $do=="update"}
<input type="hidden" name="uid" value="{$value.uid}">
{/if}
	<table cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td class="Heading1">
				Add URL
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
				<tr style="display: %%GLOBAL_ShowBounceInfo%%" class="YesProcessBounce">
					<td class="FieldLabel">
						{template="Required"}
						URL:&nbsp;
					</td>
					<td style="{$style}">
						{$blankimg} <input type="text" name="url" class="Field250 form_text bounceSettings" value="{$value.url}">&nbsp;
					</td>
				</tr>
				</table>
				<table width="100%" cellspacing="0" cellpadding="2" border="0" class="PanelPlain">
					<tr>
						<td width="200" class="FieldLabel">&nbsp;</td>
						<td valign="top" height="30">
							<input class="FormButton" type="submit" value="%%LNG_Save%%" />
							<input onclick="javascript: document.location='index.php?Page=Addons&Addon=spins';" class="FormButton" type="button" value="%%LNG_Cancel%%" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
