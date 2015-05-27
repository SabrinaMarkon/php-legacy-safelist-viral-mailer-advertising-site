<?php
include "control.php";
include "header.php";
include "banners.php";
$today = date('Y-m-d',strtotime("now"));
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
if ($_POST["newlogin"])
{
$newloginq = "update members set lastlogin=NOW() where userid=\"$userid\"";
$newloginr = mysql_query($newloginq);
}
########################################## START PROMO CODE HANDLING
$action = $_POST["action"];
if ($action == "redeemcode")
{
$code = $_POST["code"];
$codeq = "select * from promocodes where code=\"$code\" and enable=\"yes\"";
$coder = mysql_query($codeq);
$coderows = mysql_num_rows($coder);
if ($coderows < 1)
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="400">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td colspan="2" align="center"><br>The Promo Code you entered was not found in the system.</td></tr>
	<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}
if ($coderows > 0)
	{
	$codeid = mysql_result($coder,0,"id");
	$codename = mysql_result($coder,0,"name");
	$codemaximum = mysql_result($coder,0,"maximum");
	$codehowmanytimesclaimed = mysql_result($coder,0,"howmanytimesclaimed");
	$codepromocodefree = mysql_result($coder,0,"promocodefree");
	$codepromocodepaid = mysql_result($coder,0,"promocodepaid");
	$upgrade = mysql_result($coder,0,"upgrade");
	$credits = mysql_result($coder,0,"credits");
	$solo_num = mysql_result($coder,0,"solo_num");
	$banner_num = mysql_result($coder,0,"banner_num");
	$banner_views = mysql_result($coder,0,"banner_views");
	$button_num = mysql_result($coder,0,"button_num");
	$button_views = mysql_result($coder,0,"button_views");
	$textad_num = mysql_result($coder,0,"textad_num");
	$textad_views = mysql_result($coder,0,"textad_views");
	$fullloginad_num = mysql_result($coder,0,"fullloginad_num");
	$fullloginad_views = mysql_result($coder,0,"fullloginad_views");
	#####################################	
	
	$alreadyq = "select * from promocodes_used where userid=\"$userid\" and promocode=\"$code\"";
	$alreadyr = mysql_query($alreadyq);
	$alreadyrows = mysql_num_rows($alreadyr);
	if ($alreadyrows > 0)
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="400">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2" align="center"><br>You have already used Promo Code <?php echo $code ?>.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		}

	if ($codehowmanytimesclaimed >= $codemaximum)
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="400">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2" align="center"><br>The Promo Code you entered has reached the maximum allowed number of claims.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		} # if ($codehowmanytimesclaimed >= $codemaximum)
		if ($accounttype == "PAID")
		{
		$codepromocode = $codepromocodepaid;
		}
		if ($accounttype != "PAID")
		{
		$codepromocode = $codepromocodefree;
		}
		if ($codepromocode != "yes")
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="400">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2" align="center"><br>The Promo Code you entered is not available to your membership level.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		} # if ($codepromocode != "yes")
			if ($enablecreditssystem != "yes")
				{
				$credits = 0;
				}
		if (($upgrade == "yes") and ($accounttype == "FREE"))
			{
				$eq = "update members set accounttype=\"PAID\",membershiplastpaid=\"$today\" where userid=\"$userid\"";
				$er = mysql_query($eq);
			#### START SIGNUP BONUSES ####
			$bonusq = "select * from bonuses where enable=\"yes\" and bonuspaid=\"yes\" and bonustype=\"Sign-Up\" order by id";
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
					mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','New " . $level2name . " Member Bonus','" . $bonusname . " " . $bonustype . " Bonus',NOW(),'0.00')");
					} # while ($bonusrowz = mysql_fetch_array($bonusr))
				} # if ($bonusrows > 0)
			#### END SIGNUP BONUSES ####
			} # if (($upgrade == "yes") and ($accounttype == "FREE"))
		if ($credits > 0)
			{
				mysql_query("update members set credits=credits+".$credits." where userid=\"$userid\"");
			}
		if ($solo_num > 0)
			{
				$count = $solo_num;
				while($count > 0) {
					mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
					$count--;
				}
			}
		if (($banner_num > 0) and ($banner_views > 0)) 
			{
				$count = $banner_num;
				while($count > 0)
				{
				mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$banner_views."','".time()."')");
				$count--;
				}
			}
		if (($button_num > 0) and ($button_views > 0)) 
			{
				$count = $button_num;
				while($count > 0)
				{
				mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$button_views."','".time()."')");
				$count--;
				}
			}
		if (($textad_num > 0) and ($textad_views > 0)) 
			{
				$count = $textad_num;
				while($count > 0)
				{
				mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$textad_views."','".time()."')");
				$count--;
				}
			}
		if (($fullloginad_num > 0) and ($fullloginad_views > 0)) 
			{
				$count = $fullloginad_num;
				while($count > 0)
				{
				mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$fullloginad_views."','".time()."')");
				$count--;
				}
			}
	$codeq2 = "update promocodes set howmanytimesclaimed=howmanytimesclaimed+1 where id=\"$codeid\"";
	$coder2 = mysql_query($codeq2);
	$codeq3 = "insert into promocodes_used (userid,promocode) values (\"$userid\",\"$code\")";
	$coder3 = mysql_query($codeq3);
	mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Promo Code Claim:','" . $codename . " - Code: " . $code . "',NOW(),'0.00')");
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="400">
	<tr><td align="center" colspan="2"><div class="heading">Success!</div></td></tr>
	<tr><td colspan="2" align="center"><br>You've successfully redeemed the <?php echo $codename ?> Promo Code with Code <?php echo $code ?>. Your advertising has been added to your account!</td></tr>
	<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	} # if ($coderows > 0)
} # if ($action == "redeemcode")
########################################## END PROMO CODE HANDLING
?>
<script type="text/javascript">
function changeAPHiddenInput (objDropDown)
{
	var adpackdata=objDropDown.value.split("||");
	var adpackid=adpackdata[0];
	if (adpackid)
	{
	var adpackdetails=adpackdata[1];
	var objAPadpack = document.getElementById("adpackid");
	objAPadpack.value = adpackid;
	document.getElementById("apdetails").innerHTML = adpackdetails + "<br><br>";
	document.getElementById("apdetails").visibility = "visible";
	document.getElementById("apdetails").display = "block";
	}
	else
	{
	var objAPadpack = document.getElementById("adpackid");
	objAPadpack.value = "<?php echo $adpackdefaultid ?>";
	var objapdetails = document.getElementById("apdetails");
	document.getElementById("apdetails").innerHTML = "";
	document.getElementById("apdetails").visibility = "hidden";
	document.getElementById("apdetails").display = "none";
	}
}
</script>

