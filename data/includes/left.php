<?php
include('data/includes/config.inc.php');
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);  // Select the database to use.	
			$username = $_SESSION['MFB_username'];
						$querys = "Select * from mfb_accounts WHERE username='$username'";
			$results = mysql_query($querys)or die('aww');

			
while($row = mysql_fetch_array($results, MYSQL_ASSOC))
{
    $access=$row['access'];
	$uid=$row['uid'];
} 
			
echo '<div id="left">
<div style="text-align: center;"><img src="' . $config['banner'] . '" /><p class="maintitle">' . $config['name'] . ' ' . $config['version'] . '</p></div>
<div id="menu">
<ul>
<p class="navtitle">Main Menu</p>
<li><a href="?page=welcome">Welcome</a></li>
<li><a href="?page=online">Online Members</a></li>
<li><a href="?page=agenda">Agenda</a></li>
<li><a href="?page=findplayer">Find a Player</a></li>
<li><a href="?page=updates">Latest Updates</a></li>

<p class="navtitle">The Post Office</p>
<li><a href="?page=pm&folder=inbox&action=view">Inbox';
			$allthemail = 'SELECT * FROM `mfb_u2u` WHERE `receiver` = \''.$username.'\' AND `mfb_u2u`.`read` = \'0\' AND `mfb_u2u` . `foldername` = \'inbox\'';
		    $unread5 = mysql_query($allthemail)or die(mysql_error());
			$totalur5 = mysql_num_rows($unread5);
if($totalur5 == NULL || $totalur5 == 0){
}else{
echo "<b>($totalur)</b>";
}
echo '
</a></li>
<li><a href="?page=pm&folder=sent&action=view">Sent Mail</a></li>
<li><a href="?page=pm&folder=trash&action=view">Trash Can</a></li>
';
			$query2 = "SELECT * FROM `mfb_u2ufolder` WHERE username='$username'";
	$result2 = mysql_query($query2)or die(mysql_error());
while($obj=mysql_fetch_object($result2)) {
					$foldername=$obj->foldername;
					
								$allthemail2 = 'SELECT * FROM `mfb_u2u` WHERE `receiver` = \''.$username.'\' AND `mfb_u2u`.`read` = \'0\' AND `mfb_u2u` . `foldername` = \''.$foldername.'\'';
		    $unread2 = mysql_query($allthemail2)or die(mysql_error());
			$totalur2 = mysql_num_rows($unread2);

					
					
					echo "<li><a href=\"game.php?page=pm&folder=$foldername&action=view\">$foldername";
					
					if($totalur2 == NULL || $totalur2 == 0){
}else{
echo "<b>($totalur2)</b>";
}

echo "</a></li>";
					
					}

echo'
<p class="navtitle">Control Panel</p>
<li><a href="?page=profile&uid='.$uid.'&action=edit">Edit Profile</a></li>
<li><a href="?page=profile&uid='.$uid.'">View Profile</a></a></li>';


if($access == 8){			
	echo'		
<p style="border-bottom: 1px solid #009900; margin-top: 10px;" class="navtitle">Things to be done</p>
<p class="navtitle">Families</p>
<li><a href="?page=families&action=view"><s>Family List</s></a></li>
<li><a href="?page=families&action=create"><s>Create Family</s></a></li>
<li><a href="?page=family&action=home"><s>Home</s></a></li>
<li><a href="?page=family&action=forum"><s>Forum</s></a></li>
<li><a href="?page=family&action=edit"><s>Edit Family</s></a></li>
<li><a href="?page=family&action=recruit"><s>Recruit Members</s></a></li>
<li><a href="?page=family&action=moneybank"><s>Family Bank</s></a></li>
<li><a href="?page=family&action=bulletbank"><s>Bullet Bank</s></a></li>

<p class="navtitle">Commit Felonys</p>
<li><a href="?page=felony&action=mug"><s>Mug Somebody</s></a></li>
<li><a href="?page=felony&action=stealcar"><s>Steal A Car</s></a></li>
<li><a href="?page=felony&action=contracts"><s>Contract Kills</s></a></li>
<li><a href="?page=felony&action=oc"><s>Organized Crimes</s></a></li>
<li><a href="?page=felony&action=murder"><s>Commit Murder</s></a></li>

<p class="navtitle">Community</p></p>
<li><a href="?page=forum"><s>Discussion Board</s></a></li>
<li><a href="?page=chat"><s>Chat</s></a></li>
<li><a href="?page=gallery&action=viewgallery"><s>Picture Gallery</s></a></li>

<p class="navtitle">Admin Control Panel</p></p>
<li><a href="?page=adm_control/update">Add Update</a></li>

';
}

if($access == 7){			
	echo'<p class="navtitle">Admin Control Panel</p></p>
<li><a href="?page=adm_control/update">Add Update</a></li>

';
}
echo'
<p class="navtitle">The Exit Hole</p>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>
</div>
</div>';
?>
