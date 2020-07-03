<?php

function Useruptable()
	{
		global $REMOTE_ADDR;

		
		//Delete All Inactive users
		$now = time();
		$expire = $now - 600;
		$query = "DELETE FROM mfb_useronline WHERE timestamp < $expire";
		$result = mysql_query($query);


		//set username of user
		if(isset($_SESSION['MFB_username'])) 
		{
			$username = $_SESSION['MFB_username'];
		} 
		else
		{
			$username = "Guest";
		}


		//insert online status or update the IP and username
		$query = "SELECT ip,username FROM mfb_useronline WHERE ip='$REMOTE_ADDR'";
		$result = mysql_query($query);
		
		if((mysql_num_rows($result)) == 0)
		{
			$query = "INSERT mfb_useronline (timestamp,ip,username) VALUES ($now,'$REMOTE_ADDR','$username')";
			mysql_query($query);
		}
		else
		{
			$row = mysql_fetch_array($result);
			
			if ($row['username'] != $username) 
			{
				$query = "UPDATE mfb_useronline SET username='".$username."' WHERE ip='".$REMOTE_ADDR."'";
				mysql_query($query);
			}
		}
	}
	

	function DisplayUsersOnline() 
	{

		//Color coding
 		$Colorcode=array(
 						0 => "unactive",
 						1 => "user",
						2 => "friend",
						3 => "news",
 						4 => "mod",
						5 => "fmod",
 						6 => "gmod",
 						7 => "adm",
 						8 => "dev"
 					);
 

		$query = "SELECT username FROM mfb_useronline WHERE username <> 'Guest' GROUP BY username";
		$result = mysql_query($query);
		
		$members = mysql_num_rows($result);

		for($i=0;$i < $members ;$i++)
		{
			$row = mysql_fetch_array($result);

			$ditto = "SELECT uid FROM mfb_accounts WHERE username = '". $row['username'] ."'";
			
			$robot = mysql_query($ditto);
			$getid = mysql_num_rows($robot);
			$theid = mysql_fetch_array($robot);

			$bloody = "SELECT access FROM mfb_accounts WHERE username = '" . $row['username'] . "' ORDER BY access DESC";
			
			$results = mysql_query($bloody);
			$thelvl= mysql_fetch_array($results);
			
			$membernames[$i] 	= $row['username'];
			$uid 				= $row['uid'];
			$id 				= $theid['uid'];
			$accesslvl[$i] 		= $thelvl['access'];
			$access 			= $accesslvl[$i];

			$shadow = "#333333";
			$border = "#880000";
			$back = "#000000";
		
			echo "<a href=\"?page=profile&uid=".$id."\" onmouseover=\"this.T_WIDTH=165;this.T_TITLE='And I Say Blah';this.T_SHADOWCOLOR='". $shadow ."';return escape('<b>UserID</b>: " .$id. "<br>')\">";
			
			echo '<font class="' . $Colorcode[$access] . '">';
				
				echo $membernames[$i];
				
			echo '</font></a>';
			
			if( $i < $members - 1)
			{
				echo " [+] ";
			}
		}
	}
?>
