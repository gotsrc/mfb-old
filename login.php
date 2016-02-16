<?php
include('data/functions/login.func.php');
if(is_logged_in()){
          echo '<meta http-equiv="refresh" content="1;url=game.php">';
   
    } elseif(is_logging_in()){
        login($_POST['username'], $_POST['password']);
   
    } else {
    	echo '<div id="logreg">Login to Money for Blood</div><table id="loginform">
    	      <tr>';
        loginForm();
        echo '</tr></table>';
    }
	?>
