<script language="JavaScript" type="text/javascript">
<!--
function submitform (todo){
  document.mymessages.shoulddo.value = todo ;
  document.mymessages.submit() ;
}
-->
states=new Array()
states[0]="create"
states[1]="move"

function show(elm) {
for (var i = 0; i < states.length; i++) {
var layer = document.getElementById(states[i]);
document.mymessages.shoulddo.value = elm ;
if (elm!= states[i]) {
layer.style.display = "none";
}
else {
layer.style.display = "block";
}
}
}

      function checkedAll (todo) {
	  if(todo == "ucheck"){
	  	for (var i = 0; i < document.mymessages.elements.length; i++) {
	  document.mymessages.elements[i].checked = false;
	  }
	  }
	  if(todo == "check"){
	  	for (var i = 0; i < document.mymessages.elements.length; i++) {
	  document.mymessages.elements[i].checked = true;
	  }
	  }
	  if(todo == "invert"){
	  	for (var i = 0; i < document.mymessages.elements.length; i++) {
	if(document.mymessages.elements[i].checked == true){
	document.mymessages.elements[i].checked = false;
	}else{
	document.mymessages.elements[i].checked = true;
	}
	  
	  }
	  }
	  if(todo == "seldel"){
	  if(document.mymessages.allmess.checked != true){
	  checked = true;
	  }else{
	  checked = false;
	  }
	for (var i = 0; i < document.mymessages.elements.length; i++) {
	  document.mymessages.elements[i].checked = checked;
	}
	}
      }
</script>

<?php


if($_GET['action'] == "compose"){
$userid = $_GET['uid'];
$messageid = $_GET['mid'];
include('./data/includes/config.inc.php');
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.	 
						
	$query = "SELECT * FROM `mfb_accounts` WHERE uid='$userid'";
	$result = mysql_query($query)or die(mysql_error());
			
			while($obj=mysql_fetch_object($result)) {
					$sendto=$obj->username;
					}
	if($messageid == NULL){
}else{	
	$query2 = "SELECT * FROM `mfb_u2u` WHERE id='$messageid'";
	$result2 = mysql_query($query2)or die(mysql_error());
			
			while($obj2=mysql_fetch_object($result2)) {
					$subject=$obj2->title;
					}					
					
			if(substr($subject,0,3) == "Re:"){
}else{
$subject = "Re: " .$subject;
}		
		}	
		echo '<p class="heading">Send a Private Message!</p>
		<div id="updates"><form method="post" action="game.php?page=pm&action=sent">
		<label for="name">To:</label><input type="text" name="receiver" value="'.$sendto.'" size="40" /><br />
		<label for="name">Title:</label><input type="text" name="title" value="'.$subject.'" size="40" /><br />
		<label for="update">Message Body:</label><textarea name="upbody" cols="80" rows="10"></textarea><br />
		<label for="submit"></label><input type="submit" name="post" value="Send Message" /><br style="clear: both;"/></div>
		
		</form></div>';
	}	
	
	if($_GET['action'] == "view"){
	$folder = $_GET['folder'];
	echo '<p class="heading">The Post Office</p><div style="margin: 0 auto;" id="mailbox">';
	$mid = $_GET['mid'];
	$username = $_SESSION['MFB_username'];
	include('./data/includes/config.inc.php');
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use. 
			
			
			
			if($_GET['mid'] == NULL){
	
		
		
			$query2 = "SELECT * FROM `mfb_u2ufolder` WHERE username='$username'";
	$result2 = mysql_query($query2)or die(mysql_error());

echo '
		<div id="mfbleft"><table id="mbleft" width="150" cellpadding="0" align="left" cellspacing="0" border="0">
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
	</table></div>
	';
echo '<form name="mymessages" method="post" action="game.php?page=pm&action=complete">';	
echo 
	'<table style="margin-left: 15px; background-color: #000000;" width="750px"  cellpadding="0" cellspacing="0">
	<tr><td colspan="5" style="border: 0px; background-color: #111111;">Options: <a href="javascript:checkedAll(\'check\');">Check All</a> | <a href="javascript:checkedAll(\'ucheck\');">Uncheck All</a> | <a href="javascript:checkedAll(\'invert\');">Invert selection</a></td></tr>
			<tr><td colspan="5" align="center" class="thead" style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;">'.$folder.'</td>
			</tr>
		
			<tr>
				<td width="21" style="border-left: 1px solid #880000;" align="center">
					<a href="javascript:checkedAll (\'seldel\');"><input id="allmess" name="allmess" style="width: 21px" type="checkbox"/></a>
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
				<td style="border-bottom: 0px solid #880000; border-left: 1px solid #880000;">
					<INPUT style="width: 21px" type="checkbox" name="checkedbox[]" value="'.$id.'"><a href="?page=pm&action=view&mid='.$id.'">
				</td>
				<td style="border-bottom: 0px solid #880000;">
					'.$image.'
				</td>
				<td style="border-bottom: 0px solid #880000;" width="150px">
					<a href="?page=profile&uid='.$profileid.'">'.$sender.'</a>
				</td>
				<td style="border-bottom: 0px solid #880000;">
					<a href="?page=pm&action=view&mid='.$id.'">'.$title.'</a>
				</td>
				<td style="border-bottom: 0px solid #880000;" width="145px">
					'.$date . ' ' . $time . '
				</td>
		</tr>';						  
						  
						  
						  
					}
					
					}else{
					
					echo '		<tr>
				<td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000;">
					&nbsp;
				</td>
				<td style="border-bottom: 1px solid #880000;">
					&nbsp;
				</td>
				<td style="border-bottom: 1px solid #880000;">
					Sorry you have no messages in this folder
				</td>
				<td style="border-bottom: 1px solid #880000;">
					&nbsp;
				</td>
				<td style="border-bottom: 1px solid #880000;">
					&nbsp;
				</td>
		</tr>';	
}
echo '<input type="hidden" style="border: 0px; width: 0px;" name="shoulddo" />';

