<?php

require_once('data/includes/config.inc.php');

require_once('data/functions/bbcode.func.php');
require_once ('./data/functions/online.func.php');

include('data/includes/header.php');

include('data/includes/statusbar.php');

include('data/includes/left.php');
Useruptable();
if(isset($_SESSION['MFB_username'])) {
echo '<div id="content">';
$p = $_GET['page'];
if ( !empty($p) && file_exists('./data/modules/' . $p . '.php') && stristr( $p, '.' ) == False ) 
{
   $file = './data/modules/' . $p . '.php';
}
else
{
   $file = './data/modules/welcome.php';
}
include $file;
echo '</div>';
}else{
echo '<div id="content">';
$file = './data/modules/notloggedin.php';
include $file;
echo '</div>';
echo '<meta http-equiv="refresh" content="3;url=index.php?act=login">';
}
include('data/includes/footer.php');


?>
