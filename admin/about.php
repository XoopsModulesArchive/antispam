<?php
/**
 * Module: antispam
 * Version: v 1.00 beta
 * Release Date: 31 May 2012
 * Author: Yerres
 * Licence: GNU
 */
 

include( "admin_header.php" );
xoops_cp_header();
$myts = MyTextSanitizer::getInstance();
bb2_adminmenu(1, _INFO);


$module_handler =& xoops_gethandler('module');
$versioninfo =& $module_handler->get($xoopsModule->getVar('mid'));
echo "
	<style type=\"text/css\">
	/* ===== about ===== */
	.about {
	line-height:150%;
	padding:5px 25px 25px 25px;
	border:3px dashed #DAE0D2;
	margin:10px;
	}
	.about h4 {
	margin:25px 0 10px 0;
	padding:5px 5px 5px 32px;
	font-size:15px;
	color:#882200;
	border-left:5px solid #D5D0BA;
	border-bottom:1px solid #DAE0D2;
	background:#ffffff url('../images/attention.gif') no-repeat 8px 5px;
	}
	.about h5 {
	font-size:14px;
	color:#882200;
	margin:25px 0 5px 10px;
	padding:0px 2px 0px 10px;
	border-left:13px solid #D5D0BA;
	}
	.about a {
	color:darkblue;
	text-decoration:underline;
	font-weight:bold;
	margin:0 0.5em;
	}
	.about p {
	padding:5px 20px;
	}
	.about ul {
	margin-left:15px;
	}
	.about ol {
	margin:2px 2px 2px 20px;
	padding:2px;
	list-style:decimal outside;
	}
	.about li {
	padding:3px 0;
	}
</style>";
/**
 * display module info
 */

global $xoopsConfig, $xoopsModuleConfig, $xoopsModule, $versioninfo;

echo "<br clear=\"all\" />";
echo "<div class='about'>
<img src='".XOOPS_URL."/modules/".$xoopsModule->dirname()."/".$versioninfo->getInfo('image')."' alt='' hspace='0' vspace='0' align='left' style='margin-right: 10px; '><P><BR>
<P>&nbsp;</P>
<h4>".$versioninfo->getInfo('name')." v. ".$versioninfo->getInfo('version')." ".$versioninfo->getInfo('module_status')."</h4>";
if ($versioninfo->getInfo('author_realname') != '') {
    $author_name = $versioninfo->getInfo('author')." (".$versioninfo->getInfo('author_realname').")";
} else {
    $author_name = $versioninfo->getInfo('author');
}
echo "<br clear=\"all\" /><BR />";

echo "<h5>" . $versioninfo->getInfo( 'name' ) . " " . $versioninfo->getInfo( 'version' ) . "</h5>";

echo "<UL><li>" . _AM_BB2_ABOUT_RELEASEDATE . ":</h4><text>" . $versioninfo->getInfo( 'release' ) . "</text>";
echo "<li>" . _AM_BB2_ABOUT_AUTHOR . ":<text>" . $versioninfo->getInfo( 'author' ) . "</text></li>";
echo "<li>" . _AM_BB2_ABOUT_CREDITS . ":<text>" . $versioninfo->getInfo( 'credits' ) . "</text></li>";
echo "<li>" . _AM_BB2_ABOUT_LICENSE . ":<text><a href=\"".$versioninfo->getInfo( 'license_file' )."\" target=\"_blank\" >" . $versioninfo->getInfo( 'license' ) . "</a></text></li>\n";
echo "</UL>";
echo "<br clear=\"all\" />";

// info
echo "<h5>". _AM_BB2_ABOUT_MODULE_INFO ."</h5>";

echo "<UL><li>" . _AM_BB2_ABOUT_MODULE_STATUS . ": <text>" . $versioninfo->getInfo( 'module_status' ) . "</text></LI>";
echo "</UL>";
echo "<br clear=\"all\" />";


echo "<h5>". _AM_BB2_ABOUT_DISCLAIMER_TEXT ."</h5>";
//echo "<UL><li>". _AM_BB2_ABOUT_DISCLAIMER_TEXT_1 ."</li></UL>";
echo "<br clear=\"all\" />";

$file = XOOPS_ROOT_PATH. "/modules/" . $xoopsModule->dirname()."/readme.txt";
if ( is_readable( $file ) ) {
    echo "<h4>". _AM_BB2_ABOUT_README ."</h4>";
    echo "". implode("<br />", file( $file )) . "";
    echo "</UL>";
    echo "<br clear=\"all\" />";
}
//---
echo "<br clear=\"all\" />";
$file = XOOPS_ROOT_PATH. "/modules/" . $xoopsModule->dirname()."/changelog.txt";
if ( is_readable( $file ) ) {
    echo "<h4>". _AM_BB2_ABOUT_CHANGELOG ."</h4>";
    echo "". implode("<br />", file( $file )) . "";
}


xoops_cp_footer();
?>