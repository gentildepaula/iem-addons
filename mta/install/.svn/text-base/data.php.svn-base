<?php
#START_BLOCK_2A#
$addon_system = new Interspire_Addons();
$mta_enabled = $addon_system->isEnabled("mta");
if ($mta_enabled)
{
    $addon_mta = $addon_system->Process("mta", "GetApi", "mta");
    $addon_mta->iem_show_mtas_in_email_campaign();
}
#END_BLOCK_2A#
#START_BLOCK_2B#
$addon_system = new Interspire_Addons();
$mta_enabled = $addon_system->isEnabled("mta");
if ($mta_enabled)
{
    $addon_mta = $addon_system->Process("mta", "GetApi", "mta");
    $addon_mta->iem_email_campaign_save_mta($send_details,$_POST);
}
#END_BLOCK_2B#
#START_BLOCK_3A#
$addon_system = new Interspire_Addons();
$mta_enabled = $addon_system->isEnabled("mta");
if ($mta_enabled)
{
    $addon_mta = $addon_system->Process("mta", "GetApi", "mta");
    $addon_mta->iem_switch_smtp($this,$disconnect);
}
#END_BLOCK_3A#
#START_BLOCK_5A#
$addon_system = new Interspire_Addons();
$mta_enabled = $addon_system->isEnabled("mta");
if ($mta_enabled)
{
    $addon_mta = $addon_system->Process("mta", "GetApi", "mta");
    $addon_mta->iem_log_send_pre($this,$send_results);
}
#END_BLOCK_5A#
#START_BLOCK_5B#
$addon_system = new Interspire_Addons();
$mta_enabled = $addon_system->isEnabled("mta");
if ($mta_enabled)
{
    $addon_mta = $addon_system->Process("mta", "GetApi", "mta");
    $addon_mta->iem_log_send($this,$send_results);
}
#END_BLOCK_5B#
#START_BLOCK_6A#
$addon_system = new Interspire_Addons();
$mta_enabled = $addon_system->isEnabled("mta");
if ($mta_enabled)
{
    $addon_mta = $addon_system->Process("mta", "GetApi", "mta");
    $addon_mta->iem_mta_schedule_details($details);
}
#END_BLOCK_6A#
?>
#START_BLOCK_1A#
%%GLOBAL_MTA_SEND_SELECT_MTA%%
#END_BLOCK_1A#
#START_BLOCK_4A#
%%GLOBAL_MTA_SEND_SELECT_MTA_CONFIRM%%
#END_BLOCK_4A#
#START_BLOCK_6B#
%%GLOBAL_MTA_SCHEDULE_INFO_TITLE%%
#END_BLOCK_6B#
#START_BLOCK_6C#
%%GLOBAL_MTA_SCHEDULE_INFO_CONTENT%%
#END_BLOCK_6C#
