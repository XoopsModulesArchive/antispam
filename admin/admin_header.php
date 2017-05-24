<?php
/* * @copyright::  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license::    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package::    antispam
 * @subpackage:: admin
 * @since::		 2.5.0
 * @author::     Magic.Shao <magic.shao@gmail.com> - Susheng Yang <ezskyyoung@gmail.com>
**/

include("../../../mainfile.php");
include '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH."/modules/antispam/admin/functions.php";
include_once XOOPS_ROOT_PATH."/class/xoopsmodule.php";

$myts = MyTextSanitizer::getInstance();

if ( is_object( $xoopsUser)  ) {
    $xoopsModule = XoopsModule::getByDirname("antispam");
    if ( !$xoopsUser->isAdmin($xoopsModule->mid()) ) {
        redirect_header(XOOPS_URL."/",1,_NOPERM);
        exit();
    }
} else {
    redirect_header(XOOPS_URL."/",1,_NOPERM);
    exit();
}

?>