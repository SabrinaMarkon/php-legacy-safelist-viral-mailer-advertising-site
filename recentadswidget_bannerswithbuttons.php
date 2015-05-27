<?php
include "db.php";
?>
<table cellpadding="0" cellspacing="0" border="0">
<tr><td align="center" valign="top">
<?php
######################################################################## BANNERS
$bannerq = "select clicks,hits,bannerurl,targeturl from banners where approved=\"1\" and bannerurl!='' order by id desc limit 6";
$bannerr = mysql_query($bannerq) or die(mysql_error());
$bannerrows = mysql_num_rows($bannerr);
if ($bannerrows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="242">
<?php
$bannerbg = 0;
while ($bannerrowz = mysql_fetch_array($bannerr))
	{
	$bannerid = $bannerrowz["id"];
	$bannerclicks = $bannerrowz["clicks"];
	$bannerhits = $bannerrowz["hits"];
	$bannerbannerurl = $bannerrowz["bannerurl"];
	$bannertargeturl = $bannerrowz["targeturl"];
	if ($bannerbg == 0)
		{
		$bannerbgcolor = "#641b62";
		}
	if ($bannerbg != 0)
		{
		$bannerbgcolor = "#411240";
		}
	$clickurl = $domain . "/click1.php?userid=".$userid."&id=".$bannerid."&type=banners";
?>
<tr bgcolor="<?php echo $bannerbgcolor ?>"><td align="center" colspan="2"><a href="<?php echo $bannertargeturl ?>" target="_blank"><img src="<?php echo $bannerbannerurl ?>" width="242" border="0"></a></td></tr>
<?php
	if ($bannerbgcolor == "#641b62")
		{
		$bannerbg = 1;
		}
	if ($bannerbgcolor != "#411240")
		{
		$bannerbg = 0;
		}
	}
?>
</table>
<?php
} # if ($bannerrows > 0)
?>
</td><td align="center" rowspan="2" valign="top">
<?php
######################################################################## BUTTONS
$buttonq = "select clicks,hits,bannerurl,targeturl from buttons where approved=\"1\" and bannerurl!='' order by id desc limit 3";
$buttonr = mysql_query($buttonq) or die(mysql_error());
$buttonrows = mysql_num_rows($buttonr);
if ($buttonrows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="68">
<?php
$buttonbg = 0;
$buttoncount = 1;
$howmany = 1;
while ($buttonrowz = mysql_fetch_array($buttonr))
	{
	$buttonid = $buttonrowz["id"];
	$buttonclicks = $buttonrowz["clicks"];
	$buttonhits = $buttonrowz["hits"];
	$buttonbannerurl = $buttonrowz["bannerurl"];
	$buttontargeturl = $buttonrowz["targeturl"];
	if ($buttonbg == 0)
		{
		$buttonbgcolor = "#641b62";
		}
	if ($buttonbg != 0)
		{
		$buttonbgcolor = "#411240";
		}
	$clickurl = $domain . "/click1.php?userid=".$userid."&id=".$buttonid."&type=buttons";
	?>
	<tr bgcolor="<?php echo $buttonbgcolor ?>"><td align="center"><a href="<?php echo $clickurl ?>" target="_blank"><img src="<?php echo $buttonbannerurl ?>" width="73" border="0"></a></td></tr>
	<?php
	if ($buttonbgcolor == "#641b62")
		{
		$buttonbg = 1;
		}
	if ($buttonbgcolor != "#411240")
		{
		$buttonbg = 0;
		}
	$buttoncount = $buttoncount+1;
	}
?>
</table>
<?php
} # if ($buttonrows > 0)
?>
</td></tr></table>
