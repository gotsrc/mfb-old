<?php
include('data/functions/login.func.php');
if(is_logged_in()) {
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;url=index.php?act=login">';
}
?>
