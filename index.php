<?php
ob_start();
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Money For Blood</title>
		
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Mafia, MMORPG, Money for Blood, Mob, 1950s" />
	<meta name="description" content="Money For Blood Massive Multiplayer Online Role Playing Game" />
	<meta name="author" content="Paul Chater" />

	<link rel="stylesheet" type="text/css" href="styles/mfb.css" title="MoneyForBlood" />
	<link rel="shortcut icon" href="images/icons/favicon.ico" />
</head>

<body>
<div id="wrapper">
<div id="nav2">
<ul>
<li><a href="?act=default" title="Log in to your account">Login</a></li>
<li><a href="?act=register" title="Register your account today">Register</a></li>
<li><a href="#" title="Screenshots of MFB">Screens</a></li>
<li><a href="#" title="Official MFB Forums">Forums</a></li>
<li><a href="#" title="The rules of the game">Rules</a></li>
<li><a href="#" title="Frequently Asked Questions">FAQs</a></li>
</ul><div id="navigation"><b>Money For Blood</b> <sup>v1.0</sup></div>
</div>

<div id="banner"><img src="images/banners/main_banner.png" /></div>

<div id="login">';
switch($act) {
	default:
		include 'login.php';
	break; case "register":
		include 'register.php';
	}
echo '</div></div>

	<div id="copyright">Copyright&copy; 2007 Got Src, Ltd.&nbsp;&nbsp;&nbsp;&nbsp;Designed by Paul Chater</div>

</div>

</body>
</html>';
ob_end_flush();
?>
