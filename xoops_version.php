<?php
/**
 * spam prevention Module
 *
 * @copyright	  The XOOPS project http://www.xoops.org/
 * @license		  http://www.fsf.org/copyleft/gpl.html GNU public license
 * @since	      1.00 beta
 * @version	    $Id$
 * @package     module::Antispam
 * @credits     badbehavior
 */

if( ! defined( 'XOOPS_ROOT_PATH' ) ) die( 'XOOPS root path not defined' ) ;

$modversion['name'] = _MI_BB2_MD_NAME;
$modversion['version'] = "1.0";
$modversion['description'] = _MI_BB2_MD_DESC;
$modversion['author'] = "Yerres";
$modversion['credits'] = "Michael Hampton; Project Honeypot, The Xoops community";
$modversion["help"] = "readme.txt";
$modversion['official'] = 0;
$modversion['image'] = "images/bb2_slogo.png";
$modversion['dirname'] = "antispam";

$modversion["license"] = "GNU GPL 2.0";
$modversion["license_file"] = XOOPS_URL."/modules/antispam/gpl.txt";
$modversion['license_url'] = "www.gnu.org/licenses/gpl-2.0.html/"; 
$modversion["module_status"] = "beta";
$modversion['status_version'] = 'beta'; 
$modversion["release"] = "2012-05-31";
$modversion['release_date'] = '2012-05-31'; 
$modversion['last_update'] = '2012-05-31'; 
$modversion['min_php']=5.2;
$modversion['min_xoops']="XOOPS 2.0"; 



// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Sql
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][0] = 'antispam_log';

// modversion
$modversion['hasSearch'] = 0;
$modversion['hasMain'] = 0;
$modversion['blocks']	= 0;
$modversion['templates']	= 0;
$modversion['hasComments'] = 0;
$modversion['hasNotification'] = 0;


// Config Settings
$modversion["config"] = array();

$modversion['config'][1] = array(
	'name' 			=> 'strictmode',
	'title' 		=> '_MI_BB2_STRICT_MODE',
	'description' 	=> '_MI_BB2_STRICT_MODEDSC',
	'formtype' 		=> 'yesno',
	'valuetype' 	=> 'int',
	'default' 		=> 0 );

$modversion['config'][] = array(
	'name' 			=> 'verboselogging',
	'title' 		=> '_MI_BB2_VERBOSE',
	'description' 	=> '_MI_BB2_VERBOSEDSC',
	'formtype' 		=> 'yesno',
	'valuetype' 	=> 'int',
	'default' 		=> 0 );
	
$modversion['config'][] = array(
	'name' 			=> 'antispam_email',
	'title' 		=> '_MI_BB2_ALERTMAIL',
	'description' 	=> '_MI_BB2_ALERTMAILDSC',
	'formtype' 		=> 'textbox',
	'valuetype' 	=> 'text',
	'default' 		=> 'badbots-at-ioerror.us');

$modversion['config'][] = array(
	'name' 			=> 'honeypot_key',
	'title' 		=> '_MI_BB2_HTTPBLKEY',
	'description' 	=> '_MI_BB2_HTTPBLKEYDSC',
	'formtype' 		=> 'textbox',
	'valuetype' 	=> 'text',
	'default' 		=> '');	


?>