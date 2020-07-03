<?php
    
    function is_posting()
    {
        return isset($_POST['post']);
    }
    
	function updateForm()
	{
		echo '<p class="heading">Send an Update!</p>
		<div id="updates"><form method="post">
		<label for="name">Update Title</label><input type="text" name="title" size="40" /><br />
		<label for="update">Article Body</label><textarea name="upbody" cols="80" rows="10"></textarea><br />
		<label for="submit"></label><input type="submit" name="post" value="Post Update!" /><br /></div>
		
		</form>';
	}	
	
	function addUpdate($title, $body)
	{
			include('./data/includes/config.inc.php'); // Include the Money for Blood Configuration File
			include('login.func.php');
	
			// Connect to the database, if can't establish a connection print error.
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.	 
			
			// Define Variables
			$username = $_SESSION['MFB_username'];
			$body = $_POST['upbody'];
			$body = in_safe($body);
			
			$title = $_POST['title'];
			$querys = "Select * from mfb_updates WHERE username='$username'";
			$results = mysql_query($querys);
			
			$post ="INSERT INTO `mfb_updates` VALUES (NULL, '$username', '$title', '$body', NULL )"; //Enters the data to the table
			$result = mysql_query($post)or die(mysql_error()); //Shows the error (If any) and querys and finishes inserting the data
	
			echo 'Thank you for your update ' . $username . '.';	
	}	
	
	function viewUpdate() 
	{
			include('./data/includes/config.inc.php'); // Include the Money for Blood Configuration File

			// Connect to the database, if can't establish a connection print error.
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.
	   
			// Do the query to search for the user
			$result = mysql_query("SELECT * FROM mfb_updates ORDER BY `id` DESC");
	 	
			// Fetch the results from the SQL Database
			while($row=@mysql_fetch_array($result)) 
			{
			
				$title	=	$row["title"]; 		// Title of Update
				$author	=	$row["author"]; 	// Submitted by
				$date	=	$row["date"]; 		// Date updated
				$time	=	$row["time"]; 		// Time updated
				$body	=	$row["body"]; 		// Content of the Update
	            $body	=	bb_code($body);
				$body	=	str_replace(chr(13).chr(10), '<br />', $body);

				// Print out the search results			
				echo '<p class="utitle">
				' . $title . '</p>
				<div class="updates">' . $body . '</div>
				<div class="ups_bottom"><strong>Update By:</strong> ' . $author . ', <strong>on:</strong> ' . $date . ' @ ' . $time .'</div>';
			}
		}
		
		
	function in_safe ($item) 
	{
		$item = nl2br($item);
		$item = strip_tags($item, '<br>');
		$item = htmlentities($item); 
		$item = ltrim($item);
		
		// Checks if magic quotes is turned on, if it is Stripslashes
   		if ( get_magic_quotes_gpc() ) 
   		{
			$item = stripslashes($item);
		}

		// Now we need to add slashes and other stuff with real_escape_string
		if ( !is_numeric($item) )			
		{
			$item = "'" . mysql_real_escape_string($item) . "'";
		}
			 return $item;
	}
?>
