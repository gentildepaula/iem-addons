<div>
	<input type="button" name="AddListButton" value="Back" style="" class="SmallButton" onclick="javascript: document.location='index.php?Page=Addons&Addon=mta&Action=group&id={$groupid}';">

</div>
<br>
<textarea readonly="readonly" style="width:100%;height:190px;border:1px solid #CCC;overflow:scroll;">
{foreach key=key item=item from=$mtas}
{$item.hostname}|{$item.username}|{$item.password}|{$item.port}|{$item.name}|{$item.mail_from}|{$item.mail_reply}|{$item.mail_bounce}|{$item.mail_test}

{/foreach}
</textarea>
<div style="color:#000;">
<br>
Format:
<br>
<pre>
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
Hostname|Username|Password|Port|MTA_Name|Mail FROM|Mail Reply|Mail Bounce(ReturnPath)|Mail Test
</pre>
<br>
</div>