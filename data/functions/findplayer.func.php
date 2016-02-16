<?php


/*
 * Main Form for Searching
 * this is where the user inputs their data... Eg. to search for Elite
 * the user puts in his data then presses submit.
 * */
function findForm()
	{
		echo '<p class="heading">Find a player</p>
		<form method="post">
		<table style="margin: auto;" border: 0px;">
		    <tr>
		        <td style="border: 0px; background: transparent;"><input type="text" name="player" />
		        </td>
		        <td style="border: 0px; background: transparent;"><input type="submit" name="find" value="Find Player!" /></td>
		    </tr>
		</table>
		</form>';
	}

/* Find Player Titles
 * This is just for the headings of each field/row
 * */
function findTitle() 
	{
		echo '<table style="width: 100%; margin: 10px auto;" cellspacing="0" cellpadding="1">
	    <tr>
	    <td><strong>User ID</strong></td>
	    <td><strong>Username</strong></td>
	    <td><strong>Date of Birth</strong></td>
	    <td><strong>MSN</strong></td>
	    <td><strong>Yahoo</strong></td>
	    <td><strong>AIM</strong></td>
	    </tr>';
	}
	
	
/* Find Player Function... this is the 
 * main find player script for 
 * Money for Blood...
 * */
function findPlayer()
	{
		include('./data/includes/config.inc.php'); // Include the Money for Blood Configuration File

	// Connect to the database, if can't establish a connection print error.
		mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
		mysql_select_db ($database["db"]);  // Select the database to use.
	   

	// Set the variable "search" to be parsed for the text box entry
		$search = $_POST['player'];
	
	// Do the query to search for the user
	if($search != NULL){
		$result = mysql_query("SELECT * FROM mfb_accounts WHERE username LIKE '%$search%'");
	 	
	// Fetch the results from the SQL Database	 	
		while($row=@mysql_fetch_assoc($result)) {

	// Set Variables to collect data from the database.	   			
			$user=$row["username"]; // This is for the username field in the table
			$id=$row["uid"]; // User ID field
			$dob=$row["dob"]; // Date of Birth field
			$msn=$row["msn"]; // MSN Field
			$yahoo=$row["yahoo"]; // Yahoo Field
			$aim=$row["aim"]; // AIM Field


// Print out the search results		
		
		echo '<tr style="text-align: center;">
				<td>' . $id . '</td>	   		          	  
				
				<td>
					<a href="game.php?page=profile&uid=' .$id. '" />' .$user .'</a>
				</td>
	   		          	  
				<td>' . $dob . '</td>
				<td>' . $msn . '</td>
				<td>' . $yahoo . '</td>
				<td>' . $aim . '</td>
				</tr>';
		}
		 }else{
		 echo "Please search for a user above";
		 }
	}
?>