<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Welcome <?php echo $firstname ?></div></td></tr>
<tr><td align="center" colspan="2" style="height: 15px;"></td></tr>
<?php
if (($accounttype == "PAID") and ($joinpriceinterval != "One Time"))
{
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
if (($nextdue < $today) and ($membershiplastpaid < $nextdue))
	{
	?>
<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="400">
<tr class="sabrinatrlight"><td align="center" colspan="2"><font style="color:#ff0000;background:#ffff00;">YOUR MEMBERSHIP FEE IS PAST DUE</font></td></tr>
<tr class="sabrinatrdark"><td colspan="2">We were unable to process your payment because your <?php echo $ewalletname ?> doesn't have enough funds. Don't risk your membership! Fund your <?php echo $ewalletname ?> and renew today!</td></tr>
<tr class="sabrinatrlight"><td colspan="2" align="center"><?php echo $ewalletname ?> Balance: $<?php echo $ewallet ?></td></tr>
<tr class="sabrinatrlight"><td>Due Date for $<?php echo $joinprice ?> <?php echo $joinpriceinterval ?> Payment:</td><td><?php echo $nextdue ?></td></tr>
<tr class="sabrinatrlight"><td>Last Paid for:</td><td><?php echo $membershiplastpaid ?></td></tr>
<form action="orderupgraderenewal.php" method="post">
<tr class="sabrinatrdark"><td align="center" colspan="2">
Renew Membership: $<?php echo sprintf("%.2f", $joinprice); ?> <?php echo $joinpriceinterval ?>
&nbsp;&nbsp;
<?php
$adpackq = "select * from adpacks where enable=\"yes\" order by id";
$adpackr = mysql_query($adpackq);
$adpackrows = mysql_num_rows($adpackr);
if ($adpackrows > 0)
	{
?>
Select AdPack: <select name="selectadpack" id="selectadpack" class="pickone" onchange="changeAPHiddenInput(this)">
<option value=""> - Select Bonus AdPack - </option>
<?php
	while ($adpackrowz = mysql_fetch_array($adpackr))
		{
		$details = "";
		$adpackid = $adpackrowz["id"];
		$adpackdescription = $adpackrowz["description"];
		$howmanytimeschosen = $adpackrowz["howmanytimeschosen"];
		$enable = $adpackrowz["enable"];
		$upgrade = $adpackrowz["upgrade"];
		$apcredits = $adpackrowz["credits"];
		$solo_num = $adpackrowz["solo_num"];
		$banner_num = $adpackrowz["banner_num"];
		$banner_views = $adpackrowz["banner_views"];
		$button_num = $adpackrowz["button_num"];
		$button_views = $adpackrowz["button_views"];
		$textad_num = $adpackrowz["textad_num"];
		$textad_views = $adpackrowz["textad_views"];
		$fullloginad_num = $adpackrowz["fullloginad_num"];
		$fullloginad_views = $adpackrowz["fullloginad_views"];
		if ($enablecreditssystem != "yes")
			{
			$apcredits = 0;
			}
		if ($upgrade == "yes")
			{
			$details .= "<span>Membership Upgrade</span><br>";
			}
		if ($apcredits > 0)
			{
			$details .= "<span>$apcredits Credits</span><br>";
			}
		if ($solo_num > 0)
			{
			$details .= "<span>$solo_num Solo Ads</span><br>";
			}
		if (($banner_num > 0) and ($banner_views > 0))
			{
			$details .= "<span>$banner_num Banner Ads with $banner_views Impressions</span><br>";
			}
		if (($button_num > 0) and ($button_views > 0))
			{
			$details .= "<span>$button_num Button Ads with $button_views Impressions</span><br>";
			}
		if (($textad_num > 0) and ($textad_views > 0))
			{
			$details .= "<span>$textad_num Text Ads with $textad_views Impressions</span><br>";
			}
		if (($fullloginad_num > 0) and ($fullloginad_views > 0))
			{
			$details .= "<span>$fullloginad_num Full Page Login Ads with $fullloginad_views Impressions</span><br>";
			}
		$details = htmlentities($details, ENT_COMPAT, "ISO-8859-1");
?>
<option value="<?php echo $adpackid ?>||<?php echo $details ?>"><?php echo $adpackdescription ?></option>
<?php
		}
?>
</select>
<?php
	}
?>
&nbsp;&nbsp;
<input type="hidden" name="page" value="members.php"><input type="hidden" name="adpackid" id="adpackid" value=""><input type="submit" value="RENEW" class="sendit" style="color:#ff0000;font-weight:bold;background:#ffffff;width:75px;height:50px;border:2px #ff0000 outset;"></form>
<br>
<div id="apdetails" name="apdetails"></div>
</form></td></tr>
</table>
</td></tr>
<tr><td align="center" colspan="2"><br>&nbsp;</td></tr>
	<?php
	}
}
?>

