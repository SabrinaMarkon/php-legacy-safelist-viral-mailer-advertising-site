<?php
include "control.php";
############################ SPECIAL OFFERS
$gotourl = "";
$showwhen = "After Logout";
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
		# there are no offerpages to show the member after logout. Just go to home page.
		$gotourl = "index.php";
		}
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
			# there are no offerpages to show the member after logout. Just go to home page.
			$gotourl = "index.php";
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
@header("Location: " . $gotourl);
exit;