<?php
include "../db.php";
###########################
#          RENEW SUBSCRIPTIONS            #
###########################
$today = date('Y-m-d',strtotime("now"));
$hourrightnow = date('H',strtotime("now"));
$dayrightnow = date('d',strtotime("now"));
$rightnow = date("YmdHis");
# run this section once every 24 hours only.
if ($hourrightnow == "23")
{
$q = "select * from members where accounttype=\"PAID\"";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows > 0)
	{
	while ($rowz = mysql_fetch_array($r))
		{
		$userid = $rowz["userid"];
		$membershiplastpaid = $rowz["membershiplastpaid"];
		$ewallet = $rowz["ewallet"];
		$referid = $rowz["referid"];

		if ($membershiplastpaid != "")
		{
			if ($joinpriceinterval == "Annually")
			{
			$nextdue = date('Y-m-d', strtotime("+1 years", strtotime($membershiplastpaid)));
			}
			if ($joinpriceinterval != "Annually")
			{
			$nextdue = date('Y-m-d', strtotime("+1 months", strtotime($membershiplastpaid)));
			}
		}
		if ($membershiplastpaid == "")
		{
			$lastdue = date('Y-m-d', strtotime("-1 months", strtotime("now")));
			$mq = "update members set membershiplastpaid=\"$lastdue\" where userid=\"$userid\"";
			$mr = mysql_query($mq);
			$nextdue = $today;
			$membershiplastpaid = $lastdue;
		}

			if (($nextdue <= $today) and ($membershiplastpaid < $nextdue))
			{
				if ($ewallet >= $joinprice)
				{
				mysql_query("INSERT INTO transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - Paid Membership Renewal',NOW(),'".$joinprice."')");
				$eq = "update members set ewallet=ewallet-" . $joinprice . ",membershiplastpaid=\"$nextdue\",accounttype=\"PAID\" where userid=\"$userid\"";
				$er = mysql_query($eq);

				# sponsor commission
				$refq = "select * from members where userid=\"$referid\"";
				$refr = mysql_query($refq);
				$refrows = mysql_num_rows($refr);
				if ($refrows > 0)
					{
					$refaccounttype = mysql_result($refr,0,"accounttype");
					if ($refaccounttype == "PAID")
						{
						$adpackcommission = $adpackcommissionpaid;
						}
					if ($refaccounttype != "PAID")
						{
						$adpackcommission = $adpackcommissionfree;
						}
					$ewalletq = "update members set ewallet=ewallet+" . $adpackcommission . " where userid=\"$referid\"";
					$ewalletr = mysql_query($ewalletq);
					$refq3 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$adpackcommission\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Paid For Membership Renewal\")";
					$refr3 = mysql_query($refq3);
					}
				} # if ($ewallet >= $joinprice)
				else
				{
					if ($enableautodowngrade == "yes")
					{
						$autodowngradedate = date('Y-m-d', strtotime("+$autodowngradeafterhowmanydayslatepay days", strtotime($nextdue)));
						if ($autodowngradedate <= $today)
						{
							$downq = "update members set accounttype=\"FREE\" where userid=\"$userid\"";
							$downr = mysql_query($downq);
						} # if ($autodowngradedate <= $today)
					} # if ($enableautodowngrade == "yes")
				} # else
			} # if (($nextdue <= $today) and ($membershiplastpaid < $nextdue))
		} # while ($rowz = mysql_fetch_array($r))
	} # if ($rows > 0)
} # if ($hourrightnow == "23")
###########################
#             MONTHLY BONUSES			      #
###########################
if (($dayrightnow == "01") and ($hourrightnow == "23"))
{
$q = "select * from members where verified=\"yes\"";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows > 0)
	{
	while ($rowz = mysql_fetch_array($r))
		{
		$userid = $rowz["userid"];
		$accounttype = $rowz["accounttype"];
		if ($accounttype == "PAID")
			{
			$bonusfield = "bonuspaid";
			$levelname = $level2name;
			}
		if ($accounttype != "PAID")
			{
			$bonusfield = "bonusfree";
			$levelname = $level1name;
			}
		#### START MONTHLY BONUSES ####
		$bonusq = "select * from bonuses where enable=\"yes\" and $bonusfield=\"yes\" and bonustype=\"Monthly\" order by id";
		$bonusr = mysql_query($bonusq);
		$bonusrows = mysql_num_rows($bonusr);
		if ($bonusrows > 0)
			{
			while ($bonusrowz = mysql_fetch_array($bonusr))
				{
				$bonusid = $bonusrowz["id"];
				$bonusname = $bonusrowz["bonusname"];
				$bonustype = $bonusrowz["bonustype"];
				$bonuscredits = $bonusrowz["credits"];
				$bonussolo_num = $bonusrowz["solo_num"];
				$bonusbanner_num = $bonusrowz["banner_num"];
				$bonusbanner_views = $bonusrowz["banner_views"];
				$bonusbutton_num = $bonusrowz["button_num"];
				$bonusbutton_views = $bonusrowz["button_views"];
				$bonustextad_num = $bonusrowz["textad_num"];
				$bonustextad_views = $bonusrowz["textad_views"];
				$bonusfullloginad_num = $bonusrowz["fullloginad_num"];
				$bonusfullloginad_views = $bonusrowz["fullloginad_views"];
					if ($enablecreditssystem != "yes")
						{
						$bonuscredits = 0;
						}
				##############################
				if ($bonuscredits > 0)
					{
						mysql_query("update members set credits=credits+".$bonuscredits." where userid=\"$userid\"");
					}
				if ($bonussolo_num > 0)
					{
						$count = $bonussolo_num;
						while($count > 0) {
							mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
							$count--;
						}
					}
				if (($bonusbanner_num > 0) and ($bonusbanner_views > 0)) 
					{
						$count = $bonusbanner_num;
						while($count > 0)
						{
						mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$bonusbanner_views."','".time()."')");
						$count--;
						}
					}
				if (($bonusbutton_num > 0) and ($bonusbutton_views > 0)) 
					{
						$count = $bonusbutton_num;
						while($count > 0)
						{
						mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$bonusbutton_views."','".time()."')");
						$count--;
						}
					}
				if (($bonustextad_num > 0) and ($bonustextad_views > 0)) 
					{
						$count = $bonustextad_num;
						while($count > 0)
						{
						mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$bonustextad_views."','".time()."')");
						$count--;
						}
					}
				if (($bonusfullloginad_num > 0) and ($bonusfullloginad_views > 0)) 
					{
						$count = $bonusfullloginad_num;
						while($count > 0)
						{
						mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$bonusfullloginad_views."','".time()."')");
						$count--;
						}
					}
				$bonusq2 = "update bonuses set howmanytimesgiven=howmanytimesgiven+1 where id=\"$bonusid\"";
				$bonusr2 = mysql_query($bonusq2);
				mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','" . $levelname . " Monthly Bonus','" . $bonusname . " " . $bonustype . " Bonus',NOW(),'0.00')");
				} # while ($bonusrowz = mysql_fetch_array($bonusr))
			} # if ($bonusrows > 0)
		#### END MONTHLY BONUSES ####
		} # while ($rowz = mysql_fetch_array($r))
	} # if ($rows > 0)
} # if (($dayrightnow == "01") and ($hourrightnow == "23"))
###########################
#              SEND SITE MAIL					  #
###########################
################################### START SOLO ADS ############################################
$query3 = "select * from solos where approved=1 and sent=0 limit 1";
$result3 = mysql_query ($query3) or die (mysql_error());
$numrows2 = @ mysql_num_rows($result3);
if ($numrows2 > 0)
{
$line3 = mysql_fetch_array($result3);
$subject = $line3["subject"];
$subject = stripslashes($subject);
$subject = str_replace('\\', '', $subject);
$adbody = $line3["adbody"];
$adbody = stripslashes($adbody);
$adbody = str_replace('\\', '', $adbody);
$id = $line3["id"];
$adsender = $line3["userid"];
$query5 = "update solos set sent=1 where id='$id'";
$result5 = mysql_query ($query5) or die (mysql_error());   
$query6 = "update solos set datesent='".time()."' where id='$id'";
$result6 = mysql_query ($query6) or die (mysql_error());
$query4 = "select * from members where verified='yes' and vacation='no'";
$result4 = mysql_query($query4);
while ($line4 = mysql_fetch_array($result4))
{
    $email = $line4["email"];
    $accounttype = $line4["accounttype"];
    $userid = $line4["userid"];
	$firstname = $line4["firstname"];
	$lastname = $line4["lastname"];
	$fullname = $firstname . " " . $lastname;
	$affiliate_url = $domain . "/index.php?referid=" . $userid;
    $password = $line4["password"];
	if ($accounttype == "PAID")
	{
	$soloscredits = $soloscreditspaid;
	}
	if ($accounttype != "PAID")
	{
	$soloscredits = $soloscreditsfree;
	}
    $Subject = "[" . $sitename . "] ".$subject;
    $Message = $adbody;
    $Message .= "<br><br>--------------------------------------------------------------<br><br>";
	if ($enablecreditssystem == "yes")
	{
	$Message .= "<a href=\"".$domain."/click1.php?userid=".$userid."&id=".$id."&type=solos\">Click Here for " . $soloscredits . " Bonus Credits!</a>";
	}
	if ($enablecreditssystem != "yes")
	{
	$Message .= "<a href=\"".$domain."/click1.php?userid=".$userid."&id=".$id."&type=solos\">Click Here to Visit! ".$domain."/click1.php?userid=".$userid."&id=".$id."&type=solos</a>";
	}
	$Message .= "<br><br>This Solo was submitted by " . $sitename . " member $adsender - $rightnow";
	$Message .= ".<br><br>";
	$Message .= "--------------------------------------------------------------<br><br>";
	$Message .= "This is a Solo Advertisement from a member of ".$sitename.". You are receiving this because you are a double opted-in member of " . $sitename . " with userid " . $userid . "<br><br>";
	$Message .= "You can opt out of receiving all emails from this website by deleting your account by clicking here:<br><br><a href=\"$domain/remove.php?r=".$email."\">".$domain."/remove.php?r=".$email."</a>.<br><br>";
	$Message .= "Kindly allow up to 24 hours to stop receiving list mail once you delete your account.<br><br>";
	$Message .= "Thank you,<br>$adminname<br>$sitename<br><br><br>";
	$Message .= "Live Removal Assistance or Questions (Network): <a href='mailto:sabrina@sunshinehosting.net'>sabrina@sunshinehosting.net</a> or <a href='http://sunshinehosting.net/helpdesk'>http://sunshinehosting.net/helpdesk</a><br><br>This commercial email is sent in strict compliance with International spam laws.<br><br>Sabrina Markon, <a href='http://sunshinehosting.net'>SunshineHosting.net</a>, <a href='http://phpsitescripts.com'>PHPSiteScripts.com</a><br>Marc Tori, <a href='http://e-webs.us'>e-Webs.us</a><br>1338-41 Street, S.E.<br>Calgary, AB<br>Canada<br>T2A 1K6<br><br>";

	$headers = "From: $sitename<$bounceemail>\n";
	$headers .= "Reply-To: <$bounceemail>\n";
	$headers .= "X-Sender: <$bounceemail>\n";
	$headers .= "X-Mailer: PHP5 - PHPSiteScripts\n";
	$headers .= "X-UserID: " . $userid . "\n";
	$headers .= "X-Subscribed: " . $email . "\n";
	$headers .= "X-Domain: " . $domain . "\n";
	$headers .= "X-Priority: 3\n";
	$headers .= "Precedence: bulk\n";
	$headers .= "List-Unsubscribe: <mailto:" . $adminemail . ">, <" . $domain . "/remove.php?r=" . $email . ">\n";
	$headers .= "Return-Path: <" . $bounceemail . ">\nContent-type: text/html; charset=iso-8859-1\n";

	$Message = str_replace("~AFFILIATE_URL~",$affiliate_url,$Message);
	$Message = str_replace("~USERID~",$userid,$Message);
	$Message = str_replace("~FULLNAME~",$fullname,$Message);
	$Message = str_replace("~FIRSTNAME~",$firstname,$Message);
	$Message = str_replace("~LASTNAME~",$lastname,$Message);
	$Message = str_replace("~EMAIL~",$email,$Message);
	$Subject = str_replace("~AFFILIATE_URL~",$affiliate_url,$Subject);
	$Subject = str_replace("~USERID~",$userid,$Subject);
	$Subject = str_replace("~FULLNAME~",$fullname,$Subject);
	$Subject = str_replace("~FIRSTNAME~",$firstname,$Subject);
	$Subject = str_replace("~LASTNAME~",$lastname,$Subject);
	$Subject = str_replace("~EMAIL~",$email,$Subject);

    @mail($email, $Subject, wordwrap(stripslashes($Message)),$headers, "-f$bounceemail");

    $counter=$counter+1;

#echo "Mail sent to " . $email . "<br>";
}
} # if ($numrows2 > 0)
$ssq1 = "select * from solos where added=1 and sent=1 and datesent<='".(time()-31*24*60*60)."'";
$ssr1 = mysql_query($ssq1) or die(mysql_error());
while($ssrowz1 = mysql_fetch_array($ssr1))
{
$ssq3 = "delete from solos where id='".$ssrowz1['id']."'";
$ssr3 = mysql_query($ssq3);
}
################################### START CREDIT EMAILS ############################################
if ($enablecreditssystem == "yes")
{
$query3 = "select * from creditsolos where sent=0 limit 1";
$result3 = mysql_query ($query3) or die (mysql_error());
$numrows2 = @ mysql_num_rows($result3);
if ($numrows2 > 0)
{
$line3 = mysql_fetch_array($result3);
$creditcost = $line3["creditcost"];
$subject = $line3["subject"];
$subject = stripslashes($subject);
$subject = str_replace('\\', '', $subject);
$adbody = $line3["adbody"];
$adbody = stripslashes($adbody);
$adbody = str_replace('\\', '', $adbody);
$id = $line3["id"];
$adsender = $line3["userid"];
$query5 = "update creditsolos set sent=1 where id='$id'";
$result5 = mysql_query ($query5) or die (mysql_error());   
$query6 = "update creditsolos set datesent='".time()."' where id='$id'";
$result6 = mysql_query ($query6) or die (mysql_error());
$query4 = "select * from members where verified='yes' and vacation='no' order by rand() limit $creditcost";
$result4 = mysql_query($query4);
while ($line4 = mysql_fetch_array($result4))
{
    $email = $line4["email"];
    $accounttype = $line4["accounttype"];
    $userid = $line4["userid"];
	$firstname = $line4["firstname"];
	$lastname = $line4["lastname"];
	$fullname = $firstname . " " . $lastname;
	$affiliate_url = $domain . "/index.php?referid=" . $userid;
    $password = $line4["password"];
	if ($accounttype == "PAID")
	{
	$creditsoloscredits = $creditsoloscreditspaid;
	}
	if ($accounttype != "PAID")
	{
	$creditsoloscredits = $creditsoloscreditsfree;
	}
    $Subject = "[" . $sitename . "] ".$subject;
    $Message = $adbody;
    $Message .= "<br><br>--------------------------------------------------------------<br><br>";
	$Message .= "<a href=\"".$domain."/click1.php?userid=".$userid."&id=".$id."&type=creditsolos\">Click Here for " . $creditsoloscredits . " Bonus Credits!</a>";
	$Message .= "<br><br>This Solo was submitted by " . $sitename . " member $adsender - $rightnow";
    $Message .= ".<br><br>";
    $Message .= "--------------------------------------------------------------<br><br>";
	$Message .= "This is a Solo Advertisement from a member of ".$sitename.". You are receiving this because you are a double opted-in member of " . $sitename . " with userid " . $userid . "<br><br>";
	$Message .= "You can opt out of receiving all emails from this website by deleting your account by clicking here:<br><br><a href=\"$domain/remove.php?r=".$email."\">".$domain."/remove.php?r=".$email."</a>.<br><br>";
	$Message .= "Kindly allow up to 24 hours to stop receiving list mail once you delete your account.<br><br>";
	$Message .= "Thank you,<br>$adminname<br>$sitename<br><br><br>";
	$Message .= "Live Removal Assistance or Questions (Network): <a href='mailto:sabrina@sunshinehosting.net'>sabrina@sunshinehosting.net</a> or <a href='http://sunshinehosting.net/helpdesk'>http://sunshinehosting.net/helpdesk</a><br><br>This commercial email is sent in strict compliance with International spam laws.<br><br>Sabrina Markon, <a href='http://sunshinehosting.net'>SunshineHosting.net</a>, <a href='http://phpsitescripts.com'>PHPSiteScripts.com</a><br>Marc Tori, <a href='http://e-webs.us'>e-Webs.us</a><br>1338-41 Street, S.E.<br>Calgary, AB<br>Canada<br>T2A 1K6<br><br>";

	$headers = "From: $sitename<$bounceemail>\n";
	$headers .= "Reply-To: <$bounceemail>\n";
	$headers .= "X-Sender: <$bounceemail>\n";
	$headers .= "X-Mailer: PHP5 - PHPSiteScripts\n";
	$headers .= "X-UserID: " . $userid . "\n";
	$headers .= "X-Subscribed: " . $email . "\n";
	$headers .= "X-Domain: " . $domain . "\n";
	$headers .= "X-Priority: 3\n";
	$headers .= "Precedence: bulk\n";
	$headers .= "List-Unsubscribe: <mailto:" . $adminemail . ">, <" . $domain . "/remove.php?r=" . $email . ">\n";
	$headers .= "Return-Path: <" . $bounceemail . ">\nContent-type: text/html; charset=iso-8859-1\n";

	$Message = str_replace("~AFFILIATE_URL~",$affiliate_url,$Message);
	$Message = str_replace("~USERID~",$userid,$Message);
	$Message = str_replace("~FULLNAME~",$fullname,$Message);
	$Message = str_replace("~FIRSTNAME~",$firstname,$Message);
	$Message = str_replace("~LASTNAME~",$lastname,$Message);
	$Message = str_replace("~EMAIL~",$email,$Message);
	$Subject = str_replace("~AFFILIATE_URL~",$affiliate_url,$Subject);
	$Subject = str_replace("~USERID~",$userid,$Subject);
	$Subject = str_replace("~FULLNAME~",$fullname,$Subject);
	$Subject = str_replace("~FIRSTNAME~",$firstname,$Subject);
	$Subject = str_replace("~LASTNAME~",$lastname,$Subject);
	$Subject = str_replace("~EMAIL~",$email,$Subject);

    @mail($email, $Subject, wordwrap(stripslashes($Message)),$headers, "-f$bounceemail");

    $counter=$counter+1;

#echo "Mail sent to " . $email . "<br>";
}
} # if ($numrows2 > 0)
$ssq1 = "select * from creditsolos where sent=1 and datesent<='".(time()-31*24*60*60)."'";
$ssr1 = mysql_query($ssq1) or die(mysql_error());
while($ssrowz1 = mysql_fetch_array($ssr1))
{
$ssq3 = "delete from creditsolos where id='".$ssrowz1['id']."'";
$ssr3 = mysql_query($ssq3);
}
} # if ($enablecreditssystem == "yes")
################################### START ADMIN ADS ##########################################
$query3 = "select * from adminemails where sent=0 limit 1";
$result3 = mysql_query ($query3) or die (mysql_error());
$numrows2 = @ mysql_num_rows($result3);
if ($numrows2 > 0)
{
$line3 = mysql_fetch_array($result3);
$subject = $line3["subject"];
$subject = stripslashes($subject);
$subject = str_replace('\\', '', $subject);
$adbody = $line3["adbody"];
$adbody = stripslashes($adbody);
$adbody = str_replace('\\', '', $adbody);
$id = $line3["id"];
$sendtopaid = $line3["sendtopaid"];
$sendtofree = $line3["sendtofree"];

$query5 = "update adminemails set sent=1 where id='$id'";
$result5 = mysql_query ($query5) or die (mysql_error());   
$query6 = "update adminemails set datesent='".time()."' where id='$id'";
$result6 = mysql_query ($query6) or die (mysql_error());

$query4 = "select * from members where verified='yes' and vacation='no'";
if ($sendtopaid == "yes")
{
if ($sendtofree == "yes")
	{
	$query4 = $query4 . " and (accounttype='PAID' or accounttype='FREE')";
	}
if ($sendtofree != "yes")
	{
	$query4 = $query4 . " and accounttype='PAID'";
	}
} # if ($sendtopaid == "yes")
else
{
$query4 = $query4 . " and accounttype='FREE'";
}

$result4 = mysql_query($query4);
while ($line4 = mysql_fetch_array($result4))
{
    $email = $line4["email"];
    $accounttype = $line4["accounttype"];
    $userid = $line4["userid"];
	$firstname = $line4["firstname"];
	$lastname = $line4["lastname"];
	$fullname = $firstname . " " . $lastname;
	$affiliate_url = $domain . "/index.php?referid=" . $userid;
    $password = $line4["password"];
	if ($accounttype == "PAID")
	{
	$adminemailscredits = $adminemailscreditspaid;
	}
	if ($accounttype != "PAID")
	{
	$adminemailscredits = $adminemailscreditsfree;
	}
    $Subject = "[" . $sitename . " Admin] ".$subject;
    $Message = $adbody;
    $Message .= "<br><br>--------------------------------------------------------------<br><br>";
	if ($enablecreditssystem == "yes")
	{
	$Message .= "<a href=\"".$domain."/click1.php?userid=".$userid."&id=".$id."&type=adminemails\">Click Here for " . $adminemailscredits . " Bonus Credits!</a>";
	}
	if ($enablecreditssystem != "yes")
	{
	 $Message .= "<a href=\"".$domain."/click1.php?userid=".$userid."&id=".$id."&type=adminemails\">Click Here to Visit! ".$domain."/click1.php?userid=".$userid."&id=".$id."&type=adminemails</a>";
	}
	$Message .= "<br><br>This " . $sitename . " Ad was submitted by the site admin $adminname - $rightnow";
    $Message .= ".<br><br>";
    $Message .= "--------------------------------------------------------------<br><br>";
	$Message .= "This is an Admin Advertisement.Notification from the admin of ".$sitename.". You are receiving this because you are a double opted-in member of " . $sitename . " with userid " . $userid . "<br>";
	$Message .= "You can opt out of receiving all emails from this website by deleting your account by clicking here:<br><br><a href=\"$domain/remove.php?r=".$email."\">".$domain."/remove.php?r=".$email."</a>.<br><br>";
	$Message .= "Kindly allow up to 24 hours to stop receiving list mail once you delete your account.<br><br>";
	$Message .= "Thank you,<br>$adminname<br>$sitename<br><br><br>";
	$Message .= "Live Removal Assistance or Questions (Network): <a href='mailto:sabrina@sunshinehosting.net'>sabrina@sunshinehosting.net</a> or <a href='http://sunshinehosting.net/helpdesk'>http://sunshinehosting.net/helpdesk</a><br><br>This commercial email is sent in strict compliance with International spam laws.<br><br>Sabrina Markon, <a href='http://sunshinehosting.net'>SunshineHosting.net</a>, <a href='http://phpsitescripts.com'>PHPSiteScripts.com</a><br>Marc Tori, <a href='http://e-webs.us'>e-Webs.us</a><br>1338-41 Street, S.E.<br>Calgary, AB<br>Canada<br>T2A 1K6<br><br>";

	$headers = "From: $sitename<$bounceemail>\n";
	$headers .= "Reply-To: <$bounceemail>\n";
	$headers .= "X-Sender: <$bounceemail>\n";
	$headers .= "X-Mailer: PHP5 - PHPSiteScripts\n";
	$headers .= "X-UserID: " . $userid . "\n";
	$headers .= "X-Subscribed: " . $email . "\n";
	$headers .= "X-Domain: " . $domain . "\n";
	$headers .= "X-Priority: 3\n";
	$headers .= "Precedence: bulk\n";
	$headers .= "List-Unsubscribe: <mailto:" . $adminemail . ">, <" . $domain . "/remove.php?r=" . $email . ">\n";
	$headers .= "Return-Path: <" . $bounceemail . ">\nContent-type: text/html; charset=iso-8859-1\n";

	$Message = str_replace("~AFFILIATE_URL~",$affiliate_url,$Message);
	$Message = str_replace("~USERID~",$userid,$Message);
	$Message = str_replace("~FULLNAME~",$fullname,$Message);
	$Message = str_replace("~FIRSTNAME~",$firstname,$Message);
	$Message = str_replace("~LASTNAME~",$lastname,$Message);
	$Message = str_replace("~EMAIL~",$email,$Message);
	$Subject = str_replace("~AFFILIATE_URL~",$affiliate_url,$Subject);
	$Subject = str_replace("~USERID~",$userid,$Subject);
	$Subject = str_replace("~FULLNAME~",$fullname,$Subject);
	$Subject = str_replace("~FIRSTNAME~",$firstname,$Subject);
	$Subject = str_replace("~LASTNAME~",$lastname,$Subject);
	$Subject = str_replace("~EMAIL~",$email,$Subject);

    @mail($email, $Subject, wordwrap(stripslashes($Message)),$headers, "-f$bounceemail");

    $counter=$counter+1;

#echo "Mail sent to " . $email . "<br>";
}
} # if ($numrows2 > 0)
$ssq1 = "select * from adminemails where sent=1 and datesent<='".(time()-31*24*60*60)."'";
$ssr1 = mysql_query($ssq1) or die(mysql_error());
while($ssrowz1 = mysql_fetch_array($ssr1))
{
$ssq3 = "delete from adminemails where id='".$ssrowz1['id']."'";
$ssr3 = mysql_query($ssq3);
}
exit;
?>