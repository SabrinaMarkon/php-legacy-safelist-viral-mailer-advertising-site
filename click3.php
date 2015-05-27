<?php
include "db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $sitename ?></title>
<link href="<?php echo $domain ?>/styles.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:#fff;color:#000;">
<center>
<?
if($_GET['url'])
{
?>
<div style="float: left;">
<a href="<?php echo $_GET['url']; ?>" target="_top">Remove This Frame</a>
</div>
<div style="float: right;">
<a href="<?php echo $_GET['url']; ?>" target="_top">Remove This Frame</a>
</div>
<?php
}
if($_GET['id'])
{
$id = $_GET["id"];
$userid = $_GET["userid"];
$type = $_GET["type"];
}
else
{
echo "Invalid click link";
include "banners.php";
?>
</center>
</body>
</html>
<?php
exit;
}

if ($userid != "")
{
$uq = "select * from members where userid=\"$userid\"";
$ur = mysql_query($uq);
$urows = mysql_num_rows($ur);
if ($urows > 0)
	{
	$acct = mysql_result($ur,0,"accounttype");
	if ($acct == "PAID")
		{
		$adminemailscredits = $adminemailscreditspaid;
		$soloscredits = $soloscreditspaid;
		$creditsoloscredits = $creditsoloscreditspaid;
		$bannerscredits = $bannerscreditspaid;
		$buttonscredits = $buttonscreditspaid;
		$textadscredits = $textadscreditspaid;
		$fullloginadscredits = $fullloginadscreditspaid;
		}
	if ($acct != "PAID")
		{
		$adminemailscredits = $adminemailscreditsfree;
		$soloscredits = $soloscreditsfree;
		$creditsoloscredits = $creditsoloscreditsfree;
		$bannerscredits = $bannerscreditsfree;
		$buttonscredits = $buttonscreditsfree;
		$textadscredits = $textadscreditsfree;
		$fullloginadscredits = $fullloginadscreditsfree;
		}
	}
if ($urows < 1)
	{
	$adminemailscredits = $adminemailscreditsfree;
	$soloscredits = $soloscreditsfree;
	$creditsoloscredits = $creditsoloscreditsfree;
	$bannerscredits = $bannerscreditsfree;
	$buttonscredits = $buttonscreditsfree;
	$textadscredits = $textadscreditsfree;
	$fullloginadscredits = $fullloginadscreditsfree;
	}

#### check if user has already clicked this ad or not
	if ($type == "adminemails")
	{
	$alreadyq = "select * from adminemails_viewed where adid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	if ($type == "banners")
	{
	$alreadyq = "select * from bannerviews where blid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	if ($type == "buttons")
	{
	$alreadyq = "select * from buttonviews where blid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	if ($type == "textads")
	{
	$alreadyq = "select * from textadviews where adid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	if ($type == "fullloginads")
	{
	$alreadyq = "select * from fullloginadviews where adid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	if ($type == "solos")
	{
	$alreadyq = "select * from solos_viewed where adid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	if ($type == "creditsolos")
	{
	$alreadyq = "select * from creditsolos_viewed where adid=\"$id\" and userid=\"$userid\"";
	$alreadyr = mysql_query($alreadyq);
	}
	$alreadyrows = mysql_num_rows($alreadyr);
	if ($alreadyrows > 0)
	{
		if ($enablecreditssystem == "yes")
		{
		echo "You Already Received Credit for Clicking This Link";
		}
		if ($enablecreditssystem != "yes")
		{
		echo "You Already Clicked This Link";
		}
	include "banners.php";
	?>
	</center>
	</body>
	</html>
	<?php
	exit;
	}
#### end check if user has already clicked this ad or not

if ($type == "adminemails")
{
$q = "insert into adminemails_viewed (userid,adid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$adminemailscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $adminemailscredits . " Bonus Credits for Clicking an Admin Email Link!";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting!";
	}
}
if ($type == "banners")
{
$q = "insert into bannerviews (userid,blid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$bannerscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $bannerscredits . " Bonus Credits for Clicking a Banner!";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting!";
	}
}
if ($type == "buttons")
{
$q = "insert into buttonviews (userid,blid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$buttonscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $buttonscredits . " Bonus Credits for Clicking a Button!";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting!";
	}
}
if ($type == "textads")
{
$q = "insert into textadviews (userid,adid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$textadscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $textadscredits . " Bonus Credits for Clicking a Text Ad!";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting!";
	}
}
if ($type == "fullloginads")
{
$q = "insert into fullloginadviews (userid,adid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$fullloginadscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $fullloginadscredits . " Bonus Credits for Clicking a Full Page Login Ad! <a href=\"members.php?newlogin=1\" target=\"_top\">Click to Continue to Login</a>";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting! <a href=\"members.php?newlogin=1\" target=\"_top\">Click to Continue to Login</a>";
	}
}
if ($type == "solos")
{
$q = "insert into solos_viewed (userid,adid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$soloscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $soloscredits . " Bonus Credits for Clicking a Solo Ad!";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting!";
	}
}
if ($type == "creditsolos")
{
$q = "insert into creditsolos_viewed (userid,adid) values (\"$userid\",\"$id\")";
$r = mysql_query($q);
	if ($enablecreditssystem == "yes")
	{
	mysql_query("update members set credits=credits+".$creditsoloscredits." where userid=\"$userid\"");
	$show = "You Have Earned " . $creditsoloscredits . " Bonus Credits for Clicking a Solo Ad!";
	}
	if ($enablecreditssystem != "yes")
	{
	$show = "Thanks for Visiting!";
	}
}
} # if ($userid != "")

$clicksq = "update $type set clicks=clicks+1 where id=\"$id\"";
$clicksr = mysql_query($clicksq);
if ($show != "")
{
echo $show;
}
else
{
echo "Thanks for Visiting!";
}
include "banners.php";
?>
</center>
</body>
</html>