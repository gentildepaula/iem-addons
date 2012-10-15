<?php
$tables = array('mta_list', 'mta_group');

// the actual queries we're going to run.
$queries = array();

//$queries[]="DROP TABLE IF EXISTS `%%TABLEPREFIX%%addon_mta_data`";
$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_mta_data` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `port` int(11) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `mail_reply` varchar(255) NOT NULL,
  `mail_bounce` varchar(255) NOT NULL,
  `mail_test` varchar(255) NOT NULL,
  `sent` int(11) NOT NULL DEFAULT '0',
  `failed` int(11) NOT NULL DEFAULT '0',
  `blacklist` int(11) NOT NULL DEFAULT '0',
  `bounced` int(11) NOT NULL DEFAULT '0',
  `reputation` int(11) NOT NULL DEFAULT '0',
  `mta_group` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `reputation_complaint` int(11) NOT NULL DEFAULT '0',
  `reputation_volume` int(11) NOT NULL DEFAULT '0',
  `reputation_unknown` int(11) NOT NULL DEFAULT '0',
  `reputation_filtered` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
)";

//$queries[]="DROP TABLE IF EXISTS `%%TABLEPREFIX%%addon_mta_group`";
$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_mta_group` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rotation` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
)";

//$queries[]="DROP TABLE IF EXISTS `%%TABLEPREFIX%%addon_mta_ipguard`";
$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_mta_ipguard` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `dns` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
)";

//$queries[]="DROP TABLE IF EXISTS `%%TABLEPREFIX%%addon_mta_stats`";
$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_mta_stats` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `mta_uid` int(11) NOT NULL DEFAULT '0',
  `time` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `extra` text NOT NULL,
  PRIMARY KEY (`uid`)
)";
$queries[]="CREATE TABLE IF NOT EXISTS `%%TABLEPREFIX%%addon_mta_cycle` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `statid` int(11) NOT NULL DEFAULT '0',
  `pointer` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
)";
$queries_no_error=array();
$queries_no_error[]="ALTER TABLE %%TABLEPREFIX%%addon_mta_stats ADD INDEX `search` ( `time` , `mta_uid` ) ";
$queries_no_error[]="ALTER TABLE %%TABLEPREFIX%%addon_mta_stats ADD `extra` TEXT NOT NULL ";
$queries_no_error[]="ALTER TABLE %%TABLEPREFIX%%addon_mta_data ADD `blacklist_data` TEXT NOT NULL ";

$queries_no_error[]="ALTER TABLE %%TABLEPREFIX%%users ADD  `mta_group` INT NOT NULL DEFAULT  '0',ADD  `ma_mta` TEXT NOT NULL ";


