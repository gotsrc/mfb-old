<?php

	include('login.func.php');
	
	if(is_logged_in())
	{
		die('<h1>You have to be logged out to register</h1>');
	}
	
	
    function is_registering()
	{
		return isset($_POST['submit']);
    }
   
    function registerForm()
	{
        echo '
        	<form method="post">
			<div id="reg">
        		<strong>Required Information:</strong>
        	</div>
        		
			<table id="loginform" width="100%">
				<tr>
					<td width="220"><strong>Username:</strong></td>
        			<td><input type="text" name="username" id="username" maxlength="50" /></td>
        		</tr>
				
				<tr>
					<td><strong>Password:</strong></td>
        			<td><input type="password" name="password" id="password" /></td>
        		</tr>
				
				<tr>
					<td><strong>Verify Password:</strong></td>
        			<td><input type="password" name="password2" id="password2" /></td>
        		</tr>
			
				<tr>
					<td><strong>Email:</strong></td>
        			<td><input type="text" name="email" id="email" ></td>
        		</tr>
			</table>
				
				
			<div id="reg">
				<strong>Optional Information:</strong>
			</div>
				
			<table id="loginform" width="100%">
				<tr>
					<td width="220"><strong>Avatar:</strong> (96x96px)</td>
					<td><input type="text" name="avatar" id="avatar" value="images/noav.png" /></td>
				</tr>
				
				<tr>
					<td><strong>Profile Banner:</strong> (750x150px)</td>
					<td><input type="text" name="banner" value="images/nobanner.png" /></td>
				</tr>
					
				<tr>
					<td></td>
					<td><input id="submit" name="submit" type="Submit" value="Register"></td>
				</tr>
					
        	</form>
    	';
			
    }
    
    
    function register($username, $password, $password2, $email)
    {
        $username 	= 	trim(htmlentities(strip_tags($username), ENT_QUOTES, 'UTF-8'));
        $password	=	md5(trim(htmlentities(strip_tags($password), ENT_QUOTES, 'UTF-8')));
		$password2 	= 	md5(trim(htmlentities(strip_tags($password2), ENT_QUOTES, 'UTF-8')));
		
		require_once('./data/includes/config.inc.php');	
		
		mysql_connect ($database['host'], $database['user'], $database['pass']) or die ('Cannot connect to the database.');
		mysql_select_db ($database['db']);  //reselectdatabase	

		$username = mysql_real_escape_string($username);

		$ip 	= 	$_SERVER['REMOTE_ADDR'];
		$avatar = 	$_POST['avatar'];
		$cash 	= 	"10000";
		$rank 	= 	"Outsider";
		$exp 	= 	"000/170";
		$health = 	"100";
		$banner = 	$_POST['banner'];
		
		$querys = 	"Select * from users WHERE username='$username'";
		
		$result = 	mysql_query($querys);
		$row 	= 	mysql_num_rows($result);
		
		if($row > 0)
		{
        	die('Username is already taken');
        	registerForm();
			exit;
        } 
        else 
        {
			$register ="INSERT INTO `users` VALUES (NULL , 
															'$username',
															'$password',
															'$email',
															'$avatar',
															'$rank',
															'$cash',
															'$exp',
															'$health',
															'$banner',
															CURRENT_TIMESTAMP,
															'1',
															'$ip')";
															
			$result = mysql_query($register) or die(mysql_error());
			
			echo 'Thank you for registering ' . $username . '. You will be now redirected to the login in 5 seconds.';	
			echo '<meta http-equiv="refresh" content="5;url=index.php?act=login">';
        }

    }
?>
