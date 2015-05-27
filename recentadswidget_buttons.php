<?php
include "db.php";
?>
<table cellpadding="2" cellspacing="2" border="0" width="200" style="margin-bottom:-13px;">
<tr><td align="center">
<?php
######################################################################## BUTTONS
$buttonq = "select clicks,hits,bannerurl,targeturl from buttons where approved=\"1\" order by id desc limit 30";
$buttonr = mysql_query($buttonq) or die(mysql_error());
$buttonrows = mysql_num_rows($buttonr);
if ($buttonrows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="200">
<tr bgcolor="#411240" style="font-size:10px;"><td align="center" colspan="2">RECENT BUTTON ADS</td></tr>
<?php
$buttonbg = 0;
$howmany = 1;
$buttoncount = 1;
while ($buttonrowz = mysql_fetch_array($buttonr))
	{
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
	if ($howmany == 1)
	{
	?>
	<tr bgcolor="<?php echo $buttonbgcolor ?>" style="font-size:10px;">
	<?php
	}
	?>
	<td align="center"><a href="<?php echo $buttontargeturl ?>" target="_blank"><img src="<?php echo $buttonbannerurl ?>" width="100" height="100" border="0"></a></td>
	<?php
	if ($howmany != 1)
	{
		$howmany = 1;
	?>
	</tr>
	<?php
	}
	else
		{
		$howmany = 2;
			if ($buttoncount == $buttonrows)
			{
			?>
			<td align="center"></td>
			<?php
			}
		}
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