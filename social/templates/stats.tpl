<div id="div8" style="display:none">
	<div class="body">
	<table width="1100" border="0" class="Text" align="center" cellpadding="10">
		<tr>
			<td valign="top" style="height:30px;width:25%;">
			<div class="MidHeading" style="width:100%"><img src="images/m_stats.gif" width="20" height="20" align="absMiddle">&nbsp;%%LNG_Addon_social_snapshot%%</div>
				<UL class="Text">
    				<LI>Facebook: {$maborak.rs.f} <!-- <a href="remote_stats.php?type=export_newsletter_opens&token=%%GLOBAL_TableToken%%&rs=f">%%LNG_Addon_social_export%%</a> - --><a href="#" onclick="tb_show('asdasd','index.php?Page=Addons&Addon=social&Action=show&Ajax=true&modal=true&height=500&width=400&statid={$maborak.statid}&rst=f')">%%LNG_Addon_social_view%%</a></li>
    				<LI>Twitter: {$maborak.rs.t} <!-- <a href="remote_stats.php?type=export_newsletter_opens&token=%%GLOBAL_TableToken%%&rs=t">%%LNG_Addon_social_export%%</a> - --><a href="#" onclick="tb_show('asdasd','index.php?Page=Addons&Addon=social&Action=show&Ajax=true&modal=true&height=500&width=400&statid={$maborak.statid}&rst=t')">%%LNG_Addon_social_view%%</a></li></li>
    				<LI>Delicious: {$maborak.rs.d} <!-- <a href="remote_stats.php?type=export_newsletter_opens&token=%%GLOBAL_TableToken%%&rs=d">%%LNG_Addon_social_export%%</a> - --><a href="#" onclick="tb_show('asdasd','index.php?Page=Addons&Addon=social&Action=show&Ajax=true&modal=true&height=500&width=400&statid={$maborak.statid}&rst=d')">%%LNG_Addon_social_view%%</a></li></li>
    				<LI>Google: {$maborak.rs.g} <!-- <a href="remote_stats.php?type=export_newsletter_opens&token=%%GLOBAL_TableToken%%&rs=g">%%LNG_Addon_social_export%%</a> - --><a href="#" onclick="tb_show('asdasd','index.php?Page=Addons&Addon=social&Action=show&Ajax=true&modal=true&height=500&width=400&statid={$maborak.statid}&rst=g')">%%LNG_Addon_social_view%%</a></li></li>
    				<LI>Digg: {$maborak.rs.i} <!-- <a href="remote_stats.php?type=export_newsletter_opens&token=%%GLOBAL_TableToken%%&rs=i">%%LNG_Addon_social_export%%</a> - --><a href="#" onclick="tb_show('asdasd','index.php?Page=Addons&Addon=social&Action=show&Ajax=true&modal=true&height=500&width=400&statid={$maborak.statid}&rst=i')">%%LNG_Addon_social_view%%</a></li></li>
    				<LI>Myspace: {$maborak.rs.m} <!-- <a href="remote_stats.php?type=export_newsletter_opens&token=%%GLOBAL_TableToken%%&rs=m">%%LNG_Addon_social_export%%</a> - --><a href="#" onclick="tb_show('asdasd','index.php?Page=Addons&Addon=social&Action=show&Ajax=true&modal=true&height=500&width=400&statid={$maborak.statid}&rst=m')">%%LNG_Addon_social_view%%</a></li></li>
    			</UL>
			</td>
			<td valign="top" style="width:45%;">
				<div id="share_chart" style="text-align:center;margin-left:auto;margin-right:auto;border:1px solid #EEE;height:100%;width:100%;"></div>
			</td>
			<td valign="top" style="width:30%;">
			<div class="MidHeading" style="width:100%"><img src="images/user.gif" width="20" height="20" align="absMiddle">%%LNG_Addon_social_latest%%</div>
				<table border="0" cellspacing="0" cellpadding="0" width="100%" class="Text" id="SubscriberListManageList">
					<tr>
						<td  style="border-bottom:2px solid #CCC;" width="1%" nowrap="nowrap"><img src="images/blank.gif" width="44" height="1" /></td>
						<td  style="border-bottom:2px solid #CCC;" width="70%" nowrap="nowrap">
							%%LNG_Addon_social_email%%
						</td>
						<td  style="border-bottom:2px solid #CCC;" width="29%" nowrap="nowrap">
							%%LNG_Addon_social_network%%
						</td>
					</tr>
					{foreach key=key item=item from=$maborak.last}
					<tr class="GridRow">
						<td></td>
						<td nowrap="nowrap" style="padding:10px;" class="{if ($maborak.lastindex.$key % 2) == 0}te_r2{/if}">
							&nbsp;{$item.emailaddress}
						</td>
						<td nowrap="nowrap" style="padding:10px;background-color:#FFF;">
							{$item.share}
						</td>
					</tr>
					{/foreach}
				</table>
			</td>
		</tr>
	</table>
	</div>
	<script type="text/javascript">
		var drawed_share_chart = false;
		function draw_share_chart()
		{
			if(drawed_share_chart==true)
			{
				return false;
			}
			drawed_share_chart = true;
    		line1 = [['%%LNG_Addon_social_unshared%% [<b>{$maborak.rs.s}</b>]',{$maborak.rs.s}],['Facebook [{$maborak.rs.f}]',{$maborak.rs.f}], ['Twitter [{$maborak.rs.t}]',{$maborak.rs.t}], ['Delicious [{$maborak.rs.d}]',{$maborak.rs.d}], ['Google [{$maborak.rs.g}]',{$maborak.rs.g}], ['Digg [{$maborak.rs.i}]',{$maborak.rs.i}], ['Myspace [{$maborak.rs.m}]',{$maborak.rs.m}]];
    		plot2 = $.jqplot('share_chart', [line1], {
    			seriesColors: [ "#FF8928", "#627AAD","#5DA0C1","#3274D0","#00730B","#666","#000"],
        	    seriesDefaults:{renderer:$.jqplot.PieRenderer, rendererOptions:{sliceMargin:3,shadowAlpha: 0.07,padding:10}
            	 },
        	    legend:{show:true}
    		});
		}
	</script>
</div>