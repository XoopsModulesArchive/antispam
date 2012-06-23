<?php
/*
Bad Behavior - detects and blocks unwanted Web accesses
Copyright (C) 2005-2006 Michael Hampton

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

As a special exemption, you may link this program with any of the
programs listed below, regardless of the license terms of those
programs, and distribute the resulting program, without including the
source code for such programs: ExpressionEngine

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

Please report any problems to badbots AT ioerror DOT us
*/

###############################################################################
###############################################################################

define('BB2_CWD', dirname(__FILE__));
if( ! defined( 'XOOPS_ROOT_PATH' ) )  die( 'XOOPS root path not defined' ) ;
$module_handler = &xoops_gethandler('module');
$bb2 = &$module_handler->getByDirname('antispam');

if (!isset($bb2Config)&& (is_object($bb2)) ) {
    $config_handler = &xoops_gethandler('config');
    $bb2Config = &$config_handler->getConfigsByCat(0, $bb2->getVar('mid'));
}
global $xoopsDB, $cfg, $bb2_settings_defaults;
// Settings you can adjust for Bad Behavior.
// Most of these are unused in non-database mode.
	$strict = $bb2Config['strictmode'];
	$verbose = $bb2Config['verboselogging'];
	$httpbl_key = $bb2Config['honeypot_key'];
	//$strict = $xoopsModuleConfig['strictmode'];
	//$verbose = $xoopsModuleConfig['verboselogging'];
	//$httpbl_key = $xoopsModuleConfig['honeypot_key'];
$bb2_settings_defaults = array(
	'log_table' => $xoopsDB->prefix('antispam_log'),
	'display_stats' => true,
	'strict' => $strict,
	'verbose' => $verbose,
	'logging' => true,
	'httpbl_key' => $httpbl_key,
	'httpbl_threat' => '25',
	'httpbl_maxage' => '30',
);

// Bad Behavior callback functions.

// Return current time in the format preferred by your database.
function bb2_db_date() {
	return gmdate('Y-m-d H:i:s');	// Example is MySQL format
}

// Return affected rows from most recent query.
function bb2_db_affected_rows() {
	$db =& Database::getInstance();
	return $db->getAffectedRows();
}

// Escape a string for database usage
function bb2_db_escape($string) {
	// return mysql_real_escape_string($string);
	$myts =& MyTextSanitizer::getInstance();
	return  $myts->addSlashes(xoops_trim($string));
	//return $string;	// No-op when database not in use.
}

// Return the number of rows in a particular query.
function bb2_db_num_rows($result) {
	$db =& Database::getInstance(); //test
	return $db->getRowsNum($result);
}

// Run a query and return the results, if any.
// Should return FALSE if an error occurred.
// Bad Behavior will use the return value here in other callbacks.
function bb2_db_query($query) {
  $db =& Database::getInstance();
  $result = $db->queryF( $query );
	if ($db->error()!='') {
    echo "<br>".$msg . " <BR><font size=1> -  ERROR: ".$db->error()."</font>.<BR>";
		return FALSE;
	}
	if (!$result)
    return FALSE;
  return $result;
}

// Return all rows in a particular query.
// Should contain an array of all rows generated by calling mysql_fetch_assoc()
// or equivalent and appending the result of each call to an array.
function bb2_db_rows($result) {
  $db =& Database::getInstance();
  $result = $db->fetchboth($result);
	return $result;
}

// Return emergency contact email address.
function bb2_email() {
  global $bb2Config;
	// return "example@example.com";	// You need to change this.
	$antispam_email =  $bb2Config['antispam_email'];
	return $antispam_email;
}

// retrieve settings from database
// Settings are hard-coded for non-database use
function bb2_read_settings() {
	global $bb2_settings_defaults;
	return $bb2_settings_defaults;
}

// write settings to database
function bb2_write_settings($settings) {
	$db =& Database::getInstance();
	return true;
}

// installation
function bb2_install() {
	#$settings = bb2_read_settings();
	#return bb2_db_query(bb2_table_structure($settings['log_table']));
	return false;
}

// Screener
// Insert this into the <head> section of your HTML through a template call
// or whatever is appropriate. This is optional we'll fall back to cookies
// if you don't use it.
function bb2_insert_head() {
	global $bb2_javascript;
	echo $bb2_javascript;
	#echo "\n<!-- Bad Behavior " . BB2_VERSION . " run time: " . number_format(1000 * $bb2_timer_total, 3) . " ms -->\n";	
}

// Display stats? This is optional.
function bb2_insert_stats($force = false) {
	$settings = bb2_read_settings();
	global $xoopsDB;
	$db =& Database::getInstance();

	if ($force || $settings['display_stats']) {
		$blocked = bb2_db_query("SELECT COUNT(*) FROM " . $settings['log_table'] . " WHERE `key` NOT LIKE '00000000'");
		if ($blocked !== FALSE) {
			echo sprintf('<p><a href="http://www.bad-behavior.ioerror.us/">%1$s</a> %2$s <strong>%3$s</strong> %4$s</p>', __('Bad Behavior'), __('has blocked'), $blocked[0]["COUNT(*)"], __('access attempts in the last 7 days.'));
		}
	}
}

// Return the top-level relative path of wherever we are (for cookies)
// You should provide in $url the top-level URL for your site.
function bb2_relative_path() {
	//$url = parse_url(get_bloginfo('url'));
	//return $url['path'] . '/';
	return '/';
}

// Calls inward to Bad Behavor itself.
require_once(BB2_CWD . "/bad-behavior/version.inc.php");
require_once(BB2_CWD . "/bad-behavior/core.inc.php");
bb2_install();	// FIXME: see above

bb2_start(bb2_read_settings());

?>
