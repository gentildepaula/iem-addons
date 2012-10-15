<form id="mail_test_{$item.uid}" name="mail_test_{$item.uid}" method="post">
<input type="hidden" name="uid" value="{$item.uid}">
<table style="margin-top:0px;" border="0" cellspacing="0" cellpadding="0" width="100%" class="Text GroupMtas" >
				                				<tr  class="GridRow">
			                						<td  style="width:39%;border-bottom: 4px solid #DDD;;padding-bottom:0px;text-align: center;">
			                						%%LNG_Addon_mta_title_mail_settings%%
			                						</td>
			                						<td style="width:61%;vertical-align:top;border-left:1px solid #DDD;background-color:#FFF;" rowspan="6">
			                						%%LNG_Addon_mta_log%%:<br>
			                						<textarea readonly="readonly" id="console_{$item.uid}" style="width:99%;height:170px;border:1px solid #CCC;font-size:8pt;padding:3px;"></textarea>
			                						</td>
			                					</tr>
			                					<tr  class="GridRow">
			                						<td class="mta_group_mail_settings" style="border-bottom:0px solid #FFF;">
			                						%%LNG_Addon_mta_title_mail_from%%:&nbsp;&nbsp;<input class="Field250 form_text" type="text" name="mail_from" value="{$item.mail_from}">
			                						</td>
			                					</tr>
			                					<tr  class="GridRow">
			                						<td class="mta_group_mail_settings" style="border-bottom:0px solid #FFF;">
			                						%%LNG_Addon_mta_title_mail_reply%%:&nbsp;&nbsp;<input class="Field250 form_text" type="text" name="mail_reply" value="{$item.mail_reply}">
			                						</td>
			                					</tr>
			                					<tr  class="GridRow">
			                						<td class="mta_group_mail_settings" style="border-bottom:0px solid #FFF;">
			                						%%LNG_Addon_mta_title_mail_bounce%%:&nbsp;&nbsp;<input class="Field250 form_text" type="text" name="mail_bounce" value="{$item.mail_bounce}">
			                						</td>
			                					</tr>
			                					<tr  class="GridRow">
			                						<td class="mta_group_mail_settings">
			                						%%LNG_Addon_mta_title_mail_test%%:&nbsp;&nbsp;<input class="Field250 form_text" type="text" name="mail_test" value="{$item.mail_test}">
			                						</td>
			                					</tr>
			                					<tr  class="GridRow GridRowWhite">
			                						<td class="mta_group_mail_settings">
			                						<input onclick="mta_details_do('save','{$item.uid}',this);return false;" type="button" value="%%LNG_Save%%">
			                						<input onclick="mta_details_do('test','{$item.uid}',this);return false;" type="button" value="%%LNG_TestSMTPSettings%%">
			                						</td>
			                					</tr>
	                						</table>
</form>
<table style="margin-top:0px;width:99%;" border="0" cellspacing="0" cellpadding="0" class="Text GroupMtas" >
	<tr>
		<td style="border-bottom: 4px solid #DDDDDD;padding-bottom:0px;text-align: center;overflow:hidden;width:100%;">
			<div  id="mta_info_chart_{$item.uid}"  style="width:100%;">
			
			</div>
			<div  id="mta_info_reputation_{$item.uid}"  style="width:100%;">
				<div style="padding:5px;text-align:left;">
				<img src="addons/mta/images/ajax-loader.gif">
				</div>
			</div>
		</td>
	</tr>
</table>