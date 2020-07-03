<?php
	//include('data/functions/updates.func.php');
	//if(is_posting()){
     //   addUpdate($_POST['title'], $_POST['upbody']);
	//} else {
	//updateForm();
	//echo '</div>';
//}

if($_GET['post'] == NULL){
		echo '<p class="heading">Send an Update!</p>
		<div id="updates"><form method="post" action="game.php?page=adm_control/update&post=1">
		<label for="name">Update Title</label><input type="text" name="title" size="40" /><br />
		<label for="update">Article Body</label><textarea name="upbody" cols="80" rows="10"></textarea><br />
		<label for="submit"></label><input type="submit" name="post" value="Post Update!" /><br /></div>
		
		</form></div>';
	}
	
	if($_GET['post'] == "1"){
if($_POST['title'] == NULL){
echo "Sorry, but you can't do that.... Cunt!";
}else{
	

			include('./data/includes/config.inc.php'); // Include the Money for Blood Configuration File
		//	include('./data/functions/login.func.php');
			// Connect to the database, if can't establish a connection print error.
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.	 
			
			// Define Variables
			$username = $_SESSION['MFB_username'];
			$body = $_POST['upbody'];
			//$body = in_safe($body);
			$title = $_POST['title'];
			$time = date('g:i A');
				$date = date('l jS F Y');

		$post ="INSERT INTO `mfb_updates` VALUES (NULL, '$username', '$title', '$body', '$date', '$time' )"; //Enters the data to the table
			
$result = mysql_query($post)or die(mysql_error()); //Shows the error (If any) and querys and finishes inserting the data
		echo 'Thank you for your update ' . $username . '.';	
		

		
			
	}
	}
	if($_GET['post'] == "0"){ // Viewing of the updates
			include('./data/includes/config.inc.php'); // Include the Money for Blood Configuration File
			// Connect to the database, if can't establish a connection print error.
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.
	   
		// Do the query to search for the user
			$result = mysql_query("SELECT * FROM mfb_updates ORDER BY `id` DESC");
	 	
		// Fetch the results from the SQL Database	 	
			while($row=@mysql_fetch_array($result)) {

		// Set Variables to collect data from the database.	   			
			$title=$row["title"]; // Title of Update
			$author=$row["author"]; // Submitted by
			$date=$row["date"]; // Date updated
			$body=$row["body"]; // Content of the Update
			$body=bb_code($body);
		// Print out the search results			
			echo '<p class="utitle">
			' . $title . '</p>
			<div style="font: normal 10pt tahoma; color: #ffffff; padding-left: 15px; text-align: left; padding-bottom: 5px;">' . $body . '</div>
			<div style="font: normal 10pt tahoma, sans-serif; text-align: right; padding-bottom: 10px; border-top: 1px dotted white; padding-top: 5px; color: #ffffff"><strong>Update By:</strong> ' . $author . ', <strong>on:</strong> ' . $date . '</div>';
			}
		}
		
			
?>
