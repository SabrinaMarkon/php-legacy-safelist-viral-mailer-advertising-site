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
<?
if($_GET['id'])
{
$id = $_GET["id"];
$userid = $_GET["userid"];
$type = $_GET["type"];
$url = $_GET["url"];
$redirecturl = "click3.php?id=".$id."&userid=".$userid."&type=".$type."&url=".urlencode($url);
}
?>
<body style="background:#fff;color:#000;">
<center>
<?
if($_GET["message"])
{
$message = $_GET["message"];
	if($url)
	{
	?>
	<div style="float: left;">
	<a href="<?php echo $_GET['url']; ?>" target="_top">Remove This Frame</a>
	</div>
	<div style="float: right;">
	<a href="<?php echo $_GET['url']; ?>" target="_top">Remove This Frame</a>
	</div>
	<?
	}
echo $message;	
}
else
{
	if ($type == "adminemails")
	{
	$timer = $adminemailtimer;
	}
	if ($type == "banners")
	{
	$timer = $bannertimer;
	}
	if ($type == "buttons")
	{
	$timer = $buttontimer;
	}
	if ($type == "textads")
	{
	$timer = $textadtimer;
	}
	if ($type == "fullloginads")
	{
	$timer = $fullloginadtimer;
	}
	if ($type == "solos")
	{
	$timer = $solotimer;
	}
	if ($type == "creditsolos")
	{
	$timer = $creditsolotimer;
	}
?>
Please Visit the Website Below for <span id="plzwait"><?php echo $timer ?> Seconds</span>
<script type="text/javascript">
counter = <?php echo $timer ?>;
function countdown() {
	if ((0 <= 100) || (0 > 0)) {
		counter--;
		if(counter > 0) {
			document.getElementById("plzwait").innerHTML = '<b>'+counter+'<\/b> seconds';
			setTimeout('countdown()',1000);
		}
		if(counter < 1)
		{
		window.location="<?php echo $redirecturl ?>";
		}
	}
}
countdown();
</script>
<?php
}
?>
<br>
<?php
include "banners.php";
?>
</center>
</body>
</html>