echo '<tr><td colspan="5" style="border: 0px; border-top: 1px solid #880000; background-color: #111111;">With Selected: <a href="javascript:show(\'move\');">Move to Folder</a> | <a href="javascript:submitform(\'delete\');">Delete Message(s)</a> | <a href="javascript:show(\'create\');">Create a Folder</a></td></tr>
</table>';


echo '<div id="move" style="display:none;"><table style="margin-left: 20px; background-color: #000000;" width="750px"  cellpadding="0" cellspacing="0">
    <tr>
        <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" align="center" class="thead">Move Messages</td>
	</tr><tr><td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000;">
		<select name="thefolder">
<option value="Inbox">Inbox</option>
<option value="Sent">Sent</option>
<option value="Trash">Trash</option>';


$allfolders = "SELECT * FROM mfb_u2ufolder WHERE username='".$_SESSION['MFB_username']."'";
$results = mysql_query($allfolders);

while($obj=mysql_fetch_object($results)) {
					$id=$obj->id;
					$username=$obj->username;
					$foldername=$obj->foldername;

		echo "<option value=\"$foldername\">$foldername</option>";			
					
					}
					


echo'
</select>
		<input type="submit" name="post" value="Move Messages" /></form></td></tr></table></div>';


echo '<div id="create" style="display:none;"><table style="margin-left: 20px; background-color: #000000;" width="750px"  cellpadding="0" cellspacing="0">
    <tr>
        <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" align="center" class="thead">Create a Folder</td>
	</tr><tr><td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000;"><form method="post" action="game.php?page=pm&action=newfolder"><input type="text" name="newfolder" value="My Folder" size="40" />
		<input type="submit" name="post" value="Create Folder" /></form></td></tr></table></div></div>';
		




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
					$query2 = "SELECT * FROM `mfb_u2ufolder` WHERE username='$username'";
	$result2 = mysql_query($query2)or die(mysql_error());
			echo '
		<div id="mfbleft"><table width="150" cellpadding="0" align="left" cellspacing="0" border="0">
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
	</table></div>
	';		
				$query2 = "SELECT * FROM `mfb_accounts` WHERE username='$sender'";
				$result2 = mysql_query($query2)or die(mysql_error());
				$info = mysql_fetch_array( $result2 )or die(mysql_error());
				$profileid = $info['uid'];
					
echo '<table style="margin-left: 20px; margin-bottom: 10px;" cellspacing="0" cellpadding="0" width="750px" border="0">
        <tr>
        <td class="thead" colspan="2" style="border-left: 1px solid #880000; border-bottom: 1px solid #880000; text-transform: uppercase; font-weight: bold;" align="center">Viewing Message: ' . $id .'</td></tr>
         <tr>
          		<td style="border: 0px; background-color: transparent; text-transform: uppercase; font-weight: bold; width:130px;">Message Options:</td><td style="border: 0px; background-color: transparent"><a href="game.php?page=pm&action=compose&uid='.$profileid.'&mid='.$id.'">Reply</a> | <a href="game.php?page=pm&action=delete&mid='.$id.'">Delete</a> | Save</td></tr>
          <tr>
              <td style="border-left: 1px solid #880000; width: 100px"><strong>Message From:</strong></td><td>'.$sender.'</td>
          </tr>
          <tr>
          		<td style="border-left: 1px solid #880000;"><strong>Subject:</strong></td><td>'.$title.'</td>
          </tr>
          <tr>
          		<td style="border-left: 1px solid #880000;"><strong>Sent On:</strong></td><td>'. $date .' @ '.$time.'</td></tr>
          <tr>
          		<td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000;" colspan="2">'.$message.'</td></tr>
          <tr>
          		<td style="border: 0px; background-color: transparent; text-transform: uppercase; font-weight: bold; width:130px;">Message Options:</td><td style="border: 0px; background-color: transparent"><a href="game.php?page=pm&action=compose&uid='.$profileid.'&mid='.$id.'">Reply</a> | <a href="game.php?page=pm&action=delete&mid='.$id.'">Delete</a> | Save</td></tr>
      </table></div>';
					
					}
	
}
}

// Elite's Shitty Coding which Andy will bitch about xD!
if($_GET['action'] == "delete") {
	$mid = $_GET['mid'];
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
		 $foldertogo = $_POST['thefolder'];
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
