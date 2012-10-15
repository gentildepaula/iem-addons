<?php
#START_BLOCK_1#
$addon_system = new Interspire_Addons();
$social_enabled = $addon_system->isEnabled("social");
if ($social_enabled) {
    $addon_social = $addon_system->Process("social", "GetApi", "social");
    $addon_social->display($_GET, $email_text);
}
#END_BLOCK_1#
#START_BLOCK_1PATCH#
$addon_system = new Interspire_Addons();
$social_enabled = $addon_system->isEnabled("social");
if ($social_enabled) {
	$addon_social = $addon_system->Process("social", "GetApi", "social");
	$addon_social->display($_GET,$description);
}
#END_BLOCK_1PATCH#
#START_BLOCK_2#
$addon_system = new Interspire_Addons();
$social_enabled = $addon_system->isEnabled("social");
if ($social_enabled) {
    $addon_social = $addon_system->Process("social", "GetApi", "social");
    $GLOBALS['NetworksPage'] = $addon_social->stats($statid, $summary);
}
#END_BLOCK_2#
#START_BLOCK_4A#
$addon_system = new Interspire_Addons();
$social_enabled = $addon_system->isEnabled("social");
if ($social_enabled) {
    $addon_social = $addon_system->Process("social", "GetApi", "social");
    $addon_social->replace_in_mail($text, $web_version_link, $this->SentBy, $this->Subject);
}
#END_BLOCK_4A#
#START_BLOCK_4B#
$addon_system = new Interspire_Addons();
$social_enabled = $addon_system->isEnabled("social");
if ($social_enabled) {
	$addon_social = $addon_system->Process("social", "GetApi", "social");
	if ($addon_social->ignore_patterns($url)){
		continue;
	}
}
#END_BLOCK_4B#


#START_BLOCK_EMAIL2#
if (preg_match('/%%sendfriend_(.*)%%/i', $url)) {
    continue;
}
if (preg_match("/(%%SURVEY.*?%%)/isx", $url)) {
    continue;
}
#END_BLOCK_EMAIL2#
#START_BLOCK_API_STATS_1#
if (isset($open_details['share'])) {
    $record_open = true;
}
#END_BLOCK_API_STATS_1#
#START_BLOCK_API_STATS_2#
if (isset($open_details['share'])) {
    /*
	* Social Network
	* ALTER TABLE  `email_stats_emailopens` ADD  `share` VARCHAR( 255 ) NOT NULL DEFAULT  'n'
	*/
    $result = $this->Db->Query("SELECT share FROM " . SENDSTUDIO_TABLEPREFIX . "stats_emailopens LIMIT 1");
    if (! $result) {
        $result = $this->Db->Query("ALTER TABLE `" . SENDSTUDIO_TABLEPREFIX . "stats_emailopens` ADD `share` VARCHAR( 255 ) NOT NULL DEFAULT 'n'");
    }
    $query = "INSERT INTO " . SENDSTUDIO_TABLEPREFIX . "stats_emailopens(opentime, openip, subscriberid, statid, fromlink, opentype, share) VALUES('" . (int) $open_details['opentime'] . "', '" . $this->Db->Quote($open_details['openip']) . "', '" . (int) $open_details['subscriberid'] . "', '" . (int) $open_details['statid'] . "', '" . (int) $from_link_click . "', '" . $this->Db->Quote($opentype) . "', '{$open_details['share_type']}')";
}
#END_BLOCK_API_STATS_2#
?>
#START_BLOCK_TEMPLATE_1#
<li><a href="#" onClick="ShowTab(8);draw_share_chart();return false;"
	id="tab8">%%LNG_Addon_social_social_network%%</a></li>
#END_BLOCK_TEMPLATE_1#
#START_BLOCK_TEMPLATE_2#
%%GLOBAL_NetworksPage%%
#END_BLOCK_TEMPLATE_2#
#START_BLOCK_JQPLOT#
<script type="text/javascript" src="addons/social/includes/js/jqplot/jquery.jqplot.js"></script>
<script type="text/javascript" src="addons/social/includes/js/jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="addons/social/includes/js/jqplot/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="addons/social/includes/js/jqplot/plugins/jqplot.pieRenderer.js"></script>
<link rel="stylesheet" href="addons/social/includes/js/jqplot/jquery.jqplot.css" type="text/css">
<!--[if IE]><script language="javascript" type="text/javascript" src="addons/social/includes/js/jqplot/excanvas.js"></script><![endif]-->
#END_BLOCK_JQPLOT#
#START_BLOCK_JQPLOT_EMPTY#
#END_BLOCK_JQPLOT_EMPTY#
