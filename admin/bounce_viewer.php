<?php
include "control.php";
include "../header.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
$action = $_REQUEST["action"];
$show = "";
##############################################################################################
if ($action == "deletebounces")
{
$deleteuserid = $_POST["deleteuserid"];
$q = "delete from bounces where userid=\"$deleteuserid\"";
$r = mysql_query($q);
$show = "<center>Bounce Records Deleted</center><br><br>";
} # if ($action == "deletebounce")
##############################################################################################
if ($action == "confirmdeleteallbounces")
{
$show = "<center><form action=\"bounce_viewer.php\" method=\"post\"><input type=\"hidden\" name=\"action\" value=\"deleteallbounces\"><input type=\"submit\" value=\"Confirm Mass Deletion Of All Bounces\" style=\"width: 450px; border: 2px #ff0000 solid; border-style: outset;\"></form><br><form action=\"bounce_viewer.php\" method=\"post\"><input type=\"submit\" value=\"Cancel Mass Deletion\" style=\"width: 450px;\"></form></center>";
} # if ($action == "confirmdeleteallbounces")
##############################################################################################
if ($action == "deleteallbounces")
{
$q1 = "delete from bounces";
$r1 = mysql_query($q1);
$show = "<center>All Bounce Records Were Deleted</center><br><br>";
} # if ($action == "deleteallbounces")
##############################################################################################
$q3 = "delete from bounces where bouncedate<='".(time()-7*24*60*60)."'";
$r3 = mysql_query($q3);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td colspan="2" align="center"><div class="heading">Member Bounces</div></td></tr>
<tr><td colspan="2" align="center"><br>Bounce records are kept for 7 days then discarded in order to keep database size in check. Cleaning the database this way does NOT take members off vacation mode who bounced.</td></tr>
<tr><td colspan="2" align="center" style="height:15px;"></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
if ($show == "")
{
?>
<form action="bounce_viewer.php" method="post">
<tr><td align="center" colspan="2"><br>
<input type="hidden" name="action" value="confirmdeleteallbounces">
<input type="submit" value="Purge All Bounce Records">
</form>
</td></tr>
<?php
}

$countq = "select * from bounces";
$countr = mysql_query($countq);
$countrows = mysql_num_rows($countr);

$query = "SELECT *, count(userid) AS bouncecount FROM bounces GROUP BY userid";
$result = mysql_query ($query) or die(mysql_error());
$totalrows = mysql_num_rows($result);
if ($totalrows < 1)
{
?>
<tr><td align="center" colspan="2"><br>There have been no new bounced emails in the past 7 days.</td></tr>
<?php
}
if ($totalrows > 0)
{
?>
<tr><td align="center" colspan="2"><br>Total Bounced Emails: <?php echo $countrows ?></td></tr>

<tr><td align="center" colspan="2"><br>
<table width="90%" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<tr class="sabrinatrdark">
<td align="center">UserID</td>
<td align="center">Total Bounces</td>
<td align="center">Last Bounce Date</td>
<td align="center">Last Bounce Error</td>
<td align="center">Delete User Bounce Records</td>
</tr>
<?php
while ($line = mysql_fetch_array($result))
{
	$userid = $line["userid"];
	$bouncecount = $line["bouncecount"];
	$lastq = "select * from bounces where userid=\"$userid\" order by id desc limit 1";
	$lastr = mysql_query($lastq) or die(mysql_error());
	$lastrows = mysql_num_rows($lastr);
	if ($lastrows > 0)
	{
		$bounceerror = mysql_result($lastr,0,"bounceerror");
		$bounceerror = stripslashes($bounceerror);
		$bounceerror = str_replace('\\', '', $bounceerror);
		$bouncedate = mysql_result($lastr,0,"bouncedate");
		if (($bouncedate == "") or ($bouncedate == 0))
		{
			$showbouncedate = "";
		}
		else
		{
			$showbouncedate = formatDate($bouncedate);
		}
?>
<tr class="sabrinatrlight">
<td align="center"><?php echo $userid ?></td>
<td align="center"><?php echo $bouncecount ?></td>
<td align="center"><?php echo $showbouncedate ?></td>
<td align="center"><div style="width: 400px; height: 100px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; color: #000000; background: #ffffff;"><?php echo $bounceerror ?></div></td>
<form method="POST" action="bounce_viewer.php">
<td align="center">
<input type="hidden" name="deleteuserid" value="<?php echo $userid ?>">
<input type="hidden" name="action" value="deletebounces">
<input type="submit" value="Delete">
</form>
</td></tr>
<tr><td colspan="5"></td></tr>
<?php
	} # if ($lastrows > 0)
} # while ($line = mysql_fetch_array($result))
?>
</table><td></tr>
<?php
} # if ($totalrows > 0)
?>
</table><br><br>&nbsp;
<?php
include "../footer.php";
exit;
?>