<?php
/**
 * Module: antispam
 * Version: v 1.00
 * Licence: GNU
 */

include( "admin_header.php" );
xoops_cp_header();
bb2_adminMenu(0, _AM_BB2_INVENTORY);

require_once '../../../include/cp_header.php';

$op = '';
if ( isset( $_GET['op'] ) ) $op = $_GET['op'];
if ( isset( $_POST['op'] ) ) $op = $_POST['op'];

function showrecords() {
    global $xoopsDB, $xoopsModuleConfig;
    $myts = MyTextSanitizer::getInstance();
    // load our main include
    //require_once '../bad-behavior-xoops.php';
    //bb2_insert_stats($force = 0);
    //----------------
    
    include_once XOOPS_ROOT_PATH . "/class/xoopslists.php";
    include_once XOOPS_ROOT_PATH . "/class/pagenav.php";
    $myts = MyTextSanitizer::getInstance();
    $startlog = isset( $_GET['startlog'] ) ? intval( $_GET['startlog'] ) : 0;
    $resultA1 = $xoopsDB -> query( "SELECT COUNT(*)
                                   FROM " . $xoopsDB -> prefix( "antispam_log" ) . "
                                   WHERE date > 0" );
    list( $numrows ) = $xoopsDB -> fetchRow( $resultA1 );
     if ( $numrows > 0 ){
        $sql = "SELECT id, ip, date, request_method, request_uri, server_protocol, http_headers, user_agent, request_entity, `key` 
               FROM ".$xoopsDB->prefix('antispam_log')." ";
       $sql .= " WHERE date > 0 ";
       if ($xoopsModuleConfig['verboselogging'] == 0) {
          //$sql .= " AND `key` != '00000000' ";
        }
        $sql .= " ORDER BY id DESC";
         
        $resultA2 = $xoopsDB -> query( $sql, 50, $startlog );
    }
    
    if (file_exists(BB2_CWD .'/bad-behavior/core.inc.php') && file_exists(BB2_CWD .'/bad-behavior/version.inc.php') && file_exists(BB2_CWD .'/bad-behavior/responses.inc.php')) {
      require_once(BB2_CWD .'/bad-behavior/version.inc.php');
      require_once(BB2_CWD .'/bad-behavior/core.inc.php');
      require_once(BB2_CWD .'/bad-behavior/responses.inc.php');
    } else {
      echo 'Bad Behavior is not installed correctly.';
    }    

		echo "&nbsp; <br /><br />";   
		bb2_loglistheader( _AM_BB2_SHOWRECS);
    if ( $numrows > 0 ){
        while ( list( $id, $ip, $date, $request_method, $request_uri, $server_protocol, $http_headers, $user_agent, $request_entity, $key ) = $xoopsDB -> fetchrow( $resultA2 ) ) {

            $request_uri = $myts -> htmlSpecialChars(xoops_substr( strip_tags( $request_uri ),0,40));
            $http_headers = $myts -> htmlSpecialChars(xoops_substr( strip_tags( $http_headers ),0,40));
            $user_agent = $myts -> htmlSpecialChars(xoops_substr( strip_tags( $user_agent ),0,25));
            $request_entity = $myts -> htmlSpecialChars(xoops_substr( strip_tags( $request_entity ),0,20));
            $response = bb2_get_response($key);

            echo "<tr>";
            echo "<td class='even' align='center'>" . $response['response'] . "</td>";
            echo "<td class='odd' align='left'>" . $date . "</td>";
            echo "<td class='odd' align='left'>" . $ip . "</td>";
            echo "<td class='odd' align='center'>" . $user_agent . "</td>
            <td class='odd' align='center'><a href='index.php?op=detail&id=" . $id . "'>" . _AM_BB2_DETAILS . "</A></td>
            </tr></DIV>";
        }
    } else { // there's no records
        echo "<tr>";
        echo "<td class='odd' align='center' colspan= '11'>" . _AM_BB2_NORECS . "</td>";
        echo "</tr></DIV></DIV>";
    }
    echo "</table>\n";
    
    $pagenav = new XoopsPageNav( $numrows, 50, $startlog, 'startlog');
    echo '<div style="text-align:right;">' . $pagenav -> renderNav(4) . '</div>';
    echo "<br /><BR>\n";
    echo "</div>";
    echo "</fieldset><br />";
}

function showdetails($id = '') {
  global $xoopsDB;
  $myts = MyTextSanitizer::getInstance();
  $id = ( isset( $_GET['id'] ) ) ? intval($_GET['id']) : intval($_POST['id']);


  if (file_exists(BB2_CWD .'/bad-behavior/core.inc.php') && file_exists(BB2_CWD .'/bad-behavior/version.inc.php') && file_exists(BB2_CWD .'/bad-behavior/responses.inc.php')) {
    require_once(BB2_CWD .'/bad-behavior/version.inc.php');
    require_once(BB2_CWD .'/bad-behavior/core.inc.php');
    require_once(BB2_CWD .'/bad-behavior/responses.inc.php');
  } else {
    echo 'Bad Behavior is not installed correctly.';
  }
    
    
  $resultA1 = $xoopsDB -> query( "SELECT COUNT(*)
                                 FROM " . $xoopsDB -> prefix( "antispam_log" ) . "
                                 WHERE date > 0" );
  list( $numrows ) = $xoopsDB -> fetchRow( $resultA1 );
   if ( $id ) {
        $sql = "SELECT id, ip, date, request_method, request_uri, server_protocol, http_headers, user_agent, request_entity, `key` 
               FROM ".$xoopsDB->prefix('antispam_log')."
               WHERE id =$id  ";
        $resultA2 = $xoopsDB -> query( $sql);
        list( $id, $ip, $date, $request_method, $request_uri, $server_protocol, $http_headers, $user_agent, $request_entity, $key) = $xoopsDB -> fetchrow( $resultA2 );
        $response = bb2_get_response($key);
        if ( !$xoopsDB -> getRowsNum( $resultA2 ) ) {
            redirect_header( "index.php", 1, _AM_LX_NOENTRYTOEDIT );
            exit();
        }
    
    echo "&nbsp; <br /><br />";
    echo "<table class='outer' width='100%' border='0'><tr><td colspan='2' class='head'>
    <strong>" . _AM_BB2_DETAILS . "</strong></td></TR>";
    echo "<tr><td width='40' class='even' align='left'><b>" . _AM_BB2_ID . "</A></b></td>";
      echo "<td class='odd' align='left'>" . $id . "</td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" . _AM_BB2_IP . "</b></td>";
      echo "<td class='odd' align='left'>" . gethostbyaddr($ip) . " (<a href='http://www.whois.sc/$ip' target='_new'>whois</A>)</td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" . _AM_BB2_DATE . "</b></td>";
      echo "<td class='odd' align='left'>" . $date . "</td></tr>";
    echo "<tr><td width='90' class='even' align='left'><b>" . _AM_BB2_REQUEST_METHOD . "</b></td>";
      echo "<td class='odd'align='left'>" . $request_method . "</td></tr>";
    echo "<tr><td width='50' class='even' align='left'><b>" . _AM_BB2_REQUEST_URI . "</b></td>";
      echo "<td class='odd' align='left'>" . $request_uri . "</td></tr>";
    echo "<tr><td width='50' class='even' align='left'><b>" . _AM_BB2_SERVER_PROTOCOL . "</b></td>";
      echo "<td class='odd' align='left'>" . $server_protocol . "</td></tr>";
    echo "<tr><td width='50' class='even' align='left'><b>" . _AM_BB2_HTTP_HEADERS . "</b></td>";
      echo "<td class='odd' align='left'><span style='white-space:wrap; font-size:smaller;'>" . $http_headers . "</span></td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" . _AM_BB2_USER_AGENT. "</b></td>";
      echo "<td class='odd' align='left'>" . $user_agent . "</td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" . _AM_BB2_REQUEST_ENTITY . "</b></td>";
      echo "<td class='odd' align='left'>" . $request_entity . "</td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" . _AM_BB2_KEY . "</b></td>";
      echo "<td class='odd' align='left'>" . $response['response'] . "</td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" ._AM_BB2_REASON . "</b></td>";
        echo "<td class='odd' align='left'>" . $response['log'] . "</td></tr>";
    echo "<tr><td width='30' class='even' align='left'><b>" . _AM_BB2_EXP . "</b></td>";
      echo "<td class='odd' align='left'>" . $response['explanation'] . "</td></tr>";
    
      
    echo "</table>\n";
  } else {// there's no records
          redirect_header( "index.php", 1, _AM_LX_NEEDONECOLUMN );
          exit();
       }
  echo '<div style="text-align:right;"><a href="index.php">' . _BACK. '</A></div>';
  echo "<br /><br/>\n";
}


switch ( $op ) {
  case "detail":
    $id = ( isset( $_GET['id'] ) ) ? intval($_GET['id']) : intval($_POST['id']);
		showdetails($id);
		break;
	
	case "default":
	default:
		showrecords();
		break;
	}
	
xoops_cp_footer();
?>