<tr><td align="center" colspan="2"><center>
<table cellpadding="4" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrlight"><td valign="top">Your Membership Level:</td><td><?php echo $accounttype ?>
<?php
if ($accounttype != "PAID")
{
?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="upgrade.php">Click Here to Enjoy the Benefits of Upgraded Membership!</a>
<?php
}
if ($vacation == "yes")
{
	$status = "On Vacation";
}
if ($vacation != "yes")
{
	$status = "Active";
}
?>
</td></tr>
<tr class="sabrinatrlight"><td valign="top">Membership Status:</td><td><?php echo $status ?></td></tr>
<?php
$bounceq = "select * from bounces where userid=\"$userid\"";
$bouncer = mysql_query($bounceq);
$bouncerows = mysql_num_rows($bouncer);
if ($bouncerows > 0)
{
?>
<tr class="sabrinatrlight"><td valign="top">Email Bounces:</td><td><?php echo $bouncerows ?> in the past week</td></tr>
<?php
}
?>
<tr class="sabrinatrlight"><td valign="top">Your Affiliate URL:</td><td><a href="<?php echo $domain ?>/index.php?referid=<?php echo $userid ?>" target="_blank"><?php echo $domain ?>/index.php?referid=<?php echo $userid ?></a></td></tr>
<tr class="sabrinatrlight"><td valign="top">Your <?php echo $ewalletname ?> Balance:</td><td>$<?php echo $ewallet ?></td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td valign="top">Your Credit Balance:</td><td><?php echo $credits ?></td></tr>
<?php
}
?>
</table>
</td></tr>

