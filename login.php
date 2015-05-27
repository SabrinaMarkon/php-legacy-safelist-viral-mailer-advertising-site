<?php
include "db.php";
include "header.php";
include "banners.php";
$show = $_GET["show"];
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Member Login</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
############################ SPECIAL OFFERS
$showwhen = "After Login";
# first see if there are any one-time view offerpages that the member hasn't seen yet.
$offerq = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow=\"Once Only\" order by rand() limit 1";
$offerr = mysql_query($offerq);
$offerrows = mysql_num_rows($offerr);
if ($offerrows < 1)
{
# there are no one-time view offerpages in the system at all. See if there are any always-view offerpages to show the member after login.
$offerq2 = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow!=\"Once Only\" order by rand() limit 1";
$offerr2 = mysql_query($offerq2);
$offerrows2 = mysql_num_rows($offerr2);
	if ($offerrows2 < 1)
		{
		# there are no offerpages to show the member after login. Check for full page login ads.
		$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
		$fplar = mysql_query($fplaq);
		$fplarows = mysql_num_rows($fplar);
		if ($fplarows > 0)
			{
			# show full page login ad
			$gotourl = "fullloginad.php";
			} # if ($fplarows > 0)
		else
			{
			$gotourl = "members.php";
			}
		} # if ($offerrows2 < 1)
	if ($offerrows2 > 0)
		{
		# there is an always-view offerpage to show the member. Go to that one.
		$id = mysql_result($offerr2,0,"id");
		$gotourl = "offerpage.php?id=" . $id. "&showwhen=" . $showwhen;
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
	$gotourl = "offerpage.php?id=" . $id. "&showwhen=" . $showwhen;
	}
	if ($offerviewedrows > 0)
	{
	# the member has already seen this one-time view offerpage. See if there is an always-view offerpage to show instead.
	$offerq2 = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow!=\"Once Only\" order by rand() limit 1";
	$offerr2 = mysql_query($offerq2);
	$offerrows2 = mysql_num_rows($offerr2);
		if ($offerrows2 < 1)
			{
			# there are no offerpages to show the member after login. Check for full page login ads.
			$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
			$fplar = mysql_query($fplaq);
			$fplarows = mysql_num_rows($fplar);
			if ($fplarows > 0)
				{
				# show full page login ad
				$gotourl = "fullloginad.php";
				} # if ($fplarows > 0)
			else
				{
				$gotourl = "members.php";
				}
			}
		if ($offerrows2 > 0)
			{
			# there is an always-view offerpage to show the member. Go to that one.
			$id = mysql_result($offerr2,0,"id");
			$gotourl = "offerpage.php?id=" . $id. "&showwhen=" . $showwhen;
			}
	} # if ($offerviewedrows > 0)
} # if ($offerrows > 0)
############################## END SPECIAL OFFERS
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Login Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

<form action="<?php echo $gotourl ?>" method="post" target="_top">
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="300">
<tr><td align="right">UserID:</td><td><input type="text" name="loginusername" class="typein" maxlength="255" size="25" value="demomember"></td></tr><tr><td align="right">Password:</td><td><input type="password" name="loginpassword" class="typein" maxlength="255" size="25" value="demopass"></td></tr>
<?php
if ($turingkeyenable == "yes")
{
?>
<tr><td align="center" colspan="2"><br>
<img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" style="border:1px solid #000000;" /><br><br>
<table cellpadding="4" cellspacing="2" border="0" align="center" width="220">
<tr><td align="right">Enter Code:</td><td><input type="text" name="captcha_code" size="10" maxlength="6" /></td><td><a href="#" onclick="document.getElementById('captcha').src = '/securimage/securimage_show.php?' + Math.random(); return false"><img src="<?php echo $domain ?>/securimage/images/refresh.png" border="Refresh Image" width="20" height="20"></a></td><td style="padding-left:5px;padding-top:2px;">
<object type="application/x-shockwave-flash" data="/securimage/securimage_play.swf?audio_file=/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" width="25" height="25">
<param name="wmode" value="transparent">
<param name="movie" value="/securimage/securimage_play.swf?audio_file=/securimage/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" />
</object></td></tr>
</table>
</td></tr>
<?php
} # if ($turingkeyenable == "yes")
?>
</table>
</td></tr>
<tr><td colspan="2" align="center"><br><input type="hidden" name="newlogin" value="1"><input type="hidden" name="referid" value="<?php echo $referid ?>"><input type="submit" value="LOGIN" class="sendit"></td></tr></form><tr><td colspan="2" align="center"><a href="lostlogin.php?referid=<?php echo $referid ?>">LOST LOGIN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
?>