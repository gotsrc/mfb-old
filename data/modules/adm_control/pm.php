<script language="JavaScript" type="text/javascript">
<!--
function submitform (todo){
  document.mymessages.shoulddo.value = todo ;
  document.mymessages.submit() ;
}
-->
</script>

<?php


if($_GET['action'] == "compose"){
$userid = $_GET['uid'];
include('./data/includes/config.inc.php');
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.	 
						
	$query = "SELECT * FROM `mfb_accounts` WHERE uid='$userid'";
	$result = mysql_query($query)or die(mysql_error());
			
			while($obj=mysql_fetch_object($result)) {
					$sendto=$obj->username;
					}
			
		echo '<p class="heading">Send a Private Message!</p>
		<div id="updates"><form method="post" action="game.php?page=pm&action=sent">
		<label for="name">To:</label><input type="text" name="receiver" value="'.$sendto.'" size="40" /><br />
		<label for="name">Title:</label><input type="text" name="title" size="40" /><br />
		<label for="update">Message Body:</label><textarea name="upbody" cols="80" rows="10"></textarea><br />
		<label for="submit"></label><input type="submit" name="post" value="Send Message" /><br style="clear: both;"/></div>
		
		</form></div>';
	}	
	
	if($_GET['action'] == "view"){
	$folder = $_GET['folder'];
	echo '<p class="heading">The Post Office</p>';
	$mid = $_GET['mid'];
	$username = $_SESSION['MFB_username'];
	include('./data/includes/config.inc.php');
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use. 
			
			
			
			if($_GET['mid'] == NULL){
	
		
		
			$query2 = "SELECT * FROM `mfb_u2ufolder` WHERE username='$username'";
	$result2 = mysql_query($query2)or die(mysql_error());

echo '<div style="margin: 0 auto;"><div id="mailbox">
		<table id="mbleft" width="150" cellpadding="0" align="left" cellspacing="0" border="0">
			<tr>
				<td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" align="center" class="thead">Folders</td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #880000; border-bottom: 1px solid #880000; padding: 0px;"><div id="menu">
				<ul>
				<li><a href="?page=pm&folder=inbox&action=view">Inbox</a></li>
				<li><a href="?page=pm&folder=sent&action=view">Sent Mail</a></li>
				<li><a href="?page=pm&folder=events&action=view">Recent Events</a></li>
				<li><a href="?page=pm&folder=trash&action=view">Trash Can</a></li>';
					while($obj=mysql_fetch_object($result2)) {
					$foldername=$obj->foldername;
					
					echo "<li><a href=\"game.php?page=pm&folder=$foldername&action=view\">$foldername</a></li>";
					
					}
	
				
				// Put in the mailbox listing here [dynamic ones]
				
echo '</ul>
		</div>
		</td></tr>
	</table>
	';
	
echo 
	'<table style="margin-left: 15px; background-color: #000000;" width="750px"  cellpadding="0" cellspacing="0">
			<tr><td colspan="5" align="center" class="thead" style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;">SHITTY FUCKING TABLES ARGH!!!!! :@!</td>
			</tr>
			<tr>
				<td width="21" style="border-left: 1px solid #880000;" align="center">
					<input style="width: 21px" type="checkbox"/>
				</td>
				<td width="21" align="center">
					<img src="./images/icons/new_mail.png" />
				</td>
				<td align="center">
					<strong>Sender</strong>
				</td>
				<td align="center">
					<strong>Subject</strong>
				</td>
				<td align="center">
					<strong>Date</strong>
				</td>
			</tr>';
		
		// Put messages in here.

		
		
$query = "SELECT * FROM `mfb_u2u` WHERE receiver='$username' AND foldername='$folder'";
	$result = mysql_query($query)or die(mysql_error());
	$anymail = mysql_num_rows($result);
	
	
	if($anymail > 0 ){
	echo '<form name="mymessages" method="post" action="game.php?page=pm&action=complete">';
		//	echo '<input type="hidden" name="shoulddo" />';	
	
	
	while($obj=mysql_fetch_object($result)) {
					$id=$obj->id;
					$sender=$obj->sender;
					$receiver=$obj->receiver;
					$title=$obj->title;
					$message=$obj->message;
					$message=bb_code($message);
					$time=$obj->time;
					$date=$obj->date;
					$foldername=$obj->foldername;
					$read=$obj->read;
					
				$query2 = "SELECT * FROM `mfb_accounts` WHERE username='$sender'";
				$result2 = mysql_query($query2)or die(mysql_error());
				$info = mysql_fetch_array( $result2 )or die(mysql_error());
				$profileid = $info['uid'];
					
					
					 
					if($read == 0){
					
					$image = "<img src=\"images/icons/new_mail.png\" />";
					}else{
$image = "<img src=\"images/icons/read_mail.png\" />";
					}

						  
			  
echo '		<tr>
				<td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000;">
					<INPUT style="width: 21px" type="checkbox" name="checkedbox[]" value="'.$id.'"><a href="?page=pm&action=view&mid='.$id.'">
				</td>
				<td style="border-bottom: 1px solid #880000;">
					'.$image.'
				</td>
				<td style="border-bottom: 1px solid #880000;">
					<a href="?page=profile&uid='.$profileid.'">'.$sender.'</a>
				</td>
				<td style="border-bottom: 1px solid #880000;">
					<a href="?page=pm&action=view&mid='.$id.'">'.$title.'</a>
				</td>
				<td style="border-bottom: 1px solid #880000;">
					'.$date . ' ' . $time . '
				</td>
		</tr>';						  
						  
						  
						  
					}
		
		
		


echo '<tr><td colspan="5" style="border: 0px; background-color: #111111;">With Selected: <a href="javascript:submitform(\'move\');">Move to Folder</a> | <a href="javascript:submitform(\'delete\');">Delete Message(s)</a></td></tr></table><input type="hidden" name="shoulddo" /></form></div></div>';

echo '<div id="updates"><form method="post" action="game.php?page=pm&action=newfolder">
		<label for="name">Folder Name:</label><input type="text" name="newfolder" value="My Folder" size="40" />
		<label for="submit"></label><input type="submit" name="post" value="Create Folder" /><br style="clear: both;"/></form></div>
		
		<br />';

}else{
echo '		<tr>
				<td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000;">
					&nbsp;
				</td>
				<td style="border-bottom: 1px solid #880000;">
					&nbsp;
				</td>
				<td style="border-bottom: 1px solid #880000;">
					You currently have no mail in this folder ' .bb_code('=(') . '
				</td>
				<td style="border-bottom: 1px solid #880000;">
					&nbsp;
				</td>
				<td style="border-bottom: 1px solid #880000;">
					&nbsp;
				</td>
		</tr>';	
echo '<tr><td colspan="5" style="border: 0px; background-color: #111111;">With Selected: <a href="javascript:submitform(\'move\');">Move to Folder</a> | <a href="javascript:submitform(\'delete\');">Delete Message(s)</a></td></tr></table><input type="hidden" name="shoulddo" /></form></div></div>';		
echo '<div id="updates"><form method="post" action="game.php?page=pm&action=newfolder">
		<label for="name">Folder Name:</label><input type="text" name="newfolder" value="My Folder" size="40" />
		<label for="submit"></label><input type="submit" name="post" value="Create Folder" /><br style="clear: both;"/></form></div>
		
		<br />';
}



}else{
		$query = "SELECT * FROM `mfb_u2u` WHERE receiver='$username' AND id='$mid'";
	$result = mysql_query($query)or die(mysql_error());
	
$sql = 'UPDATE `mfb_u2u` SET `read` = \'1\' WHERE `mfb_u2u`.`id` = '.$mid.'';
	

	mysql_query($sql)or die(mysql_error());
	
	
						while($obj=mysql_fetch_object($result)) {
					$id=$obj->id;
					$sender=$obj->sender;
					$receiver=$obj->receiver;
					$title=$obj->title;
					$message=$obj->message;
					$message=bb_code($message);
					$time=$obj->time;
					$date=$obj->date;
					$foldername=$obj->foldername;
					$read=$obj->read;
					
				$query2 = "SELECT * FROM `mfb_accounts` WHERE username='$sender'";
				$result2 = mysql_query($query2)or die(mysql_error());
				$info = mysql_fetch_array( $result2 )or die(mysql_error());
				$profileid = $info['uid'];
					
					
					
					
					
					
					
					echo "<a href=\"?page=pm&action=view&mid=$id\">$title</a> <br />
					     Message: $message <br />
						  Time Sent: $time <br />
						  Date Sent: $date <br />";
					
					
					
					
					
					
					
					}
	
}
}

// Elite's Shitty Coding which Andy will bitch about xD!
if($_GET['action'] == "delete") {
	$userid = $_GET['uid'];
	include('./data/includes/config.inc.php');
		mysql_connect ($database["host"],$database["user"],$database["pass"]) or die ('Cannot connect to the database.');
		mysql_select_db ($database["db"]);	
		$username = $_SESSION['MFB_username'];
		$delquery = "DELETE FROM mfb_u2u WHERE id='$mid' AND receiver='$username'";
		$kill = mysql_query($delquery) or die(mysql_error());
		mysql_query("ALTER TABLE `mfb_u2u` AUTO_INCREMENT=1");
		
		echo "Message deleted!";
}
	
	if($_GET['action'] == "sent"){
	if($_POST['upbody'] == NULL || $_POST['title'] == NULL || $_POST['receiver'] == NULL){
echo "Sorry, but you can not leave any field empty....!";
}else{
	

			include('./data/includes/config.inc.php'); // Include the Money for Blood Configuration File
		//	include('./data/functions/login.func.php');
			// Connect to the database, if can't establish a connection print error.
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.	 
			
			// Define Variables
			$username = $_SESSION['MFB_username'];
			$receiver = $_POST['receiver'];
			$body = $_POST['upbody'];
			//$body = in_safe($body);
			$title = $_POST['title'];
			$time = date('g:i A');
				$date = date('jS M Y');
		$post ="INSERT INTO `mfb_u2u` VALUES (NULL, '$username', '$receiver', '$title', '$body', '$time', '$date', 'inbox', '0' )"; //Enters the data to the table
		$sent ="INSERT INTO `mfb_u2u` VALUES (NULL, '$username', '$username', '$title', '$body', '$time', '$date', 'sent', '1' )"; //Enters the data to the table	
$result = mysql_query($post)or die(mysql_error()); //Shows the error (If any) and querys and finishes inserting the data
$result2 = mysql_query($sent)or die(mysql_error());
		echo 'Message successfully sent to ' . $receiver . '.';	
		

		
			
	}
	}
		
	if($_GET['action'] == "newfolder"){
	$foldername = $_POST['newfolder'];
	$username = $_SESSION['MFB_username'];
	
	$alreadyafolder = "SELECT * FROM `mfb_u2ufolder` WHERE username='$username' AND foldername='$foldername'"; //Enters the data to the table	
$check = mysql_query($alreadyafolder)or die(mysql_error()); //Shows the error (If any) and querys and finishes inserting the data	

$check2 = mysql_num_rows($check);

if($check2 == 1 || $foldername == "inbox" || $foldername == "sent"){
echo "You already have a folder named $foldername";
}else{
	
	$newfolder ="INSERT INTO `mfb_u2ufolder` VALUES (NULL, '$username', '$foldername')"; //Enters the data to the table	
$result = mysql_query($newfolder)or die(mysql_error()); //Shows the error (If any) and querys and finishes inserting the data
if($result){
echo "New folder $foldername created!";
}else{
echo "Creating of folder $foldername failed!";
}
	
	}
	}
	
	if($_GET['action'] == "complete"){
		 $foldertogo = $_POST['moveto'];
		 $whattodo = $_POST['shoulddo'];
		 if($whattodo == "move"){
for ($i=0; $i<count($_POST['checkedbox']); $i++){
$theID = addslashes($_POST['checkedbox'][$i]);
//do this
$sql = 'UPDATE `mfb_u2u` SET `foldername` = \''.$foldertogo.'\' WHERE `mfb_u2u`.`id` = '.$theID.'';
$complete = mysql_query($sql);


//do that
}//end loop 
if($complete){
echo "Messages moved succesfully";
}else{
echo "Move Failed!";
}
		}
if($whattodo == "delete"){

for ($i=0; $i<count($_POST['checkedbox']); $i++){
$theID = addslashes($_POST['checkedbox'][$i]);
//do this


$delquery = "DELETE FROM mfb_u2u WHERE id='$theID' AND receiver='$username'";
		$kill = mysql_query($delquery) or die(mysql_error());
		mysql_query("ALTER TABLE `mfb_u2u` AUTO_INCREMENT=1");


//do that
}//end loop 
if($kill){
echo "Messages Deleted Sucessfully";
}else{
echo "Move Failed!";
}
		}	


}
		
		
?>
