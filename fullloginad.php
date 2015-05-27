<?php
include "control.php";
$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
$fplar = mysql_query($fplaq);
$fplarows = mysql_num_rows($fplar);
if ($fplarows > 0)
	{
	# show full page login ad in frames with timer.
	$fullloginadid = mysql_result($fplar,0,"id");
	$gotourl = $domain . "/click1.php?userid=".$userid."&id=".$fullloginadid."&type=fullloginads";
	} # if ($fplarows > 0)
if ($fplarows < 1)
	{
	$gotourl = "members.php";
	}
@header("Location: " . $gotourl);
?>