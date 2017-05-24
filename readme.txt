
Module Purpose
==============
Antispam Module is designed as a spam-detection and prevention application for the XOOPS portal system. 
It makes use of Michael Hampton's Spam detection Service Badbehavior.
Stop comment spam before it starts by trapping and blocking spambots before they have a chance to post comments.
The Antispam module examines HTTP requests of visits to your web site, and any suspicious requests are logged for later review.  
The suspicious visit is shown an error page with instructions on how to view the site without triggering the bad behavior error message.

The module can be used with Project HoneyPot.
Get a HTTP:BL key at http://www.projecthoneypot.org/httpbl.php


Installation Requirements
=========================
XOOPS 2.0+
HoneyPot ID optional => http://www.projecthoneypot.org/httpbl_api.php

To keep this Module up to date you must download a recent version Bad Behavior from:
http://www.bad-behavior.ioerror.us/download/


Install Instructions
====================
Antispam is installed as a regular XOOPS module:
1. Copy the complete antispam folder into the /modules directory of your website.
2. Upload the files to your website: XOOPS_ROOT_URL/modules/antispam
3. Log in to your site as administrator.
4. Update (or Install) the module using the XOOPS module administration panel at 'System Admin -> Modules'.


The following line of code has to be added to mainfile.php:

    // Call Antispam module
    require_once( XOOPS_ROOT_PATH .  '/modules/antispam/bad-behavior-xoops.php');

Add the code snippet to mainfile.php just after

	if (!isset($xoopsOption['nocommon']) && XOOPS_ROOT_PATH != '') {
		include XOOPS_ROOT_PATH."/include/common.php";
	}


in other words: just before the closing tags
}
?>




BETA VERSION 
==============
This version is still under development which means there are errors to be expected. 
The application protects the site effectively BUT recording seems to work properly only with XOOPS 2.0 / 2.3.
The module should thus not be used on productive sites.


Credits
=======
Bad Behaviour Spam detection: http://www.bad-behavior.ioerror.us
Project HoneyPot: http://www.projecthoneypot.org
Virtech's Module Netquery is a more sophisticated approach to BB2:
Netquery Module: http://virtech.org/xoops/modules/netquery/index.php
