<?php
include "db.php";
?>
<table cellpadding="2" cellspacing="2" border="0" width="200" style="margin-bottom:-13px;">
<tr><td align="center">
<?php
######################################################################## BANNERS
$bannerq = "select clicks,hits,bannerurl,targeturl from banners where approved=\"1\" order by id desc limit 51";
$bannerr = mysql_query($bannerq) or die(mysql_error());
$bannerrows = mysql_num_rows($bannerr);
if ($bannerrows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="200">
<tr bgcolor="#411240" style="font-size:10px;"><td align="center">RECENT BANNER ADS</td></tr>
<?php
$bannerbg = 0;
while ($bannerrowz = mysql_fetch_array($bannerr))
	{
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
?>
<tr bgcolor="<?php echo $bannerbgcolor ?>" style="font-size:10px;"><td align="center" colspan="2"><a href="<?php echo $bannertargeturl ?>" target="_blank"><img src="<?php echo $bannerbannerurl ?>" width="200" height="26" border="0"></a></td></tr>
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
</td></tr></table>