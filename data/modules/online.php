<?php
$query = "SELECT username FROM mfb_useronline WHERE username <> 'Guest' GROUP BY username";
$result = mysql_query($query);
$members = mysql_num_rows($result);

echo '<p class="heading">Current Members Online</p>
<div id="online"><table cellpadding="0" width="750px" cellspacing="0" border="0" align="center">
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="2" class="thead" align="center">Currently Online</td>
  </tr>
  <tr>
	<td>';
DisplayUsersOnline();
echo '</td>
</tr>
<tr>
	<td style="border-bottom: 1px solid #880000;" align="center"><strong>Total Online Members: '.$members.'</strong></td>
</tr>
  <tr>
    <td style="background-color: transparent; border: 0px;" colspan="1">&nbsp;</td>
  </tr>
  </table>
  <table width="750px" cellspacing="0" border="0" align="center">
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="2" class="thead" align="center">Latest Members</td>
  </tr>
  <tr>
  	<td style="border-left: 1px solid #880000;" align="center"><strong>Username</strong></td><td style="border-left: 0px;" align="center"><strong>Date Registered</strong></td>
  </tr>';
$ditto = mysql_query("SELECT * FROM mfb_accounts ORDER BY `uid` DESC LIMIT 0,5");
	 	
		// Fetch the results from the SQL Database	 	
			while($row=@mysql_fetch_array($ditto)) {

		// Set Variables to collect data from the database.	 		
		$usr = $row["username"];
		$reg = $row["registered"];
		$id = $row["uid"];
		
  echo '<tr>
  	<td style="border-left: 1px solid #880000;" align="center"><a href="?page=profile&uid='.$id.'">'.$usr.'</a></td><td style="border-left: 0px;" align="center">'.$reg.'</td>
  </tr>';
}
echo '  <tr>
    <td style=" background-color: transparent; border: 0px; border-top: 1px solid #880000;" colspan="2">&nbsp;</td>
  </tr>
    </table>
  <table width="750px" cellspacing="0" border="0" align="center">
  <tr>
    <td style="border-left: 1px solid #880000; font-weight: bold; text-transform: uppercase;" colspan="2" class="thead" align="center">Access Legend</td>
  </tr>
<tr>
	<td style="border-bottom: 1px solid #880000;" align="center">
	<font class="dev">Developer</font> + 
	<font class="adm">Administrator</font> + 
	<font class="gmod">Global Moderator</font> + 
	<font class="fmod">Forum Moderator</font> + 
	<font class="mod">Moderator</font> + 
	<font class="news">Journalist</font> + 
	<font class="friend">Friend</font> + 
	<font class="user">User</font>
	</td>
</tr>
</table></div>';
?>
