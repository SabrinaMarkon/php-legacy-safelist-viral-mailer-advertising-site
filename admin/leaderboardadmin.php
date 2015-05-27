<?php
include "control.php";
include "../header.php";
$leaderboarddisplay = "";
$tsq = "select referid, country, count(referid) as cnt from members where referid!='' group by referid order by cnt desc";
$tsr = mysql_query($tsq) or die(mysql_error());
$tsrows = mysql_num_rows($tsr);
if ($tsrows > 0)
{
$bg = 0;
while ($tsrowz = mysql_fetch_array($tsr))
{
if ($bg == 0)
	{
	$bgcolor = "sabrinatrlight";
	}
if ($bg != 0)
	{
	$bgcolor = "sabrinatrdark";
	}
$cnt = $tsrowz["cnt"];
$referid = $tsrowz["referid"];
$country = $tsrowz["country"];
$leaderboarddisplay = $leaderboarddisplay . "<tr class=\"$bgcolor\"><td align=\"center\">$referid</td><td align=\"center\">$cnt</td><td align=\"center\">$country</td></tr>";
if ($bgcolor == "sabrinatrlight")
	{
	$bg = 1;
	}
if ($bgcolor != "sabrinatrdark")
	{
	$bg = 0;
	}
}
}
if ($tsrows < 1)
{
$leaderboarddisplay = $leaderboarddisplay . "<tr class=\"sabrinatrlight\"><td align=\"center\" colspan=\"2\">There are no members yet.</td></tr>";
} # if ($tsrows < 1)
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading"><?php echo $sitename ?> Referral Leader Board</div></td></tr>
<tr><td align="center" colspan="2" style="height: 15px;"></td></tr>

<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="500">
<?php
echo $leaderboarddisplay;
?>
</table>
</td></tr>

</table>
<br><br>
<?php
include "../footer.php";
exit;
?>