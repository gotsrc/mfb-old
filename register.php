<?php
include('data/functions/register.func.php');
if(is_registering()){
        register($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['email']);
   
    } else {
    	echo '<div id="logreg">Register your Account!</div><table id="loginform">
    	      <tr>';
        registerForm();
        echo '</tr></table>';
    }
	?>
