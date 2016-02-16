<?php

		
		$userid = $_GET['uid'];

		
	
mysql_connect($database['host'], $database['user'], $database['pass']);
mysql_select_db($database['db']);






$query = "SELECT * FROM mfb_accounts WHERE uid=$userid";
$res = mysql_query($query);
	
		
if($_GET['action'] == NULL){
if( mysql_num_rows($res) ) {
	
				while($obj=mysql_fetch_object($res)) {
					$uid=$obj->uid;
					$username=$obj->username;
					$email=$obj->email;
					$avatar=$obj->avatar;
					$msn=$obj->msn;
					$yahoo=$obj->yahoo;
					$aim=$obj->aim;
					$dob=$obj->dob;
					$info=$obj->probody;
					$banner=$obj->banner;
					$registered=$obj->registered;
					$rank=$obj->rank;
					
					
$query2= "SELECT username FROM mfb_useronline WHERE username = '$username' GROUP BY username";
$result2 = mysql_query($query2);
$members = mysql_num_rows($result2);
if($members > 0){
$activestatus = "Online";
$backcolor = "#004400";
}else{
$activestatus = "Offline";
$backcolor = "#440000";
}
					
					
					
					
					
					
					
					$query = "SELECT * FROM mfb_accounts WHERE username='".$_SESSION['MFB_username']."'";
					$results = mysql_query($query);
					$anarray = mysql_fetch_array($results);
					$myaccess = $anarray['access'];
				
					
					echo '<p class="heading">Profile of ' . $username . '</p>
		        <div id="profile"><table cellpadding="0" width="750px" cellspacing="0" border="0" align="center">
		        <tr>
		        	<td style="padding: 0; height: 150px; border-left: 1px solid #880000;" colspan="3" align="center"><img style="max-height: 150px; max-width: 750px;" src='. $banner .' /></td></tr>
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="3" class="thead" align="center">Contact Details</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000; padding: 0;" rowspan="4" width="10"><img style="padding: 0; width: 96px; height: 96px; max-width: 96px; max-height: 96px;" src="'. $avatar . '" width="96" height="96" alt="'. $username .'\'s Avatar"/></td>
    <td style="font-weight: bold;" width="120">MSN:</td>
    <td>'. $msn .'</td>
  </tr>
  <tr>
    <td style="font-weight: bold;">Yahoo!:</td>
    <td>' . $yahoo .'</td>
  </tr>
  <tr>
    <td style="font-weight: bold;">AIM:</td>
    <td>'. $aim .'</td>
  </tr>
  <tr>
    <td style="font-weight: bold;">Date of Birth:</td>
    <td>'. $dob .'</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000; border-bottom: 1px solid #880000;" colspan="3" align="center"><a href="http://www.ninthcondition.net/game.php?page=pm&action=compose&uid='.$uid.'">Private message this user</a>
';
					if ($myaccess > 7){
				echo ' - <a href="game.php?page=profile&uid='.$uid.'&action=edit">Edit Profile</a>';
					}
	echo '
	</td>
  </tr>
  <tr>
    <td style="background-color: transparent; border: 0px;" colspan="1">&nbsp;</td>
  </tr>
  </table>
  <table cellpadding="0" width="750px" cellspacing="0" border="0" align="center">
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="2" class="thead" align="center">Online Status</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000; border-bottom: 1px solid #880000; font-weight: bold;" width="120">Current Status:</td>
    <td style="background-color: ' . $backcolor . '; border-bottom: 1px solid #880000;"  colspan="2">' . $activestatus . '</td>
  </tr>
  <tr>
    <td style="background-color: transparent; border: 0px;" colspan="1">&nbsp;</td>
  </tr>
  </table>
  <table cellpadding="0" width="750px" cellspacing="0" border="0" align="center">
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="3" class="thead" align="center">Player Info</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000;" width="120"><strong>Registered:</strong></td>
    <td colspan="2">'. $registered .'</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000;" ><strong>Current Rank:</strong></td>
    <td colspan="2">' .$rank .'</td>
  </tr>
    <tr>
    <td style="border-left: 1px solid #880000;" ><strong>Family:</strong></td>
    <td colspan="2">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left: 1px solid #880000;" ><strong>Family\'s Rank:</strong></td>
    <td colspan="2">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left: 1px solid #880000;" ><strong>Current Wealth:</strong></td>
    <td colspan="2">&nbsp;</td>
  </tr>
    <tr>
    <td style="border-left: 1px solid #880000;" ><strong>Killed:</strong></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000; border-bottom: 1px solid #880000" ><strong>People Bailed: </strong></td>
    <td style="border-bottom: 1px solid #880000;" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="background-color: transparent; border: 0px;" colspan="1">&nbsp;</td>
  </tr>
</table>
<div style="clear: both;"></div>
<table cellpadding="0" width="750px" cellspacing="0" border="0" align="center">
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="3" class="thead" align="center">Player Profile</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid #880000; border-bottom: 1px solid #880000;" >'. bb_code($info) .'</td>
  </tr>
</table></div>';

				}
			
			}else{
				print '	<tr><td class="alt_a"><span class="name">No user with that ID exists!</span></td></tr>';
			}
			}
			if($_GET['action'] == "edit"){
			
			if($_GET['stage'] == 2){
if($_POST['email'] == NULL){
echo "YOU CANT DO THAT!";
}else{
					$uid = $_GET['uid'];
					$email= $_POST['email'];
					$avatar=$_POST['avatar'];
					$msn=$_POST['msn'];
					$yahoo=$_POST['yahoo'];
					$aim=$_POST['aim'];
					$info=$_POST['probody'];
					$banner=$_POST['banner'];
			

			$query = "UPDATE mfb_accounts SET email='".$email."',
			avatar='".$avatar."',
			msn='".$msn."',
			yahoo='".$yahoo."',
			aim='".$aim."',
			probody='".$info."',
			banner='".$banner."' WHERE uid='".$uid."'";
mysql_query($query)or die(mysql_error());
			echo "Your profile has successfully been updated!";

			}
			}else{
			
			while($obj=mysql_fetch_object($res)) {
										$uid=$obj->uid;
					$username=$obj->username;
					$email=$obj->email;
					$avatar=$obj->avatar;
					$msn=$obj->msn;
					$yahoo=$obj->yahoo;
					$aim=$obj->aim;
					$dob=$obj->dob;
					$info=$obj->probody;
					$banner=$obj->banner;
					$registered=$obj->registered;
					$rank=$obj->rank;
					$access=$obj->access;
					}
					$query = "SELECT * FROM mfb_accounts WHERE username='".$_SESSION['MFB_username']."'";
					$results = mysql_query($query);
					$anarray = mysql_fetch_array($results);
					$myaccess = $anarray['access'];
					if ($myaccess > 7){
					$username2 = $username;
					$username = $_SESSION['MFB_username'];
					}
		 if($username <> $_SESSION['MFB_username']){
		 echo '<p class="heading" style="color: #FF0000;">This is not your profile to edit!</p>';
		 }else{
		 $username = $username2;
		 echo '<p class="heading">Edit Profile</p>
		 <div id="profile" style="text-align: center;">
		 <form method="post" action="game.php?page=profile&uid='. $uid .'&action=edit&stage=2">
<table width="650px" cellspacing="0" border="0" align="center">
        <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="2" class="thead" align="center">Profile Information</td>
    </tr>
    <tr>
        <td style="border-left: 1px solid #880000; padding: 0;">E-Mail:</td><td><input type="text" name="email" size="200"  value="'. $email .'" /></td>
    </tr>
    <tr>
        <td style="border-left: 1px solid #880000; padding: 0;">Avatar:</td><td><input type="text" name="avatar" size="200" value="'. $avatar .'"/></td>
    </tr>
    <tr>
    	<td style="border-left: 1px solid #880000; padding: 0;">MSN Address:</td><td><input type="text" name="msn" size="200" value="'. $msn .'" /></td>
    </tr>
    <tr>
    	<td style="border-left: 1px solid #880000; padding: 0;">Yahoo! SN:</td><td><input type="text" name="yahoo" size="200" value="'. $yahoo .'" /></td>
    </tr>
    <tr>
    	<td style="border-left: 1px solid #880000; padding: 0;">AIM Screename:</td><td><input type="text" name="aim" size="200" value="'. $aim .'" /></td>
    </tr>
     <tr>
    	<td style="border-bottom: 1px solid #880000; border-left: 1px solid #880000; padding: 0;">Profile Banner:</td><td style="border-bottom: 1px solid #880000;"><input type="text" name="banner" size="200" value="'. $banner .'" /></td>
    </tr>
    <tr>
    <td style="background-color: transparent; border: 0px;" colspan="1">&nbsp;</td>
  	</tr>
    </table>
    <table width="650px" cellspacing="0" border="0" align="center">
    <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="2" class="thead" align="center">Profile Body</td>
    </tr>
    <tr>
    	<td style="border-left: 1px solid #880000; text-align: center;"><textarea rows="10" cols="75" name="probody">'. $info .'</textarea></td>
    </tr>
    <tr>
    	<td style="border-left: 1px solid #880000; border-bottom: 1px solid #880000;"><div width="100%" align="center"><input type="Submit" value="Edit Profile"></div></td>
    </tr>
</table>
<br style="clear:both;" />
        </form> </div></div>';
		 
		 }
		 }
		 }
		
			
?>
