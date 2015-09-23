<?php
/**
 * $Id: menu.php,v 1.7 2012/05/31 11:52:53 yerres Exp $
 * Module: antispam aka bad behavior
 * 
 * Licence: GNU
 */

global $xoopsModule;
$i = 0;
$adminmenu[$i]['title'] = _MI_BB2_ADMENU1;
$adminmenu[$i]['link'] = "admin/index.php";


if (isset($xoopsModule) && ($xoopsModule->getVar('dirname') == 'antispam')) {
    $i=0;
    $headermenu[$i]['title'] = _PREFERENCES;
    $headermenu[$i]['link'] = '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid');

    #$i++;
    #$headermenu[$i]['title'] = _MI_BB2_HDMENU0;
    #$headermenu[$i]['link'] = XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=" . $xoopsModule->getVar('dirname');

    $i++;
    $headermenu[$i]['title'] = _MI_BB2_HDMENU1;
    $headermenu[$i]['link'] = XOOPS_URL . "/modules/antispam/admin/about.php";

}
?>