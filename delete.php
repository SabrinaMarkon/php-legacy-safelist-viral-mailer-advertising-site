<?php
include "control.php";
include "header.php";
include "banners.php";
$action = $_POST["action"];
if ($action == "confirm")
{
mysql_query("delete from banners where userid='$userid'");
mysql_query("delete from bannerviews where userid='$userid'");
mysql_query("delete from banners_saved where userid='$userid'");
mysql_query("delete from bounces where userid='$userid'");
mysql_query("delete from buttons where userid='$userid'");
mysql_query("delete from buttonviews where userid='$userid'");
mysql_query("delete from buttons_saved where userid='$userid'");
mysql_query("delete from creditsolos where userid='$userid'");
mysql_query("delete from creditsolos_saved where userid='$userid'");
mysql_query("delete from creditsolos_viewed where userid='$userid'");
mysql_query("delete from cashoutrequests where userid='$userid'");
mysql_query("delete from downlinemails where userid='$userid'");
mysql_query("delete from textads where userid='$userid'");
mysql_query("delete from textadviews where userid='$userid'");
mysql_query("delete from textads_saved where userid='$userid'");
mysql_query("delete from fullloginads where userid='$userid'");
mysql_query("delete from fullloginadviews where userid='$userid'");
mysql_query("delete from fullloginads_saved where userid='$userid'");
mysql_query("delete from offerpages_viewed where userid='$userid'");
mysql_query("delete from payouts where userid='$userid'");
mysql_query("delete from promocodes_used where userid='$userid'");
mysql_query("delete from adminemails_viewed where userid='$userid'");
mysql_query("delete from solos where userid='$userid'");
mysql_query("delete from solos_saved where userid='$userid'");
mysql_query("delete from solos_viewed where userid='$userid'");
mysql_query("delete from support where userid='$userid'");
mysql_query("delete from textads where userid='$userid'");
mysql_query("delete from textads_saved where userid='$userid'");
mysql_query("delete from textadviews where userid='$userid'");
mysql_query("delete from transactions where userid='$userid'");
mysql_query("delete from members where userid='$userid'");
?>
<table cellpadding="4" cellspacing="0" border="0" width="75%" align="center">
<tr><td align="center" colspan="2"><br><div class="heading">YOUR ADDRESS WAS REMOVED COMPLETELY FROM OUR SYSTEM</div></td></tr>
</table>
<!-- END CONTENT //-->
<?php
include "footer.php";
exit;
} # if ($action == "confirm")
?>
<table cellpadding="4" cellspacing="0" border="0" width="75%" align="center">
<tr><td align="center" colspan="2"><br><div class="heading">Are you sure you want to be removed?</div></td></tr>
<tr><td align="center" colspan="2"><br>This action is irreversible, and you will lose any advertising campaigns, earnings, and referrals you have made!</td></tr>
<tr><td align="center" colspan="2"><br><br>
<form action="delete.php" method="post">
<input type="hidden" name="action" value="confirm"><input type="submit" value="DELETE ACCOUNT" class="sendit">
</form>
</td></tr>
<tr><td align="center" colspan="2"><br><a href="members.php">CANCEL</a></td></tr>
</table>
<?php
include "footer.php";
exit;
?>
