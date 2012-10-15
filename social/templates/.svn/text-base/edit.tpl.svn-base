<table align="center" cellpadding="0" border="0" width="1000">
<tr>
<td>
<fieldset
	style="border: 1px solid #789CC8; border-radius: 6px 6px 6px 6px;"><legend>%%LNG_Addon_social_editing%% <b>{$name}</b></legend>
<form method="post"
	action="index.php?Page=Addons&Addon=social&Action=edit"><input
	type="hidden" name="share_id" value="{$uid}" />
<table border="0" cellspacing="0" cellpadding="5" width="100%"
	class="Text">
	<tr>
		<td style="width: 10%; text-align: right;">Name:</td>
		<td style="width: 90%;"><input style="width: 50%;" type="text" name="share_name" value="{$name}"></td>
	</tr>
	<tr>
		<td style="text-align: right; vertical-align: top;">HTML:</td>
		<td>{$html}</td>
	</tr>
	<tr>
		<td style="text-align: right; vertical-align: top;">Users:</td>
		<td><select name="share_users[]" multiple="multiple"
			style="height: 150px; width: 50%;">
			<option value="0">%%LNG_Addon_social_none%%</option>
			{foreach from=$users item=item}
			<option value="{$item.userid}" {if $item.share==$uid}selected="selected"{/if}>{$item.username}</option>
			{/foreach}
		</select></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="save" value="%%LNG_Addon_social_save%%"><input type="button" value="%%LNG_Addon_social_cancel%%" onclick="window.location='index.php?Page=Addons&Addon=social&Action=manage';"></td>
	</tr>
</table>
</form>
</fieldset>
</td>
</tr>
</table>