<tr><td align="center" colspan="2">
<?php
$q = "select * from pages where name='Members Area Main Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</td></tr>

<tr><td align="center" colspan="2"><br>&nbsp;</td></tr>

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="400">
<tr class="sabrinatrdark"><td align="center" colspan="2">Redeem Your Promo Codes!</td></tr>
<form action="members.php" method="post">
<tr class="sabrinatrlight"><td>Enter Code:</td><td><input type="text" name="code" maxlength="255" size="16"></td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2"><input type="hidden" name="action" value="redeemcode"><input type="submit" value="SUBMIT"></form></td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2"><br>&nbsp;</td></tr>

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center"class="sabrinatable" width="600">
<tr class="sabrinatrlight"><td align="center" colspan="2">Messages From Your Sponsor</td></tr>
<?php
$ssq1 = "select * from downlinemails where sent=1 and datesent<='".(time()-31*24*60*60)."'";
$ssr1 = mysql_query($ssq1) or die(mysql_error());
while($ssrowz1 = mysql_fetch_array($ssr1))
{
$ssq2 = "delete from downlinemails where id='".$ssrowz1['id']."'";
$ssr2 = mysql_query($ssq2);
}
$referrermailq = "select * from downlinemails where userid=\"$referid\" order by datesent desc limit 10";
$referrermailr = mysql_query($referrermailq);
$referrermailrows = mysql_num_rows($referrermailr);
if ($referrermailrows < 1)
{
?>
<tr class="sabrinatrdark"><td align="center" colspan="2">No messages</td></tr>
<?php
}
if ($referrermailrows > 0)
{
	while ($referrermailrowz = mysql_fetch_array($referrermailr))
	{
		$id = $referrermailrowz["id"];
		$subject = $referrermailrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$adbody = $referrermailrowz["adbody"];
		$adbody = stripslashes($adbody);
		$adbody = str_replace('\\', '', $adbody);
		$datesent = $referrermailrowz["datesent"];
		$datesent = formatDate($datesent);
		?>
		<tr class="sabrinatrdark"><td align="center"><?php echo $subject ?></td><td align="right">SENT: <?php echo $datesent ?></td></tr>
		<tr class="sabrinatrlight"><td align="center" colspan="2"><div style="width: 400px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff;"><?php echo $adbody ?></div></td></tr>
		<tr><td align="center" colspan="2"></td></tr>
		<?php
	} # while ($referrermailrowz = mysql_fetch_array($referrermailr))
} # if ($referrermailrows > 0)
?>
</table>
</td></tr>


</table>
<br><br>
<?php
include "footer.php";
exit;
?>