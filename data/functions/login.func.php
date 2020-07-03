<?php
session_start();

	/* Check to see if the user is logged in. */
	function is_logged_in()
	{
		return isset($_SESSION['loggedIn']);
	}
    
	function is_logging_in()
	{
		return isset($_POST['submit']);
	}
    
	function loginForm()
	{
		print '<form method="post">
		<td><strong>Username:</strong></td><td><input type="text" name="username" /></td></tr><tr>
		<td><strong>Password:</strong> </td><td><input type="password" name="password" /><br /></td>
		</tr><tr><td></td><td><input type="submit" name="submit" value="Login" /></td>
		</form>';
	}

	function login($username, $password)
	{
		$username = trim(htmlentities(strip_tags($username), ENT_QUOTES, 'UTF-8'));
		$username = ucwords($username);
		$password = md5(trim(htmlentities(strip_tags($password), ENT_QUOTES, 'UTF-8')));

		include('./data/includes/config.inc.php');
		
		mysql_connect ($database[host], $database[user], $database[pass]) or die ('Cannot connect to the database.');
		mysql_select_db ($database[db]);  //reselectdatabase	 

		$querys = "Select * from mfb_accounts WHERE username='$username'";
		$result = mysql_query($querys);
		$row = mysql_num_rows($result);
		
		$query = "SELECT * FROM mfb_accounts WHERE username = '". mysql_real_escape_string($username)."' AND password = '". mysql_real_escape_string($password)."'";
		$result = mysql_query($query);
		$row = mysql_num_rows($result);

		if($row > 0)
		{

			$_SESSION['loggedIn'] = true;
			$_SESSION['MFB_username'] = $username;
			header("Location: game.php");
			exit;
            
		}
		else
		{

			$ip = $_SERVER['REMOTE_ADDR'];
			echo '<strong>Bad login!</strong>
			<p>For security purposes your I.P: ' . $ip . ' has been logged along with the username of ' . $username . ' to our database.</p>';
			$q = "INSERT INTO `mfb_login_attempts` VALUES (NULL, '$ip', '$_POST[username]', '$_POST[password]', CURRENT_TIMESTAMP)";
			$result = mysql_query($q)or die(mysql_error());
			loginForm();
			exit;

		}
       
	}
?>