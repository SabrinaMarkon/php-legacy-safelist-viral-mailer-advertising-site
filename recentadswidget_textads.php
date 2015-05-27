<?php
include "db.php";
?>
<table cellpadding="2" cellspacing="2" border="0" width="200" style="margin-bottom:-13px;">
<tr><td align="center">
<?php
######################################################################## TEXT ADS
$textadq = "select heading,url from textads where approved=\"1\" order by id desc limit 40";
$textadr = mysql_query($textadq) or die(mysql_error());
$textadrows = mysql_num_rows($textadr);
if ($textadrows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="200">
<tr bgcolor="#411240" style="font-size:10px;"><td align="center">RECENT TEXT ADS</td></tr>
<?php
$textadbg = 0;
while ($textadrowz = mysql_fetch_array($textadr))
	{
	$textadheading = $textadrowz["heading"];
	$textadurl = $textadrowz["url"];
	if ($textadbg == 0)
		{
		$textadbgcolor = "#641b62";
		}
	if ($textadbg != 0)
		{
		$textadbgcolor = "#411240";
		}
?>
<tr bgcolor="<?php echo $textadbgcolor ?>" style="font-size:10px;"><td align="center"><a href="<?php echo $textadurl ?>" target="_blank"><?php echo $textadheading ?></a></tr>
<?php
	if ($textadbgcolor == "#641b62")
		{
		$textadbg = 1;
		}
	if ($textadbgcolor != "#411240")
		{
		$textadbg = 0;
		}
	}
?>
</table>
<?php
} # if ($textadrows > 0)
?>
</td></tr></table>