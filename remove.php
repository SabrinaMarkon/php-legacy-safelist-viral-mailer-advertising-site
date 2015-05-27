<?php
include "db.php";
include "header.php";
include "banners.php";
$r = $_REQUEST["r"];
$action = $_POST["action"];
$q1 = "select * from members where email=\"$r\" or userid=\"$r\"";
$r1 = mysql_query($q1);
$rows1 = mysql_num_rows($r1);
if ($rows1 < 1)
{
?>
<!-- CONTENT //-->
<table cellpadding="4" cellspacing="0" border="0" width="75%" align="center" class="sabrinatable">
<tr><td align="center" colspan="2"><br><div class="heading">ERROR</div></td></tr>
<tr><td colspan="2"><br>The email address or userid you entered, <?php echo $r ?> was not found. Please <a href="mailto:<?php echo $adminemail ?>">Contact Us</a> for assistance if you are having difficulty opting out. If you also forward us a copy of the mail you received this helps us to find your address to delete it if you are getting this error but are sure you're still receiving mail from us.
</td></tr>
<tr><td align="center" colspan="2">
<form action="remove.php" method="post">
Remove Email or UserID:&nbsp;<input type="text" name="r" maxlength="255" size="25" value="<?php echo $r ?>" class="typein">&nbsp;<input type="submit" value="DELETE ACCOUNT" class="sendit">
</form>
</td></tr>
<tr><td align="center" colspan="2"><br><a href="members.php">CANCEL</a></td></tr>
</table>
<!-- END CONTENT //-->
<?php
include "footer.php";
exit;
}
if ($rows1 > 0)
{
if ($action == "confirm")
	{
		while ($rowz1 = mysql_fetch_array($r1))
		{
		$deleteid = $rowz1["id"];
		$deleteuserid = $rowz1["userid"];
		$deleteemail = $rowz1["email"];
		mysql_query("delete from banners where userid='$deleteuserid'");
		mysql_query("delete from bannerviews where userid='$deleteuserid'");
		mysql_query("delete from banners_saved where userid='$deleteuserid'");
		mysql_query("delete from bounces where userid='$deleteuserid'");
		mysql_query("delete from buttons where userid='$deleteuserid'");
		mysql_query("delete from buttonviews where userid='$deleteuserid'");
		mysql_query("delete from buttons_saved where userid='$deleteuserid'");
		mysql_query("delete from creditsolos where userid='$deleteuserid'");
		mysql_query("delete from creditsolos_saved where userid='$deleteuserid'");
		mysql_query("delete from creditsolos_viewed where userid='$deleteuserid'");
		mysql_query("delete from cashoutrequests where userid='$deleteuserid'");
		mysql_query("delete from downlinemails where userid='$deleteuserid'");
		mysql_query("delete from textads where userid='$deleteuserid'");
		mysql_query("delete from textadviews where userid='$deleteuserid'");
		mysql_query("delete from textads_saved where userid='$deleteuserid'");
		mysql_query("delete from fullloginads where userid='$deleteuserid'");
		mysql_query("delete from fullloginadviews where userid='$deleteuserid'");
		mysql_query("delete from fullloginads_saved where userid='$deleteuserid'");
		mysql_query("delete from offerpages_viewed where userid='$deleteuserid'");
		mysql_query("delete from payouts where userid='$deleteuserid'");
		mysql_query("delete from promocodes_used where userid='$deleteuserid'");
		mysql_query("delete from adminemails_viewed where userid='$deleteuserid'");
		mysql_query("delete from solos where userid='$deleteuserid'");
		mysql_query("delete from solos_saved where userid='$deleteuserid'");
		mysql_query("delete from solos_viewed where userid='$deleteuserid'");
		mysql_query("delete from support where userid='$deleteuserid'");
		mysql_query("delete from textads where userid='$deleteuserid'");
		mysql_query("delete from textads_saved where userid='$deleteuserid'");
		mysql_query("delete from textadviews where userid='$deleteuserid'");
		mysql_query("delete from transactions where userid='$deleteuserid'");
		mysql_query("delete from members where userid='$deleteuserid'");
		} # while ($rowz1 = mysql_fetch_array($r1))
		?>
		<table cellpadding="4" cellspacing="0" border="0" width="75%" align="center" class="sabrinatable">
		<tr><td align="center" colspan="2"><br><div class="heading">YOUR ADDRESS WAS REMOVED COMPLETELY FROM OUR SYSTEM</div></td></tr>
		</table>
		<!-- END CONTENT //-->
		<?php
		include "footer.php";
		exit;
	} # if ($action == "confirm")
else
	{
?>
<table cellpadding="4" cellspacing="0" border="0" width="75%" align="center" class="sabrinatable">
<tr><td align="center" colspan="2"><br><div class="heading">Are you sure you want to be removed?</div></td></tr>
<tr><td align="center" colspan="2"><br>This action is irreversible, and you will lose any advertising campaigns, earnings, and referrals you have made!</td></tr>
<tr><td align="center" colspan="2">
<form action="remove.php" method="post">
<input type="hidden" name="r" maxlength="255" size="25" value="<?php echo $r ?>" class="typein"><input type="hidden" name="action" value="confirm"><input type="submit" value="DELETE ACCOUNT" class="sendit">
</form>
</td></tr>
<tr><td align="center" colspan="2"><br><a href="index.php">CANCEL</a></td></tr>
</table>
<?php
include "footer.php";
exit;
	} # else
} # if ($rows1 > 0)
?>
