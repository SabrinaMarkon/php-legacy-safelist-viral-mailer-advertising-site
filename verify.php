<?php
include "db.php";
$userid = $_GET["userid"];
$code = $_GET["code"];
$type = $_GET["type"];
$email = $_GET["email"];
$show = "";
if ($type != "submitter")
{
	if ((empty($userid)) or (empty($code)))
	{
	$show = "Invalid link";
	}
	$q = "select * from members where userid=\"$userid\" and verifycode=\"$code\"";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
	$show = "Invalid link";
	}
	if ($show != "")
	{
	include "header.php";
	include "banners.php";
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2">
	<?php
	echo $show;
	?>
	</td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}
} # if ($type != "submitter")
if ($type == "submitter")
{
	if ((empty($userid)) or (empty($email)))
	{
	$show = "Invalid link";
	}
	$q = "select * from members where userid=\"$userid\" and email=\"$email\"";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
	$show = "Invalid link";
	}
	if ($show != "")
	{
	include "header.php";
	include "banners.php";
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2">
	<?php
	echo $show;
	?>
	</td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}
} # if ($type == "submitter")

$password = mysql_result($r,0,"password");
$accounttype = mysql_result($r,0,"accounttype");
$q2 = "update members set verified=\"yes\",verifieddate=NOW() where userid=\"$userid\"";
$r2 = mysql_query($q2);

############################ SPECIAL OFFERS
$gotourl = "";
$showwhen = "After Verification";
# first see if there are any one-time view offerpages that the member hasn't seen yet.
$offerq = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow=\"Once Only\" order by rand() limit 1";
$offerr = mysql_query($offerq);
$offerrows = mysql_num_rows($offerr);
if ($offerrows < 1)
{
# there are no one-time view offerpages in the system at all. See if there are any always-view offerpages to show the member after verification.
$offerq2 = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow!=\"Once Only\" order by rand() limit 1";
$offerr2 = mysql_query($offerq2);
$offerrows2 = mysql_num_rows($offerr2);
	if ($offerrows2 < 1)
		{
		# there are no offerpages to show the member after verification. Just go to members' area.
		$gotourl = $domain . "/members.php?loginusername=" . $userid . "&loginpassword=" . $password . "&newlogin=1";
		}
	if ($offerrows2 > 0)
		{
		# there is an always-view offerpage to show the member. Go to that one.
		$id = mysql_result($offerr2,0,"id");
		$gotourl = "offerpage.php?id=" . $id. "&showwhen=" . $showwhen . "&loginusername=" . $userid . "&loginpassword=" . $password;
		}
} # if ($offerrows < 1)
##############
if ($offerrows > 0)
{
# there is a one-time view offerpage. See if the member has seen it or not. 
$id = mysql_result($offerr,0,"id");
$offerviewedq = "select * from offerpages_viewed where offerpageid=\"$id\" and userid=\"$userid\"";
$offerviewedr = mysql_query($offerviewedq);
$offerviewedrows = mysql_num_rows($offerviewedr);
	if ($offerviewedrows < 1)
	{
	# the member hasn't seen this one-time view offerpage. Go to that one.
	$gotourl = "offerpage.php?id=" . $id. "&showwhen=" . $showwhen . "&loginusername=" . $userid . "&loginpassword=" . $password;
	}
	if ($offerviewedrows > 0)
	{
	# the member has already seen this one-time view offerpage. See if there is an always-view offerpage to show instead.
	$offerq2 = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow!=\"Once Only\" order by rand() limit 1";
	$offerr2 = mysql_query($offerq2);
	$offerrows2 = mysql_num_rows($offerr2);
		if ($offerrows2 < 1)
			{
			# there are no offerpages to show the member after verification. Just go to members' area.
			$gotourl = $domain . "/members.php?loginusername=" . $userid . "&loginpassword=" . $password . "&newlogin=1";
			}
		if ($offerrows2 > 0)
			{
			# there is an always-view offerpage to show the member. Go to that one.
			$id = mysql_result($offerr2,0,"id");
			$gotourl = "offerpage.php?id=" . $id. "&showwhen=" . $showwhen . "&loginusername=" . $userid . "&loginpassword=" . $password;
			}
	} # if ($offerviewedrows > 0)
} # if ($offerrows > 0)
############################## END SPECIAL OFFERS
@header("Location: " . $gotourl);
exit;
?>