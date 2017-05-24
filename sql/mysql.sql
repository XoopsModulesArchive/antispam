-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 19. Oktober 2008 um 14:02
-- Server Version: 5.0.45
-- PHP-Version: 5.2.3
-- Datenbank: `xoops`

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `antispam_log`
-- 

CREATE TABLE `antispam_log` (
  `id` INT(11) NOT NULL auto_increment,
  `ip` varchar(20) NOT NULL,
  `date` DATETIME NOT NULL default '0000-00-00 00:00:00',
  `request_method` varchar(20) NOT NULL,
  `request_uri` TEXT NOT NULL,
  `server_protocol` varchar(20) NOT NULL,
  `http_headers` TEXT NOT NULL,
  `user_agent` varchar(100) NOT NULL,
  `request_entity` TEXT NOT NULL,
  `key` varchar(20) NOT NULL default '',
  KEY `ip` (`ip`(15)),
  PRIMARY KEY (`id`),
  INDEX (`ip`(15)),
	INDEX (`user_agent`(10))
  ) ENGINE=MyISAM ;
