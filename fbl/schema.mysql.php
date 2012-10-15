<?php
$tables = array('mta_list', 'mta_group');

// the actual queries we're going to run.
$queries = array();
$queries[] = 'DROP TABLE IF EXISTS %%TABLEPREFIX%%fbl_mails';
//$queries[] = 'DROP TABLE IF EXISTS %%TABLEPREFIX%%fbl';
$queries[] = 'CREATE TABLE IF NOT EXISTS %%TABLEPREFIX%%fbl_mails (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender_address_domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `recipient_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recipient_domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_id` int(11) NOT NULL,
  `stat_id` int(11) NOT NULL,
  `interspire_domain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM';
$queries[]='CREATE TABLE IF NOT EXISTS %%TABLEPREFIX%%fbl (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT "1",
  `method` int(11) NOT NULL DEFAULT "1",
  `port` int(11) NOT NULL,
  `advanced` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE = MYISAM';