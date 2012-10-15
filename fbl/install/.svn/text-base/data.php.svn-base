<?php
#START_BLOCK_FBL_COUNT#
$addon_system = new Interspire_Addons();
$fbl_enabled = $addon_system->isEnabled("fbl");
if ($fbl_enabled) {
    $addon_fbl = $addon_system->Process("fbl", "GetApi", "fbl");
    $GLOBALS['FblCount'] = $this->FormatNumber($addon_fbl->get_fbl_count_from_stat($statsdetails['statid']));
}
#END_BLOCK_FBL_COUNT#
#START_BLOCK_FBL_COUNT2#
$addon_system = new Interspire_Addons();
$fbl_enabled = $addon_system->isEnabled("fbl");
if ($fbl_enabled) {
    $addon_fbl = $addon_system->Process("fbl", "GetApi", "fbl");
    $GLOBALS['FblCount'] = $addon_fbl->get_fbl_count_from_stat($statid);
}
#END_BLOCK_FBL_COUNT2#
#START_BLOCK_FBL_COUNT3#
$addon_system = new Interspire_Addons();
$fbl_enabled = $addon_system->isEnabled("fbl");
if ($fbl_enabled) {
    $addon_fbl = $addon_system->Process("fbl", "GetApi", "fbl");
    $GLOBALS['FblCount'] = $addon_fbl->get_fbl_count_from_list($listinfo['listid']);
}
#END_BLOCK_FBL_COUNT3#
?>
#START_BLOCK_FBL1#
<td style="color:red;" width="90" nowrap>
	%%LNG_Addon_fbl_Spam_Complaints%%
</td>
#END_BLOCK_FBL1#
#START_BLOCK_FBL2#
<td style="color:red;">
	<a href="index.php?Page=Addons&Addon=fbl&Action=Export&Ajax=1&statid=%%GLOBAL_StatID%%" style="color:red;text-decoration:underline;">%%GLOBAL_FblCount%%</a>
</td>
#END_BLOCK_FBL2#
#START_BLOCK_FBL3#
<tr class="GridRow">
						<td  style="color:red;font-weight:bold;" width="30%" height="22" nowrap align="left" valign="top">
							&nbsp;%%LNG_Addon_fbl_Spam_Complaints%%
						</td>
						<td style="color:red;" width="70%" nowrap align="left">
							%%GLOBAL_FblCount%%
						</td>
					</tr>
#END_BLOCK_FBL3#
#START_BLOCK_FBL4#
<td style="color:red;" width="120" nowrap="nowrap" align="center">
	%%LNG_Addon_fbl_Spam_Complaints%%
</td>
#END_BLOCK_FBL4#
#START_BLOCK_FBL5#
<td style="color:red;" width="120"  class="HideOnDrag" align="center">
	<a href="index.php?Page=Addons&Addon=fbl&Action=ExportList&Ajax=1&listid=%%GLOBAL_ListID%%" style="color:red;text-decoration:underline;">%%GLOBAL_FblCount%%</a>
</td>
#END_BLOCK_FBL5#