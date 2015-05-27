<?php
include "db.php";
?>
<table cellpadding="2" cellspacing="2" border="0" width="200" style="margin-bottom:-13px;">
<tr><td align="center">
<?php
######################################################################## SOLOS
$soloq = "select subject,url from solos where sent=\"1\" order by id desc limit 40";
$solor = mysql_query($soloq) or die(mysql_error());
$solorows = mysql_num_rows($solor);
if ($solorows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="200">
<tr bgcolor="#411240" style="font-size:10px;"><td align="center">RECENT SOLO ADS</td></tr>
<?php
$solobg = 0;
while ($solorowz = mysql_fetch_array($solor))
	{
	$solosubject = $solorowz["subject"];
	$solourl = $solorowz["url"];
	if ($solobg == 0)
		{
		$solobgcolor = "#641b62";
		}
	if ($solobg != 0)
		{
		$solobgcolor = "#411240";
		}
?>
<tr bgcolor="<?php echo $solobgcolor ?>" style="font-size:10px;"><td align="center"><a href="<?php echo $solourl ?>" target="_blank"><?php echo $solosubject ?></a></tr>
<?php
	if ($solobgcolor == "#641b62")
		{
		$solobg = 1;
		}
	if ($solobgcolor != "#411240")
		{
		$solobg = 0;
		}
	}
?>
</table>
<?php
} # if ($solorows > 0)
?>
</td></tr></table>