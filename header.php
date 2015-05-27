<?php
########### DO NOT REMOVE BELOW LINE
$parentfolder = basename(dirname($_SERVER['PHP_SELF']));
$filename = basename($_SERVER['PHP_SELF']);
###########
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
<meta NAME="keywords" CONTENT="Sabrina Markon, PHP Site Scripts, e-Webs.us, Marc Tori, Sunshine Hosting, PHP programmer, database expert, server administrator, Marc Tori, E-Webs, design, respected marketer, ad exchange, ad exchanges, free ad exchange, free ad exchanges, text exchange, free text exchange, text exchanges, free text exchanges, advertise, advertise free, advertising, free advertising, market, marketing, promote, promote free, market free, free marketing, free promotion, traffic, guaranteed traffic, free guaranteed traffic, free traffic, free hits, safelist, safelists, free safelist, free safelists, network marketing, free network marketing, affiliate marketing, free affiliate marketing, affiliate, affiliates, free affiliate program, free affiliate programs, affiliate program, affiliate programs, list builder, list builders, free list builder, free list builders, leads, free leads, free business leads, business leads, viral marketing, referrals, free referrals, referral builder, referral builders, free referral builder, free referral builders, banner advertising, post free ads, submit free ads">
<META NAME="Description" Content="Best new stable PHP script! Unique new advertising exchange and TAE script with free advertising for your business and affordable hosting and development!">
<meta name="author" content="author"/> 
<link rel="stylesheet" type="text/css" href="http://demoviralmailerbasic.phpsitescripts.com/styles.css" media="screen"/>
<title>DEMO of Viral Mailer & Advertising Script - Basic Version - PHP Scripts brought to you by Sabrina Markon, PHPSiteScripts.com and Marc Tori, E-Webs.us. Quality hosting provided by SunshineHosting.net.</title>
</head>
<body>
<center>
<table cellpadding="0" cellspacing="0" align="center" width="960" border="0"><tr><td align="center"><a href="http://demoviralmailerbasic.phpsitescripts.com/index.php?referid=<?php echo $referid ?>"><img src="http://demoviralmailerbasic.phpsitescripts.com/images/header.jpg" width="960" border="0"></a><br>
<div id="mainmenu">
<ul>
	<li><a href="http://demoviralmailerbasic.phpsitescripts.com/index.php?referid=<?php echo $referid ?>" class="mainmenu_current">HOME</a></li>
	<li><a href="http://demoviralmailerbasic.phpsitescripts.com/register.php?referid=<?php echo $referid ?>">REGISTER</a></li>
	<li><a href="http://demoviralmailerbasic.phpsitescripts.com/login.php?referid=<?php echo $referid ?>">LOGIN</a></li>
	<li><a href="http://phpsitescripts.com/helpdesk" target="_blank">HELPDESK</a></li>
</ul>   
</div>
</td></tr><tr><td align="center" bgcolor="#ffffff">
<br><br>
<?php
########### MENUS - DO NOT REMOVE BELOW LINES
if ($memberloggedin == "yes")
{
include $_SERVER['DOCUMENT_ROOT'] . "/membernav.php";
}
if ($adminloggedin == "yes")
{
include $_SERVER['DOCUMENT_ROOT'] . "/admin/adminnav.php";
}
########### MENUS - DO NOT REMOVE ABOVE LINES
?>
<center>
