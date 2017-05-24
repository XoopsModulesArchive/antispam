<?php
/**
 * $Id: modinfo.php,v 1.7 2008/10/13 11:52:53 xoops Exp $
 * Module: badbehavior
 * Version: v 1.00
 * Author: yerres
 * Licence: GNU
 */


// Module Info
// The name of this module
global $xoopsModule;
define("_MI_BB2_MD_NAME","Antispam");

// A brief description of this module
define("_MI_BB2_MD_DESC","spam protection module");

// module options
$cf=1;
define("_MI_BB2_STRICT_MODE","$cf. Enable strict mode ?");
define("_MI_BB2_STRICT_MODEDSC","Enable strict checking (blocks more spam but may block some people)");
$cf++;
define("_MI_BB2_VERBOSE","$cf. Enable verbose logging ?"); 
define("_MI_BB2_VERBOSEDSC","Enables or disables verbose logging which includes all requests, not just failed ones"); 
$cf++;
define("_MI_BB2_ALERTMAIL","$cf. Webmaster-Mail");
define("_MI_BB2_ALERTMAILDSC","Administrator email address for blocked users to contact to gain access");
$cf++;
define("_MI_BB2_HTTPBLKEY","$cf. Optionally enter your Honeypot-ID here");
define("_MI_BB2_HTTPBLKEYDSC","If you want to use HTTP:BL with BadBehavior, get a HTTP:BL key from Project HoneyPot");

// Names of admin menu items
define("_MI_BB2_ADMENU0","Index");
define("_MI_BB2_ADMENU1","Statistik");
// Names of admin header menu items
define('_MI_BB2_HDMENU0','refresh Modul Templates');
define("_MI_BB2_HDMENU1","About");

?>