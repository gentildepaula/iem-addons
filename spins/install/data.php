<?php
#START_BLOCK_A1#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
    $name=$sp->spin($name);
}
#END_BLOCK_A1#
#START_BLOCK_A2#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
	$body=$sp->spin($body);
    $body=$sp->rotate_url($body);
    $subject=$sp->spin($subject);
}
#END_BLOCK_A2#
#START_BLOCK_1A#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
	$sp->iem_spin($this,$disconnect);
}
#END_BLOCK_1A#
#START_BLOCK_2A#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
	$sp->iem_spin_into_ss_email($this,$disconnect_from_smtp);
}
#END_BLOCK_2A#
#START_BLOCK_2B#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
	$sp->iem_spin_into_ss_email_body($this,$body);
}
#END_BLOCK_2B#
#START_BLOCK_2C#
if (isset($GLOBALS['addon_spins_class']))
{
	$addon_spins = $GLOBALS['addon_spins_class'];
	$addon_system = new Interspire_Addons();
	$spins_enabled = $addon_system->isEnabled("spins");
	if ($spins_enabled) {
		$sp = $addon_system->Process("spins", "GetApi", "spins");
		$text = str_replace('List-Unsubscribe: <%%HEADER_UNSUBSCRIBELINK%%>', 'List-Unsubscribe: <' . $sp->rotate_url($unsubscribelink) . '>', $text);
	}
	else
	{
		$text = str_replace('List-Unsubscribe: <%%HEADER_UNSUBSCRIBELINK%%>', 'List-Unsubscribe: <' . $unsubscribelink . '>', $text);
	}
}
#END_BLOCK_2C#
#START_BLOCK_A4#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
	$this->_AssembledEmail['Headers']['t'] = null;
	$this->_AssembledEmail['Headers']['h'] = null;
	$this->_AssembledEmail['Headers']['m'] = null;
}
#END_BLOCK_A4#
#START_BLOCK_A4_A#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$headers = 'Return-Path: ' . $sp->spin($this->BounceAddress) . $this->_newline;
}
else 
{
		$headers = 'Return-Path: ' . $this->BounceAddress . $this->_newline;
}
#END_BLOCK_A4_A#
#START_BLOCK_A4_B#
if ($spins_enabled) {
	$headers .= '"' . $this->_utf8_encode($sp->spin($this->FromName)) . '" ';
}
else 
{
	$headers .= '"' . $this->_utf8_encode($this->FromName) . '" ';
}
#END_BLOCK_A4_B#
#START_BLOCK_A4_C#
if ($spins_enabled) {
	$headers .= '<' . $sp->spin($this->FromAddress) . '>' . $this->_newline;
}
else 
{
	$headers .= '<' . $this->FromAddress . '>' . $this->_newline;
}
#END_BLOCK_A4_C#
#START_BLOCK_A4_D#
if ($spins_enabled) {
	$headers .= 'Reply-To: ' . $sp->spin($this->ReplyTo) . $this->_newline;
}
else 
{
	$headers .= 'Reply-To: ' . $this->ReplyTo . $this->_newline;
}
#END_BLOCK_A4_D#
#START_BLOCK_A4_E#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$sp = $addon_system->Process("spins", "GetApi", "spins");
}
#END_BLOCK_A4_E#
#START_BLOCK_A4_F#
if ($spins_enabled) {
	$cmds[] = "MAIL FROM:<" . $sp->spin($this->BounceAddress) . ">";
}
else 
{
	$cmds[] = "MAIL FROM:<" . $this->BounceAddress . ">";
}
#END_BLOCK_A4_F#
#START_BLOCK_A4_G#
if ($spins_enabled) {
	$data = "MAIL FROM:<" . $sp->spin($this->BounceAddress) . ">";
}
else 
{
	$data = "MAIL FROM:<" . $this->BounceAddress . ">";
}
#END_BLOCK_A4_G#
#START_BLOCK_A5#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	$this->_AssembledEmail['Body']['t']=null;
	$this->_AssembledEmail['Body']['h']=null;
}
#END_BLOCK_A5#
#START_BLOCK_A6#
$addon_system = new Interspire_Addons();
$spins_enabled = $addon_system->isEnabled("spins");
if ($spins_enabled) {
	
}
else 
{
	$extra_headers[] = 'List-Unsubscribe: <%%HEADER_UNSUBSCRIBELINK%%>';
}
#END_BLOCK_A6#
#START_BLOCK_3A#
if (isset($GLOBALS['addon_spins_class']))
{
	$addon_spins = $GLOBALS['addon_spins_class'];
	$addon_system = new Interspire_Addons();
	$spins_enabled = $addon_system->isEnabled("spins");
	if ($spins_enabled) {
		$sp = $addon_system->Process("spins", "GetApi", "spins");
		$mid=$sp->rotate_url($this->message_id_server);
		$message_id = 'Message-ID: <' . $semi_rand . '@' . $mid . '>' . $this->_newline;
	}
	else
	{
		$message_id = 'Message-ID: <' . $semi_rand . '@' . $this->message_id_server . '>' . $this->_newline;
	}
}
#END_BLOCK_3A#
?>