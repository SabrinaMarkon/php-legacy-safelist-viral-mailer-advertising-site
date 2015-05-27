<?php
include "db.php";
?>
<table cellpadding="2" cellspacing="2" border="0" width="200" style="margin-bottom:-13px;">
<tr><td align="center">
<?php
######################################################################## FULL PAGE LOGIN ADS
$fullloginadq = "select hits,subject,url from fullloginads where approved=\"1\" order by id desc limit 10";
$fullloginadr = mysql_query($fullloginadq) or die(mysql_error());
$fullloginadrows = mysql_num_rows($fullloginadr);
if ($fullloginadrows > 0)
{
?>
<table cellpadding="2" cellspacing="2" border="0" align="center" bgcolor="#170616" width="200">
<tr bgcolor="#411240" style="font-size:10px;"><td align="center">RECENT FULL PAGE LOGIN ADS</td></tr>
<?php
$fullloginadbg = 0;
while ($fullloginadrowz = mysql_fetch_array($fullloginadr))
	{
	$fullloginadhits = $fullloginadrowz["hits"];
	$fullloginadurl = $fullloginadrowz["url"];
	$fullloginadsubject = $fullloginadrowz["subject"];
	if ($fullloginadbg == 0)
		{
		$fullloginadbgcolor = "#641b62";
		}
	if ($fullloginadbg != 0)
		{
		$fullloginadbgcolor = "#411240";
		}
?>
<tr bgcolor="<?php echo $fullloginadbgcolor ?>" style="font-size:10px;"><td align="center"><a href="<?php echo $fullloginadurl ?>" target="_blank"><?php echo $fullloginadsubject ?></a></td></tr>
<?php
	if ($fullloginadbgcolor == "#641b62")
		{
		$fullloginadbg = 1;
		}
	if ($fullloginadbgcolor != "#411240")
		{
		$fullloginadbg = 0;
		}
	}
?>
</table>
<?php
} # if ($fullloginadrows > 0)
?>
</td></tr></table>