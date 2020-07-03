<?php
include('data/includes/config.inc.php');
include('./data/functions/login.func.php');
			mysql_connect ($database["host"], $database["user"], $database["pass"]) or die ('Cannot connect to the database.');
			mysql_select_db ($database["db"]);
$username = $_SESSION['MFB_username'];	
$mquery = "SELECT * FROM `mfb_accounts` WHERE username='$username'";
$resultness = mysql_query($mquery);
$mystats = mysql_fetch_array($resultness);
					$currentcash = $mystats['cash'];
$currentrank = $mystats['rank'];					
$currentexp = $mystats['exp'];
$currenthealth = $mystats['health'];
echo '<div id="top">
<table width="100%" border="1" bordercolor="#880000" style="background: #000000; border-collapse:collapse" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td class="bar" align="center" width="5%">
			<b>Rank:</b>
		</td>

		<td class="bar" bgcolor="#440000" width="15%">
			&nbsp;'.$currentrank.'
		</td>
		<td class="bar" align="center" width="5%">
			<b>Cash:</b>
		</td>
		<td class="bar" bgcolor="#004400" align="center" width="10%">
			&pound;'.$currentcash.'
		</td>
		<td class="bar" align="center" width="5%">
			<b>Exp:</b>
		</td>
		<td class="bar" bgcolor="#A38100" align="center" width="10%">
			'.$currentexp.'
		</td>
		<td class="bar" align="center" width="5%">
			<b>Health:</b>
		</td>
		<td class="bar" align="center" width="25%">
			<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
	
					<td bgcolor="#000055" class="lashay" width="100%" align="center" height="100%">
						'.$currenthealth.'%
					</td>

					<td bgcolor="#555555" class="lashay" width="0%" align="center" height="100%">
						
					</td>
		
				</tr>
			</table>
		</td>
	</tr>
</table>
	
<table width="100%" border="1" bordercolor="#880000" style="background: #000000; border-collapse:collapse" cellpadding="0" cellspacing="0" align="center">
	<tr>

		<td class="bar" align="center" width="10%">
			<b>Contract Kill</b>:
		</td>
		<td class="bar" align="center" width="5%">
			0:00
		</td>
		<td class="bar" align="center" width="5%">
			<b>Car Theft</b>:
		</td>

		<td class="bar" align="center" width="5%">
			0:00
		</td>
		<td class="bar" align="center" width="5%">
			<b>Mugging</b>:
		</td>
		<td class="bar" align="center" width="5%">
			0:00
		</td>
		<td class="bar" align="center" width="5%">

			<b>Travel</b>:
		</td>
		<td class="bar" align="center" width="5%">
			0:00
		</td>
		<td class="bar" align="center" align="center" width="10%">
			<b>Organized Crime</b>:
		</td>
		<td class="bar" align="center" width="5%">

			0:00
		</td>
	</tr>
</table>
<table width="100%" border="1" bordercolor="#880000" style="background: #000000; border-collapse:collapse" cellpadding="0" cellspacing="0" align="center">
	<tr>

		<td class="bar" align="center" width="5%">
			<b>Factory</b>:
		</td>
		<td class="bar" align="center" width="10%">
			Osaka, JP
		</td>
		<td class="bar" align="center" width="8%">
			<b>Producing</b>:
		</td>

		<td class="bar" align="center" width="15%">
			Bullets: DE .50 Cal (99,000)
		</td>
		<td class="bar" align="center" width="5%">
			<b>Time</b>:
		</td>
		<td class="bar" align="center" width="15%">
			01:02:24:12:03
		</td>
	</tr>
</table>';
			$allmail = 'SELECT * FROM `mfb_u2u` WHERE `receiver` = \''.$username.'\' AND `mfb_u2u`.`read` = \'0\' AND `mfb_u2u` . `foldername` = \'inbox\' OR \'events\'';
		    $unread = mysql_query($allmail)or die(mysql_error());
			$totalur = mysql_num_rows($unread);
if($totalur == NULL || $totalur == 0){
}else{
echo'
<table width="100%" border="1" bordercolor="#880000" style="background: #000000; border-collapse:collapse" cellpadding="0" cellspacing="0" align="center">
	<tr>

		<td class="bar" align="center" width="5%">
			<b>You have NEW messages!</b>:
		</td>
		
	</tr>
</table>';
}
echo '
</div>';
?>
